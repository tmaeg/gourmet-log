<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Restaurant>
 */
class RestaurantFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'user_id' => 1,
            'name' => fake()->lastName(),
            'name_katakana' => fake()->lastKanaName(),
            'review' => fake()->numberBetween(1, 5),
            'food_picture' => fake()->imageUrl(640, 480, 'food'),
            'map_url' => '',
            'comment' => fake()->realText(100),
        ];
    }
}
