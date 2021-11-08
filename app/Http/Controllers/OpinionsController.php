<?php

namespace App\Http\Controllers;

use App\Http\Requests\OpinionRequest;
use App\Models\Opinion;
use Orion\Http\Controllers\Controller;

class OpinionsController extends Controller
{
    protected $model = Opinion::class;

    protected $request = OpinionRequest::class;

    /**
     * The attributes that are used for searching.
     *
     * @return array
     */
    public function searchableBy(): array
    {
        return ['comment'];
    }

    public function filterableBy(): array
    {
        return ['rating', 'request_id', 'user_id', 'supplier_id'];
    }

    public function includes(): array
    {
        return ['supplier', 'request', 'user'];
    }
}
