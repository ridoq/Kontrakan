<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreUserRequest extends FormRequest
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
            'photo_profile' => 'required|file|mimes:jpeg,png,jpg|max:2048',
            "name" => 'required|string|max:255',
            "address" => 'required|string|max:255',
            "phone_number" => 'required|numeric|unique:users,phone_number',
            "email" => 'required|email|unique:users,email',
            "password" => 'required|min:8',
        ];
    }
}
