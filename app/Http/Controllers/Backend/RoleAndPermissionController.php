<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Repositories\Backend\RoleAndPermissionRepository;
use Illuminate\Http\Request;

class RoleAndPermissionController extends Controller
{
    protected $repo;
    public function __construct(RoleAndPermissionRepository $roleAndPermissionRepository)
    {
        $this->repo = $roleAndPermissionRepository;
    }

    public function showRoles(Request $request)
    {
        return $this->repo->showRoles($request);
    }
}