<?php

namespace App\Http\Requests;

use Orion\Http\Requests\Request as OrionRequest;

class ServiceRequestRequest extends OrionRequest
{
    public function storeRules(): array
    {
        return [
            'category_id' => ['sometimes', 'nullable', 'exists:categories,id'],
            'date' => 'required',
            'address' => ['required', 'string'],
            'description' => ['required', 'string'],
            'images' => ['required', 'array'],
            'images.*' => ['image', 'mimes:jpeg,png,jpg', 'max:2048']
        ];
    }
}
