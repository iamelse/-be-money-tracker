<?php

namespace Database\Factories;

use App\Models\Account;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Transaction>
 */
class TransactionFactory extends Factory
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
            'account_id' => Account::factory(),
            'amount' => $this->faker->randomFloat(2, -500, 500),
            'transaction_date' => $this->faker->dateTimeThisYear(),
            'category' => $this->faker->word,
            'description' => $this->faker->sentence,
        ];
    }
}
