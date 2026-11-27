<?php

namespace App\Http\Requests\Roles;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class StoreRoleRequest extends FormRequest
{
    public function authorize(): bool
    {
        return puedeVer('roles') && puedeHacer('roles', 'crear');
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

            'asignable_institucion' => [
                'nullable',
                'boolean',
            ],

            'permisos' => [
                'required',
                'array',
                'min:1',
            ],

            'permisos.*' => [
                'required',
                'integer',
                'distinct',
                Rule::in($this->user()->rol->permisos->modelKeys()),
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

            'asignable_institucion.boolean' =>
                'La disponibilidad institucional del rol no es válida.',

            'permisos.required' => 'Seleccione al menos un permiso.',
            'permisos.min' => 'Seleccione al menos un permiso.',
            'permisos.array' => 'La selección de permisos no es válida.',
            'permisos.*.in' => 'No tiene autorización para asignar uno de los permisos seleccionados.',
            'permisos.*.distinct' => 'No se permiten permisos duplicados.',
        ];
    }
}
