<?php

namespace App\Http\Requests\ClasificacionInversion;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UpdateMacrosectorRequest extends FormRequest
{
    /**
     * La autorización se controla desde el controlador
     * mediante los permisos del módulo.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Normalizar los datos antes de validarlos.
     */
    protected function prepareForValidation(): void
    {
        $this->merge([
            'nombre' => trim((string) $this->input('nombre')),
        ]);
    }

    /**
     * Reglas para actualizar un macrosector.
     */
    public function rules(): array
    {
        $macrosector = $this->route('macrosector');

        $macrosectorId = is_object($macrosector)
            ? $macrosector->id
            : $macrosector;

        return [
            'nombre' => [
                'required',
                'string',
                'max:150',
                Rule::unique('macrosectores', 'nombre')
                    ->ignore($macrosectorId),
            ],
        ];
    }

    /**
     * Mensajes personalizados.
     */
    public function messages(): array
    {
        return [
            'nombre.required' => 'Debe ingresar el nombre del macrosector.',
            'nombre.string' => 'El nombre del macrosector no es válido.',
            'nombre.max' => 'El nombre del macrosector no puede superar los 150 caracteres.',
            'nombre.unique' => 'Ya existe otro macrosector con este nombre.',
        ];
    }
}