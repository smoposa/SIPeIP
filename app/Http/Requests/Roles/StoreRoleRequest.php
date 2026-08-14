<?php

namespace App\Http\Requests\Roles;

use Illuminate\Foundation\Http\FormRequest;

class StoreRoleRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'nombre' => [
                'required',
                'string',
                'max:100',
                'unique:roles,nombre',
            ],
            'descripcion' => [
                'required',
                'string',
                'max:255',
            ],
        ];
    }

    public function messages(): array
    {
        return [
            'nombre.required' => 'El nombre del rol es obligatorio.',
            'nombre.unique' => 'Ya existe un rol con este nombre.',
            'nombre.max' => 'El nombre del rol no puede superar los 100 caracteres.',

            'descripcion.required' => 'La descripción del rol es obligatoria.',
            'descripcion.max' => 'La descripción no puede superar los 255 caracteres.',
        ];
    }
}