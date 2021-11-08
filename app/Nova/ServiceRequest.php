<?php

namespace App\Nova;

use Illuminate\Http\Request;
use Laravel\Nova\Fields\BelongsTo;
use Laravel\Nova\Fields\DateTime;
use Laravel\Nova\Fields\HasMany;
use Laravel\Nova\Fields\Text;
use Laravel\Nova\Fields\Image;
use Laravel\Nova\Fields\Select;
use Laravel\Nova\Fields\Textarea;
use Laravel\Nova\Http\Requests\NovaRequest;
use Maatwebsite\LaravelNovaExcel\Actions\DownloadExcel;

class ServiceRequest extends Resource
{
    /**
     * The model the resource corresponds to.
     *
     * @var string
     */
    public static $model = \App\Models\Request::class;

    /**
     * The single value that should be used to represent the resource when being displayed.
     *
     * @var string
     */
    public static $title = 'id';

    /**
     * The columns that should be searched.
     *
     * @var array
     */
    public static $search = [
        'id',
    ];

    public static function label()
    {
        return __('Solicitudes de Servicio');
    }

    public static function singularLabel()
    {
        return __('Solicitud de Servicio');
    }

    /**
     * Get the fields displayed by the resource.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function fields(Request $request)
    {
        return [
            BelongsTo::make('Usuario', 'user', User::class),
            BelongsTo::make('Proveedor', 'supplier', User::class)->hideFromIndex(),
            BelongsTo::make('Categoría', 'category', Category::class)->hideFromIndex(),
            BelongsTo::make('Servicio', 'service', Service::class),
            DateTime::make('Fecha', 'date'),
            Textarea::make('Descripción', 'description')->hideFromIndex(),
            Textarea::make('Comentario Final', 'comment')->hideFromIndex(),
            Image::make('Evidencia', 'evidence'),
            Select::make('Estado', 'status')->options([
                'pending' => 'Pendiente',
                'in_progress' => 'En Progreso',
                'completed' => 'Completada',
                'failed' => 'Fallida'
            ])->displayUsingLabels(),
            DateTime::make('Fecha de creación', 'created_at'),
            HasMany::make('Ofertas', 'bids', Bid::class)
        ];
    }

    /**
     * Get the cards available for the request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function cards(Request $request)
    {
        return [];
    }

    /**
     * Get the filters available for the resource.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function filters(Request $request)
    {
        return [];
    }

    /**
     * Get the lenses available for the resource.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function lenses(Request $request)
    {
        return [];
    }

    /**
     * Get the actions available for the resource.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function actions(Request $request)
    {
        return [
            (new DownloadExcel)->askForWriterType()->allFields()->withHeadings()->withName('Descargar'),
        ];
    }
}
