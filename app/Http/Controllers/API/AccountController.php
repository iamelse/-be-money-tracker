<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreAccountRequest;
use App\Http\Requests\UpdateAccountRequest;
use App\Http\Resources\AccountResource;
use App\Models\Account;
use Illuminate\Http\Response;
use App\Traits\ApiResponseTrait;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AccountController extends Controller
{
    use ApiResponseTrait;

    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $query = Account::where('user_id', Auth::user()->id);

        $search = $request->query('search_query', '');
        if ($search !== '') {
            $query->where(function ($query) use ($search) {
                $query->where('account_name', 'like', '%'.$search.'%')
                    ->orWhere('account_type', 'like', '%'.$search.'%');
            });
        }

        $limit = $request->query('limit', 10);
        $page = $request->query('page', 1);

        $result = $query->orderByDesc('id')
                        ->paginate($limit, ['*'], 'page', $page);

        return $this->success([
            'data' => AccountResource::collection($result->items()),
            'total' => $result->total(),
            'limit' => $result->perPage(),
            'page' => $result->currentPage(),
            'totalPages' => $result->lastPage(),
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreAccountRequest $request)
    {
        $validated = $request->validated();
        $account = Account::create($validated);
        return $this->success(new AccountResource($account), 'Account created successfully', Response::HTTP_CREATED);
    }

    /**
     * Display the specified resource.
     */
    public function show(Account $account)
    {
        return $this->success(new AccountResource($account));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateAccountRequest $request, Account $account)
    {
        $validated = $request->validated();
        $account->update($validated);
        return $this->success(new AccountResource($account), 'Account updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Account $account)
    {
        $account->delete();
        return $this->success(null, 'Account deleted successfully');
    }
}