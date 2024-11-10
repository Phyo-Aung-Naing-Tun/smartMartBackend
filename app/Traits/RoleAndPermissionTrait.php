<?php

namespace App\Traits;

use App\Models\User;
use Spatie\Permission\Models\Role;

trait RoleAndPermissionTrait
{
    public function getRole($name): ?Role
    {
        $role = Role::findByName($name);
        return $role;
    }

    public function assignRole(User $user,$role)
    {
        $user->assignRole($this->getRole($role));
    }


    
}