<?php
namespace App\Repositories\Backend;

use App\Http\Resources\Backend\RoleAndPermissionResource;
use App\Traits\RoleAndPermissionTrait;
use Spatie\Permission\Models\Role;

class RoleAndPermissionRepository{
    use RoleAndPermissionTrait;
    public function showRoles($request)
    {
        $param = data_get($request,"search", null);
        $roles = Role::when($param, function($query)use($param){
            return $query->where("name" , "like" , "%$param%");
        })->get();
        return RoleAndPermissionResource::collection($roles);
    }
}