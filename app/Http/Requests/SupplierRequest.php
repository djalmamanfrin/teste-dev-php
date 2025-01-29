<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;
use App\Rules\CPF_CNPJ;

class SupplierRequest extends FormRequest
{
    public function rules(): array
    {
        $id = $this->route('supplier');

        return [
            'name' => 'required|string|max:255',
            'identifier' => [
                'required',
                'string',
                'max:255',
                Rule::unique('suppliers', 'identifier')->ignore($id),
                new CPF_CNPJ(),
            ],
            'contact' => 'required|string|max:255',
            'address.street' => 'nullable|string|max:255',
            'address.number' => 'nullable|string|max:255',
            'address.neighborhood' => 'nullable|string|max:255',
            'address.city' => 'nullable|string|max:255',
            'address.state' => 'nullable|string|max:255',
            'address.postal_code' => 'nullable|string|max:255',
            'address.country' => 'nullable|string|max:255',
        ];
    }
}

