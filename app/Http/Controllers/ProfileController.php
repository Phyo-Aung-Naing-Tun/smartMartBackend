<?php

namespace App\Http\Controllers;

use App\Repositories\ProfileRepository;

class ProfileController extends Controller
{
    protected $repo;
    public function __construct(ProfileRepository $profileRepository)
    {
        $this->repo = $profileRepository;
    }
    public function index()
    {
        return $this->repo->index();
    }
}