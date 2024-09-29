<?php

namespace App\Traits;

use Spatie\Permission\Models\Role;

trait RoleAndPermissionTrait
{
    public function getRole($name): ?Role
    {
        $role = Role::findByName($name);
        return $role;
    }
}
