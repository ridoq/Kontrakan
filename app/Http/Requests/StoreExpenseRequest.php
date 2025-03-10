<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreExpenseRequest extends FormRequest
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
            'user_id' => 'required|exists:users,id',
            'amount' => 'required|numeric|min:0|not_regex:/-/',
            'expense_date' => 'required|date|before:tomorrow',
            'description' => 'nullable|string',
        ];
    }

    public function message() {
        return [
            'user_id.required' => 'User id tidak boleh kosong',
            'amount.required' => 'Nominal tidak boleh kosong ',
            'expense_date.required' => 'Tanggal pengeluaran tidak boleh kosong',
            
        ];
    }
}
