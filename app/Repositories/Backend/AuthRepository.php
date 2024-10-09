<?php

namespace App\Repositories\Backend;

use App\Http\Responses\BaseResponse;
use App\Models\User;
use App\Traits\AuthTraits;

class AuthRepository
{

    use AuthTraits;
    public $response;

    public function __construct(BaseResponse $baseResponse)
    {
        $this->response = $baseResponse;
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
