<?php

namespace App\Repository;

use App\Models\Transaction;
use App\Repository\Interfaces\TransactionRepositoryInterface;

class TransactionRepository implements TransactionRepositoryInterface
{
    private Transaction $model;

    public function __construct(Transaction $model)
    {
        $this->model = $model;
    }

    public function transfer(mixed $source_card_number, mixed $destination_card_number, mixed $amount, $fee): Transaction
    {
        /** @var Transaction $transaction */
        $transaction = $this->model->newQuery()
            ->create([
                'source_card_id' => $source_card_number->id,
                'destination_card_id' => $destination_card_number->id,
                'amount' => $amount,
            ]);

        $transaction->fee()->create([
            'amount' => $fee
        ]);

        return $transaction;

    }
}
