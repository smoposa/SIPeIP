<?php

namespace App\Http\Requests\Usuarios;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UpdateUserRequest extends FormRequest
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
        $usuarioId = $this->route('id');

        return [
            'identificacion' => [
                'required',
                'string',
                'max:20',
                Rule::unique('users', 'identificacion')->ignore($usuarioId),
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
                Rule::unique('users', 'email')->ignore($usuarioId),
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
                'nullable',
                'integer',
                'exists:entidades,id',
            ],
        ];
    }
}