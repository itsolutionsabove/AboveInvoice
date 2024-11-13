<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class RegisterRequest extends FormRequest
{

    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'name' => 'required|string|max:255',
            'last_name' => 'required|string|max:255',
            'gender' => 'required|string|in:male,female',
            'phone' => 'nullable|numeric|digits_between:7,13',
            'country_code' => 'nullable|string|min:2|max:5',
            'email' => 'required|string|email|max:255|unique:users,email',
            'password' => 'required|string',
        ];
    }
}
