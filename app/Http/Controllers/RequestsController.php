<?php

namespace App\Http\Controllers;

use App\Http\Requests\RequestRequest;
use App\Models\Request;
use Orion\Http\Controllers\Controller;
use Orion\Http\Requests\Request as OrionRequest;

class RequestsController extends Controller
{
    protected $model = Request::class;

    protected $request = RequestRequest::class;

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

    public function filterableBy(): array
    {
        return ['status', 'user_id', 'created_at', 'service_id', 'category_id', 'supplier_id', 'date'];
    }

    public function sortableBy(): array
    {
        return ['created_at'];
    }

    public function exposedScopes(): array
    {
        return ['withActiveOffer', 'withInactiveOffer'];
    }

    protected function afterSave(OrionRequest $orionRequest, $request)
    {
        if ($orionRequest->hasFile('image')) {
            $file = $orionRequest->file('image');
            $request->addMedia($file)
                ->toMediaCollection('images');
        }

        if ($orionRequest->hasFile('evidence')) {
            $request->evidence = $orionRequest->evidence->store('evidences');
            $request->save();
        }
    }
}
