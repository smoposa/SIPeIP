<?php

namespace App\Http\Requests\Programas;

use Illuminate\Foundation\Http\FormRequest;

class UpdateProgramaStatusRequest extends FormRequest
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
            'estado' => [
                'required',
                'boolean',
            ],
        ];
    }

    /**
     * Mensajes personalizados.
     */
    public function messages(): array
    {
        return [
            'estado.required' =>
                'Debe indicar el estado administrativo del programa.',

            'estado.boolean' =>
                'El estado administrativo seleccionado no es válido.',
        ];
    }

    /**
     * Nombres legibles de los atributos.
     */
    public function attributes(): array
    {
        return [
            'estado' => 'estado administrativo',
        ];
    }
}