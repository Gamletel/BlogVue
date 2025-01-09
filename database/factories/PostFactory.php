<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Post>
 */
class PostFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'icon'=>$this->faker->imageUrl(),
            'user_id'=>fake()->numberBetween(0, 100),
            'title'=>fake()->title,
            'description'=>fake()->text,
            'text'=>fake()->text,
        ];
    }
}
