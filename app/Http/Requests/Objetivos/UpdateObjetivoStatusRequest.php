<?php

namespace App\Http\Requests\Objetivos;

use Illuminate\Foundation\Http\FormRequest;

class UpdateObjetivoStatusRequest extends FormRequest
{
    public function authorize(): bool
    {
        return auth()->check();
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
                'Debe indicar el estado del objetivo.',

            'estado.boolean' =>
                'El estado del objetivo debe ser válido.',
        ];
    }
}