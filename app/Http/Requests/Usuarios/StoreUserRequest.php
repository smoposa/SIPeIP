<?php

namespace App\Http\Requests\Usuarios;

use Illuminate\Foundation\Http\FormRequest;

class StoreUserRequest extends FormRequest
{
    /**
     * Determinar si el usuario está autorizado.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Reglas de validación.
     */
    public function rules(): array
    {
        return [
            'identificacion' => [
                'required',
                'string',
                'max:20',
                'unique:users,identificacion',
            ],

            'nombres' => [
                'required',
                'string',
                'max:100',
            ],

            'apellidos' => [
                'required',
                'string',
                'max:100',
            ],

            'email' => [
                'required',
                'email',
                'max:255',
                'unique:users,email',
            ],

            'cargo' => [
                'nullable',
                'string',
                'max:150',
            ],

            'rol_id' => [
                'required',
                'integer',
                'exists:roles,id',
            ],

            'entidad_id' => [
                'required',
                'integer',
                'exists:entidades,id',
            ],
        ];
    }
}