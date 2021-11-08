<?php

namespace App\Http\Requests;

use Orion\Http\Requests\Request;

class BidRequest extends Request
{
    public function storeRules(): array
    {
        return [
            'description' => ['required', 'string', 'max:500'],
            'offer' => ['required', 'numeric', 'min:1'],
            'status' => ['required', 'in:pending,accepted,rejected'],
            'user_id' => ['required',  'exists:users,id'],
            'request_id' => ['required', 'exists:requests,id']
        ];
    }

    public function updateRules(): array
    {
        return [
            'description' => ['required', 'string', 'max:500'],
            'offer' => ['required', 'numeric', 'min:1'],
        ];
    }
}
