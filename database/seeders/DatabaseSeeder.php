<?php

namespace Database\Seeders;

use App\Models\Account;
use App\Models\Budget;
use App\Models\Goal;
use App\Models\Report;
use App\Models\Transaction;
use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // User::factory(10)->create();

        User::factory(10)->create()->each(function ($user) {
            $user->accounts()->saveMany(Account::factory(3)->make());
            $user->transactions()->saveMany(Transaction::factory(5)->make());
            $user->budgets()->saveMany(Budget::factory(2)->make());
            $user->goals()->saveMany(Goal::factory(2)->make());
            $user->reports()->saveMany(Report::factory(1)->make());
        });
    }
}
