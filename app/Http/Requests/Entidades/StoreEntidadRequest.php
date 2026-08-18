<?php

namespace App\Http\Requests\Entidades;

use Illuminate\Foundation\Http\FormRequest;

class StoreEntidadRequest extends FormRequest
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
     * Reglas de validación para registrar una entidad.
     */
    public function rules(): array
    {
        return [
            'codigoInstitucional' => ['required', 'string', 'max:50', 'unique:entidades,codigoInstitucional'],
            'ruc' => ['required', 'string', 'max:13', 'unique:entidades,ruc'],
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