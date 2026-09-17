<?php

namespace App\Http\Requests\Metas;

use Illuminate\Foundation\Http\FormRequest;

class UpdateMetaStatusRequest extends FormRequest
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
                'Debe indicar el estado de la meta.',

            'estado.boolean' =>
                'El estado de la meta debe ser válido.',
        ];
    }
}
