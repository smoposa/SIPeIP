<?php

namespace App\Http\Requests\Roles;

use Illuminate\Foundation\Http\FormRequest;

class UpdateRoleAssignmentRequest extends FormRequest
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
            'roles' => [
                'nullable',
                'array',
            ],

            'roles.*' => [
                'integer',
                'exists:roles,id',
            ],
        ];
    }

    /**
     * Mensajes de validación.
     */
    public function messages(): array
    {
        return [
            'roles.array' =>
                'La selección de roles no es válida.',

            'roles.*.integer' =>
                'Uno de los roles seleccionados no es válido.',

            'roles.*.exists' =>
                'Uno de los roles seleccionados no existe.',
        ];
    }
}