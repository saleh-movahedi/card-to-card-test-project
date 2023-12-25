<?php

namespace App\Repository;

use App\Models\Card;
use App\Repository\Interfaces\CardRepositoryInterface;

class CardRepository implements CardRepositoryInterface
{
    public function finByCardNumber($cardNumber): bool|Card
    {
        $record = Card::query()
            ->where('card_number', $cardNumber)->first();

        if (!$record instanceof Card) {
            return false;
        }
        return $record;
    }

}
