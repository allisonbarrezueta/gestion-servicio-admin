<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class RegisterRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'type' => ['required', 'in:admin,client,supplier'],
            'name' => ['required', 'string'],
            'last_name' => ['required', 'string'],
            'dni' => ['required', 'numeric'],
            'email' => ['required', 'email', 'unique:users,email'],
            'password' => ['required'],
            'ruc' => ['nullable', 'numeric'],
            'phone' => ['nullable', 'max:20'],
            'address' => ['nullable', 'string', 'max:255'],
            'company_name' => ['nullable', 'string', 'max:100'],
            'company_description' => ['nullable', 'string', 'max:255'],
            'device_name' => ['required'],
            'services' => ['sometimes', 'array']
        ];
    }

    /**
     * Get the error messages for the defined validation rules.
     *
     * @return array
     */
    public function messages()
    {
        return [
            'email.required' => 'Email requerido',
            'email.email' => 'Email inválido',
            'email.email' => 'El Email ya se encuentra registrado',
            'password.required' => 'Contraseña requerida',
            'name.required' => 'Nombres requeridos',
            'lastname.required' => 'Apellidos requeridos',
            'dni.required' => 'Cédula requerida',
            'dni.numeric' => 'Cédula solo puede contener números',
            'dni.min' => 'Cédula solo puede mínimo 10 números',
        ];
    }
}
