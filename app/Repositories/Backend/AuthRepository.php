<?php

namespace App\Repositories\Backend;

use App\Events\SendOtp;
use App\Events\SuccessfullyRegister;
use App\Http\Resources\AuthResource;
use App\Models\User;
use App\Mail\OtpMail;
use App\Traits\AuthTraits;
use App\Http\Responses\BaseResponse;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;

class AuthRepository
{

    use AuthTraits;
    public $response;

    public function __construct(BaseResponse $baseResponse)
    {
        $this->response = $baseResponse;
    }

    public function login($request)
    {
        $validated = $request->validate([
            'email' => 'required',
            'password' => 'required',
        ]);
        if (Auth::attempt($validated)) {
            $user =  Auth::user();

            $otp = rand(100000, 999999);
            $user->otp = $otp;
            $user->otp_expired_at = Carbon::now()->addMinutes(5);
            $user->save();
            logger(["user", $user->email]);
            SendOtp::dispatch($user, $otp);
            return $this->response->success(["success" => true], 'Your otp is send to your email address.', 200);
        } else {
            return $this->response->error('Login Failed', 401);
        }
    }

    public function register($request)
    {
        if ($this->checkPhone($request->phone)) {
            return $this->response->error("Phone is already taken", 409);
        } elseif ($this->checkEmail($request->email)) {
            return $this->response->error("Email is already taken", 409);
        } else {
            try {
                $validated = $request->validate([
                    'name' => 'required',
                    'email' => 'required|email',
                    'phone' => 'required|min:6|max:12',
                    'password' => 'required|min:6|confirmed',

                ]);

                $user = User::create($validated);
                $token = $user->createToken('auth_token')->plainTextToken;
                SuccessfullyRegister::dispatch($user, "Welcome $user->name ! Registered successfylly ");
                return $this->response->success(['data' => $user, 'token' => $token], 200);
            } catch (\Throwable $e) {
                return $this->response->error($e->getMessage(), 500);
            }
        }
    }

    public function verifyOtp($request)
    {
        try {
            $validatd = $request->validate([
                'email' => 'required|email',
                'otp' => 'required'
            ]);
            $user = User::where('email', $validatd['email'])->first();
            if ($user && $user->otp == $validatd['otp']) {
                if (Carbon::parse($user->otp_expired_at)->isFuture()) {
                    $token = $user->createToken('auth_token')->plainTextToken;
                    $user->otp = null;
                    $user->otp_expired_at = null;
                    $user->save();
                    return $this->response->success(["data" => AuthResource::make($user), "token" => $token], "Login Successful", 200);
                } else {
                    return $this->response->error('Otp Timeout', 401);
                }
            } else {
                return $this->response->error('Invalid Otp Code', 401);
            }
        } catch (\Throwable $e) {
            return $this->response->error($e->getMessage(), 500);
        }
    }

    public function logout($user)
    {

        try {
            $user->tokens()->delete();
            return $this->response->success(['success' => true], 'Logout Successful', 200);
        } catch (\Throwable $e) {
            return $this->response->error($e->getMessage(), 500);
        }
    }
}
