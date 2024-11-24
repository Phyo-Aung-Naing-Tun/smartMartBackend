<?php

namespace Database\Seeders;

use App\Enums\UserStatus;
use App\Models\User;
use App\Traits\RoleAndPermissionTrait;
use Illuminate\Database\Seeder;

class SellerSeeder extends Seeder
{
    use RoleAndPermissionTrait;
    public function run(): void
    {
        $users = User::factory(10)->create();
        foreach($users as $user){
            $this->assignRole($user,UserStatus::SELLER->value);
        };
    }
}