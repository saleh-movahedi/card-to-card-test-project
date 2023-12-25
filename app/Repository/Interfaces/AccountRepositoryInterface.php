<?php

namespace App\Repository\Interfaces;

use App\Models\Account;

interface AccountRepositoryInterface
{
    public function increment(Account $account, $amount): bool|int;

    public function decrement(Account $account, $amount): bool|int;

    public function checkBalanceIsEnough(Account $account, mixed $amount, mixed $fee);

    public function getWithLock(mixed $accountId): Account;
}
