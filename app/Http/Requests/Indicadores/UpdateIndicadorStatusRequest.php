<?php

namespace App\Http\Requests\Indicadores;

use Illuminate\Foundation\Http\FormRequest;

class UpdateIndicadorStatusRequest extends FormRequest
{
    /**
     * Autorizar la solicitud.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Reglas para actualizar el estado.
     */
    public function rules(): array
    {
        return [
            'estado' => [
                'required',
                'boolean',
            ],
        ];
    }

    /**
     * Nombres comprensibles para los campos.
     */
    public function attributes(): array
    {
        return [
            'estado' => 'estado del indicador',
        ];
    }
}