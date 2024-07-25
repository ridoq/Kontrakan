<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UpdateUserRequest extends FormRequest
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
            "name" => 'required|string|max:255',
            "address" => 'required|string|max:255',
            "phone_number" => ['required', 'numeric', Rule::unique('users', 'phone_number')->ignore($this->route('anggota'))],
            "email" => ['required', 'email', Rule::unique('users', 'email')->ignore($this->route('anggota'))],
            // 'password' => ['required', 'min:8', 'password'],
        ];
    }
}
