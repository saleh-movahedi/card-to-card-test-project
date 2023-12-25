<?php

namespace App\Repository\Interfaces;

use App\Models\Card;

interface CardRepositoryInterface
{
    public function finByCardNumber($cardNumber): bool|Card;
}
