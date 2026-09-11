<?php

namespace App\Http\Requests\Planes;

use Illuminate\Foundation\Http\FormRequest;

class UpdatePlanStatusRequest extends FormRequest
{
    /**
     * Determinar si el usuario está autorizado.
     */
    public function authorize(): bool
    {
        return auth()->check();
    }

    /**
     * Reglas de validación para cambiar
     * el estado administrativo del plan.
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

    /**
     * Mensajes personalizados de validación.
     */
    public function messages(): array
    {
        return [
            'estado.boolean' =>
                'El estado del plan debe ser válido.',
        ];
    }
}