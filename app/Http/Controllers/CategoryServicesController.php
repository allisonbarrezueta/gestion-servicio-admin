<?php

namespace App\Http\Controllers;

use App\Http\Requests\ServiceRequest;
use App\Models\Category;
use App\Models\Service;
use Orion\Http\Controllers\RelationController;

class CategoryServicesController extends RelationController
{
    protected $model = Category::class;

    protected $request = ServiceRequest::class;

    protected $relation = 'services';

    /**
     * The attributes that are used for searching.
     *
     * @return array
     */
    public function searchableBy(): array
    {
        return ['name'];
    }
}
