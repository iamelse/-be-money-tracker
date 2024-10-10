<?php

namespace App\Services;

use App\Models\Account;
use App\Models\Transaction;
use App\Models\LedgerEntry;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class TransactionService
{
    public function createTransaction(array $data)
    {
        DB::transaction(function () use ($data) {
            $account = Account::findOrFail($data['account_id']);
            $amount = $data['amount'];
            
            $newBalance = $account->balance + $amount;

            if ($newBalance < 0) {
                throw new \Exception('Insufficient funds');
            }

            $transaction = Transaction::create([
                'user_id' => $data['user_id'],
                'account_id' => $data['account_id'],
                'amount' => $amount,
                'transaction_date' => $data['transaction_date'],
                'category' => $data['category'],
                'description' => $data['description'],
            ]);

            $account->update(['balance' => $newBalance]);

            LedgerEntry::create([
                'account_id' => $transaction->account_id,
                'transaction_id' => $transaction->id,
                'debit' => $transaction->amount < 0 ? abs($transaction->amount) : 0,
                'credit' => $transaction->amount > 0 ? $transaction->amount : 0,
                'balance' => $newBalance,
                'description' => 'Transaction: ' . $transaction->description,
                'entry_date' => now(),
            ]);
        });
    }

    public function updateTransaction(array $data, $transactionId)
    {
        DB::transaction(function () use ($data, $transactionId) {
            $transaction = Transaction::findOrFail($transactionId);
            $account = Account::findOrFail($data['account_id']);

            $oldDebit = $transaction->amount < 0 ? abs($transaction->amount) : 0;
            $oldCredit = $transaction->amount > 0 ? $transaction->amount : 0;

            $currentBalance = $account->balance - $oldDebit + $oldCredit;

            $newDebit = $data['amount'] < 0 ? abs($data['amount']) : 0;
            $newCredit = $data['amount'] > 0 ? $data['amount'] : 0;

            $transaction->update([
                'account_id' => $data['account_id'],
                'amount' => $data['amount'],
                'transaction_date' => $data['transaction_date'],
                'category' => $data['category'],
                'description' => $data['description'],
            ]);

            $transaction->refresh();
            $account->refresh();

            $newBalance = $account->balance - $newDebit + $newCredit;

            if ($newBalance < 0) {
                throw new \Exception('Insufficient funds');
            }

            $account->update(['balance' => $newBalance]);

            LedgerEntry::create([
                'transaction_id' => $transaction->id,
                'account_id' => $data['account_id'],
                'debit' => $newDebit,
                'credit' => $newCredit,
                'balance' => $newBalance,
                'description' => 'Updated Transaction: ' . $data['description'],
                'entry_date' => now(),
            ]);
        });
    }

    public function deleteTransaction($transactionId)
    {
        DB::transaction(function () use ($transactionId) {
            $transaction = Transaction::findOrFail($transactionId);
            $account = Account::findOrFail($transaction->account_id);

            $debit = $transaction->amount < 0 ? abs($transaction->amount) : 0;
            $credit = $transaction->amount > 0 ? $transaction->amount : 0;

            $newBalance = $account->balance - $credit + $debit;

            $account->update(['balance' => $newBalance]);

            $account->refresh();

            $transaction->delete();

            LedgerEntry::where('transaction_id', $transactionId)->delete();
        });
    }
}
