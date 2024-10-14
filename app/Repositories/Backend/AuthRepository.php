<?php

namespace App\Repositories\Backend;

use App\Models\User;
use App\Mail\OtpMail;
use App\Traits\AuthTraits;
use App\Http\Responses\BaseResponse;
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
            $otp = rand(111111, 999999);
            Mail::to($user)->send(new OtpMail($otp));
            return ['otp' => 'send'];
            // $token = $user->createToken('auth_token')->plainTextToken;
            // return $this->response->success(['data' => $user, 'token' => $token], 'Login Successful', 200);
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
                return $this->response->success(['data' => $user, 'token' => $token], 200);
            } catch (\Throwable $e) {
                return $this->response->error($e->getMessage(), 500);
            }
        }
    }
}
