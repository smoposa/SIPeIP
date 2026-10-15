<?php

namespace App\Http\Requests\Ods;

use Illuminate\Foundation\Http\FormRequest;

class UpdateObjetivoOdsStatusRequest extends FormRequest
{
    public function authorize(): bool
    {
        return puedeHacer('ods', 'estado');
    }

    public function rules(): array
    {
        return [
            'estado' => [
                'required',
                'string',
                'in:Activo,Inactivo',
            ],
        ];
    }

    public function attributes(): array
    {
        return [
            'estado' => 'estado del objetivo',
        ];
    }
}