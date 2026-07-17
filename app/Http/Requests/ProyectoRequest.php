<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ProyectoRequest extends FormRequest
{
    /**
     * Determine if the user is authorized.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Validation rules.
     */
    public function rules(): array
    {
        return [

            'programa_id' => [
                'required',
                'exists:programas,id',
            ],

            'nombre' => [
                'required',
                'string',
                'max:255',
            ],

            'descripcion' => [
                'nullable',
                'string',
            ],

            'fecha_inicio' => [
                'required',
                'date',
            ],

            'fecha_fin' => [
                'required',
                'date',
                'after_or_equal:fecha_inicio',
            ],

            'presupuesto_aprobado' => [
                'required',
                'numeric',
                'min:0',
            ],

            'responsable_id' => [
                'required',
                'exists:users,id',
            ],

            'estado' => [
                'required',
                'in:Planificado,En ejecución,Finalizado,Suspendido',
            ],

        ];
    }

    public function messages(): array
    {
        return [

            'programa_id.required' => 'Seleccione un programa.',

            'programa_id.exists' => 'El programa seleccionado no existe.',

            'fecha_fin.after_or_equal' => 'La fecha de finalización debe ser igual o posterior a la fecha de inicio.',

        ];
    }
}