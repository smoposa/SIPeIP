<?php

namespace App\Http\Requests\Planes;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UpdatePlanRequest extends FormRequest
{
    public function authorize(): bool
    {
        return auth()->check();
    }

    public function rules(): array
    {
        $planId = $this->route('id');

        return [
            'codigo' => [
                'required',
                'string',
                'max:30',
                Rule::unique('planes', 'codigo')->ignore($planId),
            ],

            'nombre' => [
                'required',
                'string',
                'max:255',
            ],

            'periodo_inicio' => [
                'required',
                'integer',
                'min:2000',
                'max:2100',
            ],

            'periodo_fin' => [
                'required',
                'integer',
                'gte:periodo_inicio',
                'max:2100',
            ],

            'descripcion' => [
                'nullable',
                'string',
                'max:1000',
            ],
        ];
    }
}