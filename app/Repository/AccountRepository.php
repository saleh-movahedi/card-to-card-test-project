<?php

namespace App\Repository;

use App\Models\Account;
use App\Repository\Interfaces\AccountRepositoryInterface;

class AccountRepository implements AccountRepositoryInterface
{

    public function increment(Account $account, $amount): bool|int
    {
        return $account->increment('balance', $amount);
    }

    public function decrement(Account $account, $amount): bool|int
    {
        return $account->decrement('balance', $amount);
    }

    public function checkBalanceIsEnough(Account $account, mixed $amount, mixed $fee): bool
    {
        return ($account->balance + $fee) > $amount;
    }

    public function getWithLock(mixed $accountId): Account
    {
        return Account::lockForUpdate()->find($accountId);
    }

}
