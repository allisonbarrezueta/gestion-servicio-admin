<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Orion\Http\Requests\Request;

class CategoryRequest extends Request
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
