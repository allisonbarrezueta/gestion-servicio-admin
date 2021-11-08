<?php

namespace App\Http\Requests;

use Orion\Http\Requests\Request;

class OrderRequest extends Request
{
    public function storeRules(): array
    {
        return [
            'user_id' => ['required', 'exists:users,id'],
            'supplier_id' => ['required', 'exists:users,id'],
            'bid_id' => ['required', 'exists:bids,id'],
            'request_id' => ['required', 'exists:requests,id'],
            'subtotal' => ['required', 'numeric'],
            'tax' => ['required', 'numeric'],
            'total' => ['required', 'numeric'],
        ];
    }
}
