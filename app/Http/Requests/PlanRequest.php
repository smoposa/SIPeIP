<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class PlanRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [

            'nombre' => 'required|string|max:255',

            'descripcion' => 'nullable|string',

            'periodo_inicio' => 'required|integer|min:2000|max:2100',

            'periodo_fin' => 'required|integer|gte:periodo_inicio|max:2100',

            'fecha_inicio' => 'required|date',

            'fecha_fin' => 'required|date|after_or_equal:fecha_inicio',

            'estado' => 'required|string|max:20',

            'entidad_id' => 'required|exists:entidades,id',

        ];
    }

    public function messages(): array
    {
        return [

            'nombre.required' => 'Ingrese el nombre del Plan Estratégico Institucional.',

            'periodo_inicio.required' => 'Seleccione el período inicial.',

            'periodo_fin.required' => 'Seleccione el período final.',

            'periodo_fin.gte' => 'El período final debe ser mayor o igual al inicial.',

            'fecha_inicio.required' => 'Seleccione la fecha de inicio.',

            'fecha_fin.required' => 'Seleccione la fecha final.',

            'fecha_fin.after_or_equal' => 'La fecha final debe ser mayor o igual a la fecha inicial.',

            'estado.required' => 'Seleccione el estado.',

            'entidad_id.required' => 'Seleccione una entidad.',

        ];
    }
}