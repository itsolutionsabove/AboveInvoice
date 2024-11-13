<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class AddRateRequest extends FormRequest
{

    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'product_id' => 'required|exists:products,id',
            'rate' => 'required|numeric|min:1|max:5',
            'comment' => 'nullable|string',
        ];
    }
}
