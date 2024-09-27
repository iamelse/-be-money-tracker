<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\Transaction;
use App\Http\Requests\StoreTransactionRequest;
use App\Http\Requests\UpdateTransactionRequest;
use App\Http\Resources\TransactionResource;
use App\Traits\ApiResponseTrait;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class TransactionController extends Controller
{
    use ApiResponseTrait;
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request) : JsonResponse
    {
        $query = Transaction::where('user_id', Auth::user()->id);

        $search = $request->query('search_query', '');
        if ($search !== '') {
            $query->where(function ($query) use ($search) {
                $query->where('amount', 'like', '%'.$search.'%')
                    ->orWhere('category', 'like', '%'.$search.'%')
                    ->orWhere('description', 'like', '%'.$search.'%');
            });
        }

        $limit = $request->query('limit', 10);
        $page = $request->query('page', 1);

        $result = $query->orderByDesc('id')
                        ->paginate($limit, ['*'], 'page', $page);

        return $this->success([
            'data' => TransactionResource::collection($result->items()),
            'total' => $result->total(),
            'limit' => $result->perPage(),
            'page' => $result->currentPage(),
            'totalPages' => $result->lastPage(),
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreTransactionRequest $request) : JsonResponse
    {
        $validated = $request->validated();
        $validated['user_id'] = Auth::id();

        $transaction = Transaction::create($validated);

        // Update the account balance directly
        $transaction->account->update([
            'balance' => DB::raw("balance + ({$transaction->amount})")
        ]);

        return $this->success(new TransactionResource($transaction), 'Transaction created successfully', Response::HTTP_CREATED);
    }

    /**
     * Display the specified resource.
     */
    public function show(Transaction $transaction)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateTransactionRequest $request, Transaction $transaction) : JsonResponse
    {
        $validated = $request->validated();

        $amountDifference = $validated['amount'] - $transaction->amount;

        $transaction->update($validated);

        $transaction->account->update([
            'balance' => DB::raw("balance + ({$amountDifference})")
        ]);

        return $this->success(new TransactionResource($transaction), 'Transaction updated successfully', Response::HTTP_OK);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Transaction $transaction) : JsonResponse
    {
        $transaction->account->update([
            'balance' => DB::raw("balance - ({$transaction->amount})")
        ]);

        $transaction->delete();

        return $this->success(null, 'Transaction deleted successfully', Response::HTTP_OK);
    }
}
