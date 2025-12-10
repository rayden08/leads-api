<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateLeadInfoRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'name' => ['sometimes', 'string', 'max:255'],
            'description' => ['sometimes', 'string'],
            'customer_id' => ['sometimes', 'exists:customers,id'],
            'product_id' => ['sometimes', 'nullable', 'exists:products,id']
        ];
    }
}