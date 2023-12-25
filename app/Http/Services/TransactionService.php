<?php

namespace App\Http\Services;

use App\Exceptions\CardNotFound;
use App\Exceptions\NotEnoughBalance;
use App\Jobs\SendSmsJob;
use App\Models\Account;
use App\Models\Card;
use App\Repository\Interfaces\AccountRepositoryInterface;
use App\Repository\Interfaces\CardRepositoryInterface;
use App\Repository\Interfaces\TransactionRepositoryInterface;
use DB;
use Exception;

class TransactionService
{
    private TransactionRepositoryInterface $transactionRepository;
    private CardRepositoryInterface $cardRepository;
    private AccountRepositoryInterface $accountRepository;

    public function __construct(
        TransactionRepositoryInterface $transactionRepository,
        CardRepositoryInterface        $cardRepository,
        AccountRepositoryInterface     $accountRepository,
    )
    {
        $this->transactionRepository = $transactionRepository;
        $this->cardRepository = $cardRepository;
        $this->accountRepository = $accountRepository;
    }

    /**
     * @throws Exception
     */
    public function transfer(mixed $data): bool
    {
        $fee = config('settings.fee');
        $amount = $data['amount'];

        DB::beginTransaction();

        /** @var Card $sourceCardNumber */
        $sourceCardNumber = $this->cardRepository->finByCardNumber($data['source_card_number']);
        if (!$sourceCardNumber instanceof Card)
            throw new CardNotFound('source card has not found in banking system');

        /** @var Card $destinationCardNumber */
        $destinationCardNumber = $this->cardRepository->finByCardNumber($data['destination_card_number']);
        if (!$destinationCardNumber instanceof Card)
            throw new CardNotFound('destination card has not found in banking system');

        $sourceAccount = $this->accountRepository->getWithLock($sourceCardNumber->account_id);
        $destinationAccount = $this->accountRepository->getWithLock($destinationCardNumber->account_id);

        $this->_checkEnoughBalance($sourceAccount, $amount, $fee);

        try {
            $this->transactionRepository->transfer(
                $sourceCardNumber,
                $destinationCardNumber,
                $amount,
                $fee
            );

            $this->accountRepository->decrement($sourceAccount, $amount + $fee);
            $this->accountRepository->increment($destinationAccount, $amount);

            DB::commit();

            dispatch(new SendSmsJob(
                    $sourceAccount->user->mobile_number,
                    'Your balance has been decreased by ' . $amount
                )
            );

            dispatch(new SendSmsJob(
                    $destinationAccount->user->mobile_number,
                    'Your balance has been increased by ' . $amount
                )
            );

        } catch (Exception $e) {
            DB::rollBack();
            throw new Exception('transfer failed: ' . $e->getMessage());
        }

        return true;

    }

    /**
     * @throws Exception
     */
    private function _checkEnoughBalance(Account $account, mixed $amount, $fee): void
    {
        if (!$this->accountRepository->checkBalanceIsEnough($account, $amount, $fee)) {
            throw new NotEnoughBalance();
        }
    }

}
