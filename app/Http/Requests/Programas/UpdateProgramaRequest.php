<?php

namespace App\Http\Requests\Programas;

use Illuminate\Foundation\Http\FormRequest;

class UpdateProgramaRequest extends FormRequest
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
     * Preparar los datos antes de validarlos.
     */
    protected function prepareForValidation(): void
    {
        $this->merge([
            'nombre' => is_string($this->nombre)
                ? trim($this->nombre)
                : $this->nombre,

            'descripcion' => is_string($this->descripcion)
                ? trim($this->descripcion)
                : $this->descripcion,
        ]);
    }

    /**
     * Reglas de validación.
     */
    public function rules(): array
    {
        return [
            'nombre' => [
                'bail',
                'required',
                'string',
                'max:255',
            ],

            'descripcion' => [
                'nullable',
                'string',
                'max:5000',
            ],

            'periodo_inicio' => [
                'bail',
                'required',
                'integer',
                'digits:4',
                'between:2000,2100',
            ],

            'periodo_fin' => [
                'bail',
                'required',
                'integer',
                'digits:4',
                'between:2000,2100',
                'gte:periodo_inicio',
            ],

            'responsable_id' => [
                'bail',
                'required',
                'integer',
                'exists:users,id',
            ],

            'objetivos' => [
                'bail',
                'required',
                'array',
                'min:1',
            ],

            'objetivos.*' => [
                'bail',
                'integer',
                'distinct',
                'exists:objetivos,id',
            ],
        ];
    }

    /**
     * Mensajes personalizados.
     */
    public function messages(): array
    {
        return [
            'nombre.required' =>
                'Debe ingresar el nombre del programa.',

            'nombre.max' =>
                'El nombre del programa no puede superar los 255 caracteres.',

            'descripcion.max' =>
                'La descripción no puede superar los 5000 caracteres.',

            'periodo_inicio.required' =>
                'Debe indicar el período inicial.',

            'periodo_inicio.integer' =>
                'El período inicial debe ser un año válido.',

            'periodo_inicio.digits' =>
                'El período inicial debe contener cuatro dígitos.',

            'periodo_inicio.between' =>
                'El período inicial debe encontrarse entre 2000 y 2100.',

            'periodo_fin.required' =>
                'Debe indicar el período final.',

            'periodo_fin.integer' =>
                'El período final debe ser un año válido.',

            'periodo_fin.digits' =>
                'El período final debe contener cuatro dígitos.',

            'periodo_fin.between' =>
                'El período final debe encontrarse entre 2000 y 2100.',

            'periodo_fin.gte' =>
                'El período final debe ser mayor o igual al período inicial.',

            'responsable_id.required' =>
                'Debe seleccionar un responsable.',

            'responsable_id.integer' =>
                'El responsable seleccionado no es válido.',

            'responsable_id.exists' =>
                'El responsable seleccionado no existe.',

            'objetivos.required' =>
                'Debe seleccionar al menos un objetivo estratégico.',

            'objetivos.array' =>
                'Los objetivos seleccionados no son válidos.',

            'objetivos.min' =>
                'Debe seleccionar al menos un objetivo estratégico.',

            'objetivos.*.integer' =>
                'Uno de los objetivos seleccionados no es válido.',

            'objetivos.*.distinct' =>
                'No puede seleccionar el mismo objetivo más de una vez.',

            'objetivos.*.exists' =>
                'Uno de los objetivos seleccionados no existe.',
        ];
    }

    /**
     * Nombres legibles de los atributos.
     */
    public function attributes(): array
    {
        return [
            'nombre' => 'nombre del programa',
            'descripcion' => 'descripción',
            'periodo_inicio' => 'período inicial',
            'periodo_fin' => 'período final',
            'responsable_id' => 'responsable',
            'objetivos' => 'objetivos estratégicos',
            'objetivos.*' => 'objetivo estratégico',
        ];
    }
}