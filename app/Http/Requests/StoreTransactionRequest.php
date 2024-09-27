<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreTransactionRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'account_id' => ['required', 'exists:accounts,id'], // Ensure account_id is required and exists in accounts table
            'amount' => ['required', 'numeric'], // Ensure amount is required and is a number
            'transaction_date' => ['required', 'date'], // Ensure transaction date is a valid date
            'category' => ['required', 'string'], // Ensure category is required and is a string
            'description' => ['nullable', 'string'], // Description is optional but must be a string if provided
        ];
    }
}