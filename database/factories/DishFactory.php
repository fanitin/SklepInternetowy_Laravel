<?php

namespace Database\Factories;

use App\Models\DishCategory;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\=Dish>
 */
class DishFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'name' => fake()->unique()->word(),
            'price' => fake()->numberBetween(10, 200),
            'weight' => fake()->numberBetween(100, 800),
            'is_active' => fake()->boolean(),
            'dish_category_id' => DishCategory::get()->random()->id,
            'dish_ingridients' => fake()->sentence()
        ];
    }
}
