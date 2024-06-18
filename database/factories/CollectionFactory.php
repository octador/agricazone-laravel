<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Collection>
 */
class CollectionFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'description' => $this->faker->word(),
            'adress' => $this->faker->word(),
            'postalcode' => $this->faker->word(),
            'city' => $this->faker->word(),
            'user_id' => $this->faker->numberBetween(1, 10),
        ];
    }
}
