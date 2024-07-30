<?php

namespace Database\Factories;

use App\Models\Category;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Good>
 */
class GoodFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'category_id' => Category::inRandomOrder()->first()->id,
            'sku' => $this->faker->numberBetween(100000, 999999),
            'name' => $this->faker->word(),
            'prices' => [
                'old' => $this->faker->numberBetween(100, 1000),
                'price' => $this->faker->numberBetween(100, 1000),
            ],
            'description' => $this->faker->paragraph(),
            'is_published' => true,
        ];
    }
}
