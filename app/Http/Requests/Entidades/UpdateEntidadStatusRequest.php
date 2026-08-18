<?php

namespace App\Http\Requests\Entidades;

use Illuminate\Foundation\Http\FormRequest;

class UpdateEntidadStatusRequest extends FormRequest
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
     * el estado de una entidad.
     */
    public function rules(): array
    {
        return [
            'estado' => ['nullable', 'boolean'],
        ];
    }
}