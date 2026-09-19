<?php

namespace App\Http\Requests\ClasificacionInversion;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UpdateSectorRequest extends FormRequest
{
    /**
     * La autorización se controlará mediante
     * los permisos definidos en el controlador.
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
     * Reglas para actualizar un sector.
     */
    public function rules(): array
    {
        $sector = $this->route('sector');

        $sectorId = is_object($sector)
            ? $sector->id
            : $sector;

        return [
            'macrosector_id' => [
                'required',
                'integer',
                Rule::exists('macrosectores', 'id')
                    ->where('estado', 'Activo'),
            ],

            'nombre' => [
                'required',
                'string',
                'max:150',
                Rule::unique('sectores', 'nombre')
                    ->where(
                        fn ($consulta) => $consulta->where(
                            'macrosector_id',
                            $this->input('macrosector_id')
                        )
                    )
                    ->ignore($sectorId),
            ],
        ];
    }

    /**
     * Mensajes personalizados.
     */
    public function messages(): array
    {
        return [
            'macrosector_id.required' => 'Debe seleccionar un macrosector.',
            'macrosector_id.integer' => 'El macrosector seleccionado no es válido.',
            'macrosector_id.exists' => 'El macrosector seleccionado no existe o se encuentra inactivo.',

            'nombre.required' => 'Debe ingresar el nombre del sector.',
            'nombre.string' => 'El nombre del sector no es válido.',
            'nombre.max' => 'El nombre del sector no puede superar los 150 caracteres.',
            'nombre.unique' => 'Ya existe otro sector con este nombre dentro del macrosector seleccionado.',
        ];
    }
}