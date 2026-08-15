<?php

namespace App\Http\Requests\Roles;

use Illuminate\Foundation\Http\FormRequest;

class UpdateRoleStatusRequest extends FormRequest
{
    /**
     * Determinar si el usuario está autorizado
     * para realizar esta solicitud.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Reglas de validación para actualizar
     * el estado del rol.
     */
    public function rules(): array
    {
        return [
            'estado' => [
                'nullable',
                'boolean',
            ],
        ];
    }
}