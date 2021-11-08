<?php

namespace App\Http\Controllers;

use App\Http\Requests\ServiceRequest;
use App\Models\Service;
use Illuminate\Http\Request;
use Illuminate\Pagination\Paginator;
use Orion\Concerns\DisableAuthorization;
use Orion\Http\Controllers\Controller;

class ServicesController extends Controller
{
    use DisableAuthorization;

    protected $model = Service::class;

    protected $request = ServiceRequest::class;

    /**
     * The attributes that are used for searching.
     *
     * @return array
     */
    public function searchableBy(): array
    {
        return ['name'];
    }

    public function filterableBy(): array
    {
        return ['status', 'category_id'];
    }

    public function includes(): array
    {
        return ['category'];
    }

    protected function afterStore(Request $request, $model)
    {
        $path = $request->image->store('services');
        $model->image = $path;
        $model->save();
    }

    protected function afterUpdate(Request $request, $model)
    {
        $path = $request->image->store('services');
        $model->image = $path;
        $model->save();
    }
}
