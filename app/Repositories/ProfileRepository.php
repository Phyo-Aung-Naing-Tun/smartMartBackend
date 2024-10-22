<?php

namespace App\Repositories;

use App\Http\Resources\AuthResource;
use App\Http\Responses\BaseResponse;
use Illuminate\Support\Facades\Auth;

class ProfileRepository
{
    protected $response;
    public function __construct(BaseResponse $baseResponse)
    {
        $this->response = $baseResponse;
    }

    public function index()
    {
        try {
            return $this->response->success(AuthResource::make(Auth::user()), 'Request Successful', 200);
        } catch (\Throwable $e) {
            return $this->response->error($e->getMessage(), 500);
        }
    }
}
