<?php

namespace Database\Factories;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Goal>
 */
class GoalFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'user_id' => User::factory(),
            'goal_name' => $this->faker->word,
            'target_amount' => $this->faker->randomFloat(2, 100, 10000),
            'current_amount' => $this->faker->randomFloat(2, 0, 10000),
            'deadline' => $this->faker->dateTimeBetween('now', '+1 year'),
        ];
    }
}
