<?php

namespace App\Http\Requests\Planes;

use Illuminate\Foundation\Http\FormRequest;

class UpdatePlanRequest extends FormRequest
{
    /**
     * Determinar si el usuario está autorizado.
     */
    public function authorize(): bool
    {
        return auth()->check();
    }

    /**
     * Reglas de validación para actualizar un plan.
     */
    public function rules(): array
    {
        return [
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
                'required',
                'string',
                'max:1000',
            ],
        ];
    }

    /**
     * Mensajes personalizados de validación.
     */
    public function messages(): array
    {
        return [
            'nombre.required' =>
                'El nombre del plan es obligatorio.',

            'nombre.string' =>
                'El nombre del plan debe ser un texto válido.',

            'nombre.max' =>
                'El nombre del plan no puede superar los 255 caracteres.',

            'periodo_inicio.required' =>
                'El año de inicio es obligatorio.',

            'periodo_inicio.integer' =>
                'El año de inicio debe ser un número válido.',

            'periodo_inicio.min' =>
                'El año de inicio no puede ser menor a 2000.',

            'periodo_inicio.max' =>
                'El año de inicio no puede ser mayor a 2100.',

            'periodo_fin.required' =>
                'El año de finalización es obligatorio.',

            'periodo_fin.integer' =>
                'El año de finalización debe ser un número válido.',

            'periodo_fin.gte' =>
                'El año de finalización debe ser igual o posterior al año de inicio.',

            'periodo_fin.max' =>
                'El año de finalización no puede ser mayor a 2100.',

            'descripcion.string' =>
                'La descripción debe ser un texto válido.',

            'descripcion.max' =>
                'La descripción no puede superar los 1000 caracteres.',

            'descripcion.required' =>
                'La descripción general del plan es obligatoria.',
        ];
    }
}
