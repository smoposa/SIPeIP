<?php

namespace App\Http\Requests\Indicadores;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class StoreIndicadorRequest extends FormRequest
{
    /**
     * Autorizar la solicitud.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Reglas para registrar un indicador.
     */
    public function rules(): array
    {
        return [
            'plan_id' => [
                'required',
                'integer',
                Rule::exists('planes', 'id')
                    ->where(
                        'estado',
                        'Activo'
                    ),
            ],

            'objetivo_id' => [
                'required',
                'integer',
                Rule::exists('objetivos', 'id')
                    ->where(
                        fn ($query) => $query
                            ->where(
                                'plan_id',
                                $this->input('plan_id')
                            )
                            ->where(
                                'estado',
                                'Activo'
                            )
                    ),
            ],

            'meta_id' => [
                'required',
                'integer',
                Rule::exists('metas', 'id')
                    ->where(
                        fn ($query) => $query
                            ->where(
                                'objetivo_id',
                                $this->input('objetivo_id')
                            )
                            ->where(
                                'estado',
                                'Activo'
                            )
                    ),
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
                Rule::exists('users', 'id')
                    ->where(
                        'estado',
                        'Activo'
                    ),
            ],
        ];
    }

    /**
     * Nombres comprensibles para los campos.
     */
    public function attributes(): array
    {
        return [
            'plan_id' => 'plan institucional',
            'objetivo_id' => 'objetivo estratégico',
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