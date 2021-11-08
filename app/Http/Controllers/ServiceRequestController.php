<?php

namespace App\Http\Controllers;

use App\Http\Requests\RequestRequest;
use App\Models\Service;
use Orion\Http\Requests\Request as OrionRequest;
use Orion\Http\Controllers\RelationController;

class ServiceRequestController extends RelationController
{
    protected $model = Service::class;

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

    public function includes(): array
    {
        return ['category', 'service', 'user', 'media'];
    }

    protected function afterSave(OrionRequest $orionRequest, $service, $request)
    {
        $request->addMediaFromRequest('images')->toMediaCollection('images');
    }
}
