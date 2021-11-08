<?php

namespace App\Http\Controllers;

use App\Http\Requests\OpinionRequest;
use App\Models\User;
use Orion\Http\Controllers\RelationController;

class UserOpinionsController extends RelationController
{
    protected $model = User::class;

    protected $request = OpinionRequest::class;

    protected $relation = 'opinions';

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
        return ['rating'];
    }

    public function includes(): array
    {
        return ['supplier', 'request', 'user'];
    }
}
