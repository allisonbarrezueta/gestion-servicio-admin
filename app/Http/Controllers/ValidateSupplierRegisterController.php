<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ValidateSupplierRegisterController extends Controller

{
    /**
     * Handle the incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function __invoke(Request $request)
    {
        $step = $request->input('step');

        switch ($step) {
            case '1':
                $this->validate($request, [
                    'name' => ['required', 'string'],
                    'last_name' => ['required', 'string'],
                    'dni' => ['required', 'numeric'],
                    'email' => ['required', 'email', 'unique:users,email'],
                    'password' => ['required']
                ]);
                break;
            case '2':
                $this->validate($request, [
                    'ruc_image' => ['required'],
                    'dni_image' => ['required'],
                    'ruc' => ['required', 'numeric'],
                ]);
                break;
            default:
                break;
        }

        return response()->noContent();
    }
}
