<?php

namespace App\Http\Requests\Roles;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UpdateRolePermissionsRequest extends FormRequest
{
    public function authorize(): bool
    {
        return puedeVer('roles')
            && puedeHacer('roles', 'editar')
            && in_array($this->user()?->rol?->codigo, [
                'ADMIN_GLOBAL',
                'ADMIN_SISTEMA',
            ], true);
    }

    public function rules(): array
    {
        return [
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
            'permisos.required' => 'Seleccione al menos un permiso.',
            'permisos.min' => 'Seleccione al menos un permiso.',
            'permisos.array' => 'La selección de permisos no es válida.',

            'permisos.*.in' =>
                'No tiene autorización para asignar uno de los permisos seleccionados.',

            'permisos.*.distinct' =>
                'No se permiten permisos duplicados.',
        ];
    }
}
