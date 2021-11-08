<?php

namespace App\Http\Controllers;

use App\Http\Requests\CategoryRequest;
use App\Models\Category;
use Illuminate\Http\Request;
use Orion\Concerns\DisableAuthorization;
use Orion\Concerns\DisablePagination;
use Orion\Http\Controllers\Controller;

class CategoriesController extends Controller
{
    use DisableAuthorization;
    use DisablePagination;

    protected $model = Category::class;

    protected $request = CategoryRequest::class;

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

    public function filterableBy(): array
    {
        return ['status'];
    }

    public function exposedScopes(): array
    {
        return ['supplier'];
    }

    public function getImageAttribute($value)
    {
        $baseUrl = config(('app.name'));
        return "{$baseUrl}/{$value}";
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
