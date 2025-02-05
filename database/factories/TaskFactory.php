<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Task>
 */
class TaskFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [//pravi falshivi obekti da pylnim db
            'label' => fake()->name(),
            'description' => fake()->realText(500),
            'user_id' => fake()->numberBetween(2, 5),
            'status_id' => fake()->numberBetween(1, 5),
            'region_id' => fake()->numberBetween(1, 3)
        ];
    }
}
