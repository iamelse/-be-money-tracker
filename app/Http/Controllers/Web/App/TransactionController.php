<?php

namespace App\Http\Controllers\Web\App;

use App\Http\Controllers\Controller;
use App\Models\Transaction;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class TransactionController extends Controller
{
    public function index(Request $request)
    {
        $filters = [
            'q' => $request->input('q', ''),
            'perPage' => $request->input('limit', 10),
            'account_id' => $request->input('account_id', null),
            'columns' => ['amount', 'category', 'description']
        ];
        
        $transactions = $this->_getFilteredTransactions($filters);

        return view('pages.transactions.index', [
            'title' => 'Your Transactions | CashFlow',
            'transactions' => $transactions,
            'perPage' => $filters['perPage'],
            'q' => $filters['q'],
            'account_id' => $filters['account_id'],
        ]);
    }

    public function create()
    {
        return view('transactions.create');
    }

    // Store a newly created resource in storage.
    public function store(Request $request)
    {
        $request->validate([
            'amount' => 'required|numeric',
            'transaction_date' => 'required|date',
            'category' => 'required|string|max:255',
        ]);

        Transaction::create([
            'user_id' => auth()->id(),
            'account_id' => $request->account_id,
            'amount' => $request->amount,
            'transaction_date' => $request->transaction_date,
            'category' => $request->category,
            'description' => $request->description,
        ]);

        return redirect()->route('transactions.index')->with('success', 'Transaction created successfully.');
    }

    // Show the form for editing the specified resource.
    public function edit(Transaction $transaction)
    {
        return view('transactions.edit', compact('transaction'));
    }

    // Update the specified resource in storage.
    public function update(Request $request, Transaction $transaction)
    {
        $request->validate([
            'amount' => 'required|numeric',
            'transaction_date' => 'required|date',
            'category' => 'required|string|max:255',
        ]);

        $transaction->update($request->all());

        return redirect()->route('transactions.index')->with('success', 'Transaction updated successfully.');
    }

    // Remove the specified resource from storage.
    public function destroy(Transaction $transaction)
    {
        $transaction->delete();

        return redirect()->route('transactions.index')->with('success', 'Transaction deleted successfully.');
    }

    private function _getFilteredTransactions($filters)
    {
        return Transaction::where('user_id', Auth::user()->id)->filter($filters);
    }
}