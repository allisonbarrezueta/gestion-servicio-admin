<?php

namespace App\Http\Requests;

use Orion\Http\Requests\Request as OrionRequest;

class RequestRequest extends OrionRequest
{
    public function storeRules(): array
    {
        return [
            'user_id' => ['required', 'exists:users,id'],
            'service_id' => ['required', 'exists:services,id'],
            'category_id' => ['sometimes', 'nullable', 'exists:categories,id'],
            'date' => 'required',
            'address' => ['required', 'string'],
            'description' => ['required', 'string'],
            'image' => ['required', 'image'],
        ];
    }

    public function updateRules(): array
    {
        return [
            'evidence' => ['sometimes', 'nullable', 'image'],
            'status' => ['required'],
        ];
    }
}
