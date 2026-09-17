<?php

namespace App\Http\Requests\Indicadores;

use Illuminate\Foundation\Http\FormRequest;

class UpdateIndicadorRequest extends FormRequest
{
    /**
     * Autorizar la solicitud.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Reglas para actualizar un indicador.
     */
    public function rules(): array
    {
        return [
            'meta_id' => [
                'required',
                'integer',
                'exists:metas,id',
            ],

            'nombre' => [
                'required',
                'string',
                'max:255',
            ],

            'tipo' => [
                'required',
                'string',
                'max:50',
            ],

            'formula' => [
                'required',
                'string',
            ],

            'unidad_medida' => [
                'required',
                'string',
                'max:50',
            ],

            'frecuencia' => [
                'required',
                'string',
                'max:50',
            ],

            'responsable_id' => [
                'required',
                'integer',
                'exists:users,id',
            ],
        ];
    }

    /**
     * Nombres comprensibles para los campos.
     */
    public function attributes(): array
    {
        return [
            'meta_id' => 'meta institucional',
            'nombre' => 'nombre del indicador',
            'tipo' => 'tipo de indicador',
            'formula' => 'fórmula',
            'unidad_medida' => 'unidad de medida',
            'frecuencia' => 'frecuencia',
            'responsable_id' => 'responsable',
        ];
    }
}