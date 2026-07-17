<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ProgramaRequest extends FormRequest
{
    /**
     * Determina si el usuario está autorizado.
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

            'nombre' => [
                'required',
                'string',
                'max:255',
            ],

            'descripcion' => [
                'nullable',
                'string',
            ],

            'periodo_inicio' => [
                'required',
                'integer',
                'digits:4',
            ],

            'periodo_fin' => [
                'required',
                'integer',
                'digits:4',
                'gte:periodo_inicio',
            ],

            'responsable_id' => [
                'required',
                'exists:users,id',
            ],

            'objetivos' => [
                'required',
                'array',
                'min:1',
            ],

            'objetivos.*' => [
                'exists:objetivos,id',
            ],

            'estado' => [
                'required',
                'in:Activo,Inactivo',
            ],

        ];
    }

    /**
     * Mensajes personalizados.
     */
    public function messages(): array
    {
        return [

            'nombre.required' => 'Debe ingresar el nombre del programa.',

            'periodo_inicio.required' => 'Debe indicar el período de inicio.',

            'periodo_fin.required' => 'Debe indicar el período de finalización.',

            'periodo_fin.gte' => 'El período final debe ser mayor o igual al período inicial.',

            'responsable_id.required' => 'Debe seleccionar un responsable.',

            'responsable_id.exists' => 'El responsable seleccionado no es válido.',

            'objetivos.required' => 'Debe seleccionar al menos un objetivo estratégico.',

            'objetivos.array' => 'Los objetivos seleccionados no son válidos.',

            'objetivos.min' => 'Debe seleccionar al menos un objetivo estratégico.',

            'estado.required' => 'Debe seleccionar el estado del programa.',

        ];
    }
}