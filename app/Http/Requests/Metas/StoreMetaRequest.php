<?php

namespace App\Http\Requests\Metas;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class StoreMetaRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'objetivo_id' => [
                'required',
                'integer',
                Rule::exists('objetivos', 'id')
                    ->where('estado', 'Activo'),
            ],

            'nombre' => [
                'required',
                'string',
                'max:255',
            ],

            'descripcion' => [
                'nullable',
                'string',
                'max:1000',
            ],

            'linea_base' => [
                'required',
                'numeric',
                'min:0',
                'max:99999999.99',
            ],

            'valor_meta' => [
                'required',
                'numeric',
                'min:0',
                'max:99999999.99',
            ],

            'unidad_medida' => [
                'required',
                'string',
                'max:50',
            ],

            'periodo_inicio' => [
                'required',
                'integer',
                'digits:4',
                'between:2000,2100',
            ],

            'periodo_fin' => [
                'required',
                'integer',
                'digits:4',
                'between:2000,2100',
                'gte:periodo_inicio',
            ],

            'responsable_id' => [
                'required',
                'integer',
                Rule::exists('users', 'id')
                    ->where('estado', 'Activo'),
            ],
        ];
    }
}
