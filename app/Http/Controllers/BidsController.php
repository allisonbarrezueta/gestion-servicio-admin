<?php

namespace App\Http\Controllers;

use App\Http\Requests\BidRequest;
use App\Models\Bid;
use Illuminate\Http\Request;
use Orion\Http\Controllers\Controller;

class BidsController extends Controller
{
    protected $model = Bid::class;

    protected $request = BidRequest::class;

    public function searchableBy(): array
    {
        return ['offer', 'created_at'];
    }

    public function filterableBy(): array
    {
        return ['status', 'request_id', 'user_id', 'created_at'];
    }

    public function includes(): array
    {
        return ['request', 'user', 'request.service'];
    }
}
