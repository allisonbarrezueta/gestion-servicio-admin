<?php

namespace App\Http\Requests;

use Orion\Http\Requests\Request;

class ServiceRequest extends Request
{
    public function commonRules(): array
    {
        return [
            'name' => ['required', 'string', 'max:256'],
            'image' => ['required', 'image'],
            'status' => ['sometimes', 'boolean'],
        ];
    }
}
