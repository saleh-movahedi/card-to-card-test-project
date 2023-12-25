<?php

namespace App\Repository\Interfaces;

use Illuminate\Database\Eloquent\Collection;

interface UserRepositoryInterface
{
    /**
     * The logic to retrieve users with top transactions
     * @param int $count
     * @return Collection
     */
    public function getUsersWithTopTransactions(int $count = 3): Collection;
}
