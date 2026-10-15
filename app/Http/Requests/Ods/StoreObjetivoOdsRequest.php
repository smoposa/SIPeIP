<?php

namespace App\Http\Requests\Ods;

use Illuminate\Foundation\Http\FormRequest;

class StoreObjetivoOdsRequest extends FormRequest
{
    public function authorize(): bool
    {
        return puedeHacer('ods', 'crear');
    }

    public function rules(): array
    {
        return [
            'nombre' => [
                'required',
                'string',
                'max:150',
            ],
            'descripcion' => [
                'required',
                'string',
                'max:10000',
            ],

            // El código se genera en el servidor.
            'codigo' => ['exclude'],

            // La agenda se obtiene de la ruta.
            'agenda_id' => ['prohibited'],

            // El estado inicial se establece en el servicio.
            'estado' => ['prohibited'],
        ];
    }

    public function attributes(): array
    {
        return [
            'nombre' => 'nombre',
            'descripcion' => 'descripción',
            'agenda_id' => 'agenda',
            'estado' => 'estado',
        ];
    }

    public function messages(): array
    {
        return [
            'agenda_id.prohibited' => 'La agenda se asigna automáticamente.',
            'estado.prohibited' => 'El estado inicial se asigna automáticamente.',
        ];
    }
}