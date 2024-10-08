<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\Budget;
use App\Http\Requests\StoreBudgetRequest;
use App\Http\Requests\UpdateBudgetRequest;
use App\Http\Resources\BudgetResource;
use App\Traits\ApiResponseTrait;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Auth;

class BudgetController extends Controller
{
    use ApiResponseTrait;
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request) : JsonResponse
    {
        $query = Budget::where('user_id', Auth::user()->id);

        $search = $request->query('search_query', '');
        if ($search !== '') {
            $query->where(function ($query) use ($search) {
                $query->where('amount', 'like', '%'.$search.'%')
                    ->orWhere('category', 'like', '%'.$search.'%');
            });
        }

        $limit = $request->query('limit', 10);
        $page = $request->query('page', 1);

        $result = $query->orderByDesc('id')
                        ->paginate($limit, ['*'], 'page', $page);

        return $this->success([
            'data' => BudgetResource::collection($result->items()),
            'total' => $result->total(),
            'limit' => $result->perPage(),
            'page' => $result->currentPage(),
            'totalPages' => $result->lastPage(),
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreBudgetRequest $request) : JsonResponse
    {
        $validated = $request->validated();
        $validated['user_id'] = Auth::id();

        $budget = Budget::create($validated);

        $budget->update();

        return $this->success(new BudgetResource($budget), 'Budget created successfully', Response::HTTP_CREATED);
    }

    /**
     * Display the specified resource.
     */
    public function show(Budget $budget)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateBudgetRequest $request, Budget $budget) : JsonResponse
    {
        $validated = $request->validated();
        $budget->update($validated);
        return $this->success(new BudgetResource($budget), 'Budget updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Budget $budget) : JsonResponse
    {
        $budget->delete();
        return $this->success(null, 'Budget deleted successfully');
    }
}
