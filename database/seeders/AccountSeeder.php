<?php

namespace Database\Seeders;

use App\Models\Account;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class AccountSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Account::create([
            'user_id' => 1, // Assuming user_id 1 corresponds to the user created in UserSeeder
            'balance' => 5_000_000,
        ]);

        Account::create([
            'user_id' => 2, // Assuming user_id 2 corresponds to the user created in UserSeeder
            'balance' => 4_000_000,
        ]);

    }
}
