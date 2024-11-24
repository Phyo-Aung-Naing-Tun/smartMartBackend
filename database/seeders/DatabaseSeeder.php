<?php

namespace Database\Seeders;

use App\Traits\RoleAndPermissionTrait;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    use RoleAndPermissionTrait;
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        
        $this->call([RoleSeeder::class, AdminSeeder::class, UserSeeder::class, SellerSeeder::class,ShopSeeder::class,ProductSeeder::class]);
    
    }
}