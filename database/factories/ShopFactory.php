<?php

namespace Database\Factories;

use App\Enums\UserType;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Shop>
 */
class ShopFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'name' => fake()->company(),
            'seller_id' => User::filterByRole(UserType::SELLER->value)->pluck('id')->random(),
            'email' => fake()->companyEmail(),
            'phone' => fake()->phoneNumber(),
            'about' => fake()->paragraph(),
            'address' => fake()->address(),
        ];
    }
}