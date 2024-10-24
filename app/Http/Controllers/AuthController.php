<?php

namespace App\Http\Controllers;

use App\Repositories\Backend\AuthRepository;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    protected  $repo;

    public function __construct(AuthRepository $authRepository)
    {
        $this->repo = $authRepository;
    }

    public function login(Request $request)
    {
        return $this->repo->login($request);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function register(Request $request)
    {
        return $this->repo->register($request);
    }

    public function verifyOtp(Request $request)
    {
        return $this->repo->verifyOtp($request);
    }

    public function logout()
    {

        $user = Auth::user();

        return  $this->repo->logout($user);
    }
}
