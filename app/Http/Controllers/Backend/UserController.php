<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Repositories\Backend\UserRepository;
use Illuminate\Http\Request;

class UserController extends Controller
{

    private $repo;

    public function __construct(UserRepository $userRepository)
    {
        $this->repo = $userRepository;
    }
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
       return $this->repo->index($request);
    }


    /**
     * Display the specified resource.
     */
    public function show(User $user)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, User $user)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(User $user)
    {
        //
    }
}