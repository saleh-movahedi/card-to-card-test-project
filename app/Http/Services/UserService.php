<?php

namespace App\Http\Services;

use App\Repository\Interfaces\UserRepositoryInterface;
use Illuminate\Database\Eloquent\Collection;

class UserService
{
    protected UserRepositoryInterface $userRepository;

    public function __construct(UserRepositoryInterface $userRepository)
    {
        $this->userRepository = $userRepository;
    }

    public function getUsersWithTopTransactions($count = 3): Collection
    {
        return $this->userRepository->getUsersWithTopTransactions($count);
    }
}
