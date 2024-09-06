<?php

namespace Database\Factories;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Budget>
 */
class BudgetFactory extends Factory
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
            'category' => $this->faker->word,
            'amount' => $this->faker->randomFloat(2, 50, 5000),
            'start_date' => $this->faker->dateTimeThisYear(),
            'end_date' => $this->faker->dateTimeThisYear('+1 month'),
        ];
    }
}
