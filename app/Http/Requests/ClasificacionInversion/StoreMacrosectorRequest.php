<?php

namespace App\Http\Requests\ClasificacionInversion;

use Illuminate\Foundation\Http\FormRequest;

class StoreMacrosectorRequest extends FormRequest
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
     * Reglas para registrar un macrosector.
     */
    public function rules(): array
    {
        return [
            'nombre' => [
                'required',
                'string',
                'max:150',
                'unique:macrosectores,nombre',
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
            'nombre.unique' => 'Ya existe un macrosector con este nombre.',
        ];
    }
}