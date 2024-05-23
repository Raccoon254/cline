<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Project>
 */
class ProjectFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'name' => fake()->name(),
            'status' => fake()->randomElement(['active', 'inactive', 'completed']),
            'description' => fake()->sentence(),
            'price' => fake()->randomFloat(2, 100, 10000),
            'start_date' => now(),
            'end_date' => fake()->dateTimeBetween('now', '+1 year'),
            'user_id' => 6,
            'client_id' => \App\Models\Client::all()->random()->id,
        ];
    }
}
