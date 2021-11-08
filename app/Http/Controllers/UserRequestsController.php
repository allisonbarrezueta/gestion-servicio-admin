<?php

namespace App\Http\Controllers;

use App\Http\Requests\RequestRequest;
use App\Models\Service;
use App\Models\User;
use Orion\Http\Requests\Request as OrionRequest;
use Orion\Http\Controllers\RelationController;

class UserRequestsController extends RelationController
{
    protected $model = User::class;

    protected $request = RequestRequest::class;

    protected $relation = 'requests';

    /**
     * The attributes that are used for searching.
     *
     * @return array
     */
    public function searchableBy(): array
    {
        return ['address', 'description'];
    }

    public function filterableBy(): array
    {
        return ['status'];
    }

    public function includes(): array
    {
        return ['category', 'service', 'media'];
    }
}
