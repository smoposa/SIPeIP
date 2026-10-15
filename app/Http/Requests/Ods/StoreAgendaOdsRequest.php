<?php

namespace App\Http\Requests\Ods;

use Illuminate\Foundation\Http\FormRequest;

class StoreAgendaOdsRequest extends FormRequest
{
    public function authorize(): bool
    {
        return puedeHacer('ods', 'crear');
    }

    public function rules(): array
    {
        return [
            'nombre' => ['required', 'string', 'max:150'],
            'periodo_inicio' => ['required', 'integer', 'min:1901', 'max:2155'],
            'periodo_fin' => [
                'required',
                'integer',
                'min:1901',
                'max:2155',
                'gte:periodo_inicio',
            ],
            'descripcion' => ['nullable', 'string', 'max:10000'],
        ];
    }

    public function attributes(): array
    {
        return [
            'nombre' => 'nombre de la agenda',
            'periodo_inicio' => 'año inicial',
            'periodo_fin' => 'año final',
            'descripcion' => 'descripción',
        ];
    }

    public function messages(): array
    {
        return [
            'periodo_fin.gte' => 'El año final debe ser igual o posterior al año inicial.',
        ];
    }
}