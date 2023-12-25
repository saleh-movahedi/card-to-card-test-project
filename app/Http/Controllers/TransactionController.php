<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreTransactionRequest;
use App\Http\Resources\UsersWithTopTransactions;
use App\Http\Services\TransactionService;
use App\Http\Services\UserService;
use Exception;

class TransactionController extends Controller
{

    private TransactionService $transactionService;
    private UserService $userService;

    public function __construct(
        TransactionService $transactionService,
        UserService        $userService
    )
    {
        $this->transactionService = $transactionService;
        $this->userService = $userService;
    }

    /**
     * @throws Exception
     */
    public function transfer(StoreTransactionRequest $request)
    {
        $data = $request->validated();
        $this->transactionService->transfer($data);

        return response()->json([
                'message' => 'Transfer done successfully',
                'data' => [
                    $data
                ]
            ]
        );
    }

    public function usersWithTopTransactions()
    {
        $data = $this->userService->getUsersWithTopTransactions(count: 3);
        return UsersWithTopTransactions::collection($data);
    }
}
