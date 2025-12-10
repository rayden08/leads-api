<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class LeadRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        // Rules untuk CREATE
        $rules = [
            'name' => ['required', 'string', 'max:255'],
            'description' => ['nullable', 'string'],
            'status' => ['nullable', Rule::in(['new', 'contacted', 'unqualified', 'in_progress', 'converted', 'closed'])],
            'customer_id' => ['required', 'exists:customers,id'],
            'product_id' => ['nullable', 'exists:products,id']
        ];

        // Jika method PUT/PATCH (update), customer_id jadi optional
        if ($this->isMethod('put') || $this->isMethod('patch')) {
            $rules['customer_id'] = ['sometimes', 'exists:customers,id'];
            $rules['name'] = ['sometimes', 'string', 'max:255']; // name juga optional saat update
        }

        return $rules;
    }

    public function messages(): array
    {
        return [
            'customer_id.required' => 'Customer is required when creating a new lead',
            'customer_id.exists' => 'Selected customer does not exist',
            'product_id.exists' => 'Selected product does not exist'
        ];
    }
}