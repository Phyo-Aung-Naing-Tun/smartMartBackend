<?php

namespace Database\Seeders;

use App\Enums\UserType;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;

class RoleSeeder extends Seeder
{
    public function run(): void
    {
        for ($i = 0; $i < count(UserType::cases()); $i++) {
            Role::create(['name' => UserType::cases()[$i]->value]);
        }
    }
}