<?php

namespace Database\Seeders;

use App\Enums\UserStatus;
use App\Models\Product;
use App\Models\User;
use App\Traits\RoleAndPermissionTrait;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    use RoleAndPermissionTrait;
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        
        $this->call([RoleSeeder::class, AdminSeeder::class]);
        $users = User::factory(10)->create();
        foreach($users as $user){
            $this->assignRole($user,UserStatus::USER->value);
        };
        Product::factory(15)->create();

        // User::factory()->create([
        //     'name' => 'Test User',
        //     'email' => 'test@example.com',
        // ]);
    }
}