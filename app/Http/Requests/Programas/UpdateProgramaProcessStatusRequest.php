<?php

namespace App\Http\Requests\Programas;

use App\Enums\EstadoProcesoPrograma;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UpdateProgramaProcessStatusRequest extends FormRequest
{
    /**
     * La autorización se controla mediante
     * middleware y Controller.
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
            'estado_proceso' => [
                'required',
                'string',
                Rule::in(
                    EstadoProcesoPrograma::values()
                ),
            ],
        ];
    }

    /**
     * Mensajes personalizados.
     */
    public function messages(): array
    {
        return [
            'estado_proceso.required' =>
                'Debe seleccionar el estado del proceso.',

            'estado_proceso.string' =>
                'El estado del proceso seleccionado no es válido.',

            'estado_proceso.in' =>
                'El estado del proceso seleccionado no está permitido.',
        ];
    }

    /**
     * Nombres legibles de los atributos.
     */
    public function attributes(): array
    {
        return [
            'estado_proceso' => 'estado del proceso',
        ];
    }
}