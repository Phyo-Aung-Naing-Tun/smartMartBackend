<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Product>
 */
class ProductFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            "name" => fake()->name(),
            "shop_id" => ShopFactory::class,
            "image" => fake()->imageUrl(),
            "purchase_price" => fake()->numberBetween(10,99),
            "sale_price" => fake()->numberBetween(100,1000),
            
        ];
    }
}