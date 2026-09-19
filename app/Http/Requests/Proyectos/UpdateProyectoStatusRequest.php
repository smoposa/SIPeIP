<?php

namespace App\Http\Requests\Proyectos;

use Illuminate\Foundation\Http\FormRequest;

class UpdateProyectoStatusRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'estado' => [
                'required',
                'boolean',
            ],
        ];
    }

    public function messages(): array
    {
        return [
            'estado.required' =>
                'Debe indicar el estado administrativo del proyecto.',

            'estado.boolean' =>
                'El estado administrativo seleccionado no es válido.',
        ];
    }
}