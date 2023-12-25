<?php

namespace App\Repository\Interfaces;

use App\Models\Transaction;

interface TransactionRepositoryInterface
{
    public function transfer(mixed $source_card_number, mixed $destination_card_number, mixed $amount, $fee): Transaction;
}
