<?php

namespace App\Http\Requests;

use Orion\Http\Requests\Request;

class OpinionRequest extends Request
{
    public function storeRules(): array
    {
        return [
            'user_id' => ['required', 'exists:users,id'],
            'supplier_id' => ['required', 'exists:users,id'],
            'request_id' => ['required', 'exists:requests,id'],
            'comment' => ['required', 'string', 'max:255'],
            'rating' => ['required', 'numeric', 'in:1,2,3,4,5'],
        ];
    }
}
