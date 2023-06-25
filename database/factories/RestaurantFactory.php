<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Http\UploadedFile;

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
        $path = uploadedFile::fake()->image('avatar.jpg', 640, 480)->store('food-pictures', 'public');
        return [
            'name' => fake()->lastName(),
            'name_katakana' => fake()->lastKanaName(),
            'review' => fake()->numberBetween(1, 5),
            'food_picture' => asset('storage/' . $path),
            'map_url' => 'https://goo.gl/maps/FW6U7F4k3Rmjy7h79',
            'comment' => fake()->realText(100),
        ];
    }
}
