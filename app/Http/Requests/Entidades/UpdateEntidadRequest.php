<?php

namespace App\Http\Requests\Entidades;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UpdateEntidadRequest extends FormRequest
{
    /**
     * Determinar si el usuario está autorizado
     * para realizar esta solicitud.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Reglas de validación para actualizar una entidad.
     */
    public function rules(): array
    {
        $id = $this->route('id');

        return [
            'codigoInstitucional' => [
                'required',
                'string',
                'max:50',
                Rule::unique('entidades', 'codigoInstitucional')->ignore($id),
            ],

            'ruc' => [
                'required',
                'string',
                'max:13',
                Rule::unique('entidades', 'ruc')->ignore($id),
            ],

            'nombre' => ['required', 'string', 'max:255'],
            'siglas' => ['nullable', 'string', 'max:50'],
            'tipoEntidad' => ['required', 'string', 'max:100'],
            'nivelGobierno' => ['required', 'string', 'max:100'],
            'provincia' => ['required', 'string', 'max:100'],
            'canton' => ['required', 'string', 'max:100'],
            'parroquia' => ['nullable', 'string', 'max:100'],
            'direccion' => ['nullable', 'string', 'max:255'],
            'telefono' => ['nullable', 'string', 'max:30'],
            'correoInstitucional' => ['nullable', 'email', 'max:255'],
        ];
    }
}