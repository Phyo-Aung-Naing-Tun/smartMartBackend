<?php

namespace Database\Seeders;

use App\Enums\UserType;
use App\Models\User;
use App\Traits\RoleAndPermissionTrait;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;


class AdminSeeder extends Seeder
{
    use RoleAndPermissionTrait;
    public function run(): void
    {
        $user = User::create([
            'name' => 'SmartMart',
            'email' => 'smartmart@gmail.com',
            'phone' => '09783538348',
            'password' => Hash::make('admin@123'),
            'email_verified_at' => now(),
            'active_at' => now(),
            'address' => 'No(10),First Floor,Singngu,Insein,Yangon',
            'remember_token' => Str::random(10),
        ]);
        $this->assignRole($user,UserType::ADMIN->value);
    }
}