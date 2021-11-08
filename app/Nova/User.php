<?php

namespace App\Nova;

use App\Nova\Actions\ApproveSupplier;
use App\Nova\Lenses\PendingSuppliers;
use Illuminate\Http\Request;
use Laravel\Nova\Fields\BelongsToMany;
use Laravel\Nova\Fields\Image;
use Laravel\Nova\Fields\Number;
use Laravel\Nova\Fields\Password;
use Laravel\Nova\Fields\Select;
use Laravel\Nova\Fields\Text;
use Laravel\Nova\Fields\Textarea;
use Maatwebsite\LaravelNovaExcel\Actions\DownloadExcel;
use NovaConditionalFields\Condition;

class User extends Resource
{
    /**
     * The model the resource corresponds to.
     *
     * @var string
     */
    public static $model = \App\Models\User::class;

    /**
     * The single value that should be used to represent the resource when being displayed.
     *
     * @var string
     */
    public static $title = 'name';

    /**
     * The columns that should be searched.
     *
     * @var array
     */
    public static $search = [
        'id', 'name', 'email',
    ];

    public static function label()
    {
        return __('Usuarios');
    }

    public static function singularLabel()
    {
        return __('Usuario');
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
            Text::make('Name')
                ->sortable()
                ->rules('required', 'max:255'),
            Text::make('Apellidos', 'last_name'),
            Text::make('Cédula', 'dni')->hideFromIndex(),
            Image::make('Foto Cédula', 'dni_image')->hideFromIndex(),
            Text::make('RUC', 'ruc')->hideFromIndex(),
            Image::make('Foto RUC', 'ruc_image')->hideFromIndex(),
            Text::make('Email')
                ->sortable()
                ->rules('required', 'email', 'max:254')
                ->creationRules('unique:users,email')
                ->updateRules('unique:users,email,{{resourceId}}'),
            Password::make('Password')
                ->onlyOnForms()
                ->creationRules('required', 'string', 'min:8')
                ->updateRules('nullable', 'string', 'min:8'),
            Text::make('Teléfono', 'phone')->hideFromIndex(),
            Textarea::make('Dirección', 'address')->hideFromIndex(),
            Text::make('Compañía', 'company_name')->hideFromIndex(),
            Textarea::make('Descripción', 'company_description')->hideFromIndex(),
            Text::make('Fee', 'fee')->hideFromIndex(),
            Select::make('Tipo', 'type')->options([
                'client' => 'Cliente',
                'supplier' => 'Proveedor',
                'admin' => 'Administrador'
            ])->displayUsingLabels(),
            BelongsToMany::make('Categorías', 'categories', Category::class)
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
        return [
            new PendingSuppliers
        ];
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
            (new ApproveSupplier)->onlyOnDetail(),
            (new DownloadExcel)->askForWriterType()->only('name', 'last_name', 'dni', 'ruc', 'phone', 'address', 'email', 'company_name', 'company_description', 'type', 'fee', 'approved', 'created_at')->withHeadings()->withName('Descargar'),
        ];
    }
}
