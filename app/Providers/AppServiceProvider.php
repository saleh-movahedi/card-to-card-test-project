<?php

namespace App\Providers;

use App\Repository\AccountRepository;
use App\Repository\CardRepository;
use App\Repository\Interfaces\AccountRepositoryInterface;
use App\Repository\Interfaces\CardRepositoryInterface;
use App\Repository\Interfaces\TransactionRepositoryInterface;
use App\Repository\Interfaces\UserRepositoryInterface;
use App\Repository\TransactionRepository;
use App\Repository\UserRepository;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        $this->app->bind(AccountRepositoryInterface::class, AccountRepository::class);
        $this->app->bind(CardRepositoryInterface::class, CardRepository::class);
        $this->app->bind(TransactionRepositoryInterface::class, TransactionRepository::class);
        $this->app->bind(UserRepositoryInterface::class, UserRepository::class);

    }
}
