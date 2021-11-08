<?php

namespace App\Http\Controllers;

use App\Models\Request;
use Orion\Http\Requests\Request as OrionRequest;
use Orion\Http\Controllers\RelationController;

class RequestBidsController extends RelationController
{
    protected $model = Request::class;

    protected $relation = 'bids';

    public function beforeSave(OrionRequest $orionRequest, $request, $bid)
    {
        $bid->user()->associate(auth()->user());
    }

    public function searchableBy(): array
    {
        return ['offer'];
    }

    public function filterableBy(): array
    {
        return ['status'];
    }

    public function includes(): array
    {
        return ['request', 'user'];
    }
}
