<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateTransactionRequest extends FormRequest
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
            'account_id' => ['sometimes', 'exists:accounts,id'], // Optional: ensure it exists if provided
            'amount' => ['sometimes', 'numeric'], // Optional: ensure it's numeric if provided
            'transaction_date' => ['sometimes', 'date'], // Optional: ensure it's a valid date if provided
            'category' => ['sometimes', 'string'], // Optional: ensure it's a string if provided
            'description' => ['nullable', 'string'], // Optional: description must be a string if provided
        ];
    }
}