<?php

namespace App\Http\Requests\ClasificacionInversion;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UpdateSubsectorRequest extends FormRequest
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
            'codigo' => strtoupper(
                trim((string) $this->input('codigo'))
            ),

            'nombre' => trim(
                (string) $this->input('nombre')
            ),

            'nivel_gobierno' => trim(
                (string) $this->input(
                    'nivel_gobierno',
                    'Nacional'
                )
            ),
        ]);
    }

    /**
     * Reglas para actualizar un subsector.
     */
    public function rules(): array
    {
        $subsector = $this->route('subsector');

        $subsectorId = is_object($subsector)
            ? $subsector->id
            : $subsector;

        return [
            'sector_id' => [
                'required',
                'integer',
                Rule::exists('sectores', 'id')
                    ->where('estado', 'Activo'),
            ],

            'codigo' => [
                'required',
                'string',
                'max:10',
                'regex:/^[A-Z][0-9]{4}$/',
                Rule::unique('subsectores', 'codigo')
                    ->ignore($subsectorId),
            ],

            'nombre' => [
                'required',
                'string',
                'max:255',
                Rule::unique('subsectores', 'nombre')
                    ->where(
                        fn ($consulta) => $consulta->where(
                            'sector_id',
                            $this->input('sector_id')
                        )
                    )
                    ->ignore($subsectorId),
            ],

            'nivel_gobierno' => [
                'required',
                'string',
                'in:Nacional',
            ],
        ];
    }

    /**
     * Mensajes personalizados.
     */
    public function messages(): array
    {
        return [
            'sector_id.required' => 'Debe seleccionar un sector.',
            'sector_id.integer' => 'El sector seleccionado no es válido.',
            'sector_id.exists' => 'El sector seleccionado no existe o se encuentra inactivo.',

            'codigo.required' => 'Debe ingresar el código oficial del subsector.',
            'codigo.max' => 'El código no puede superar los 10 caracteres.',
            'codigo.regex' => 'El código debe tener una letra mayúscula seguida de cuatro números. Ejemplo: A0102.',
            'codigo.unique' => 'Ya existe otro subsector con este código.',

            'nombre.required' => 'Debe ingresar el nombre del subsector.',
            'nombre.string' => 'El nombre del subsector no es válido.',
            'nombre.max' => 'El nombre del subsector no puede superar los 255 caracteres.',
            'nombre.unique' => 'Ya existe otro subsector con este nombre dentro del sector seleccionado.',

            'nivel_gobierno.required' => 'Debe indicar el nivel de gobierno.',
            'nivel_gobierno.in' => 'El nivel de gobierno debe ser Nacional.',
        ];
    }
}