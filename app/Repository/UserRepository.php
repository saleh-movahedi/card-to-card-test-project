<?php

namespace App\Repository;

use App\Models\User;
use App\Repository\Interfaces\UserRepositoryInterface;
use DB;
use Illuminate\Database\Eloquent\Collection;

class UserRepository implements UserRepositoryInterface
{
    /**
     * The logic to retrieve users with top transactions
     * @param int $count
     * @return Collection
     */
    public function getUsersWithTopTransactions(int $count = 3): Collection
    {
        return
            User::with(['accounts.cards.transactions.fee' => function ($query) {
                $query->orderBy('created_at', 'desc')->take(10);
            }])
                ->select('users.*', DB::raw('COUNT(transactions.id) as transaction_count'))
                ->join('accounts', 'users.id', '=', 'accounts.user_id')
                ->join('cards', 'accounts.id', '=', 'cards.account_id')
                ->join('transactions', function ($join) {
                    $join->on('cards.id', '=', 'transactions.source_card_id');
                    // ->orWhere('cards.id', '=', 'transactions.destination_card_id')
                })
                ->where('transactions.created_at', '>=', now()->subMinutes(100))
                ->groupBy('users.id')
                ->orderBy('transaction_count', 'desc')
                ->take($count)
                ->get();
    }

}
