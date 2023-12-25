<?php

namespace Database\Seeders;

use App\Models\Account;
use Illuminate\Database\Seeder;

class CardSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Account::find(1)
            ->cards()
            ->create([
                'card_number' => '5022291030213704'
            ]);

        Account::find(2)
            ->cards()
            ->create([
                'card_number' => '5022291030213705'
            ]);
    }
}
