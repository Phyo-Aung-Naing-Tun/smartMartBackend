<?php
namespace App\Repositories\Backend;

use App\Http\Resources\Backend\RoleAndPermissionResource;
use App\Traits\RoleAndPermissionTrait;
use Spatie\Permission\Models\Role;

class RoleAndPermissionRepository{
    use RoleAndPermissionTrait;
    public function showRoles()
    {
        $roles = Role::all();
        return RoleAndPermissionResource::collection($roles);
    }
}