<?php

namespace Database\Factories;

use App\Models\Product;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Stock>
 */
class StockFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'product_id' => Product::factory(), // Crée un produit associé
            'quantity' => $this->faker->numberBetween(1, 100),
            'price' => $this->faker->randomFloat(2, 1, 100), // Prix entre 1.00 et 100.00
            'user_id' => $this->faker->numberBetween(1, 10),
            'description' => $this->faker->sentence,
            'is_available' => $this->faker->boolean,
        ];
    }
}
