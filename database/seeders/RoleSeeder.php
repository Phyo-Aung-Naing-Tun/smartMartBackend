<?php

namespace Database\Seeders;

use App\Enums\UserStatus;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;

class RoleSeeder extends Seeder
{
    public function run(): void
    {
        for ($i = 0; $i < count(UserStatus::cases()); $i++) {
            Role::create(['name' => UserStatus::cases()[$i]->value]);
        }
    }
}
