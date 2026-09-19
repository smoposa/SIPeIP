<?php

namespace App\Http\Requests\Proyectos;

use Illuminate\Foundation\Http\FormRequest;

class StoreProyectoRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'programa_id' => [
                'required',
                'integer',
                'exists:programas,id',
            ],

            'subsector_id' => [
                'required',
                'integer',
                'exists:subsectores,id',
            ],

            'nombre' => [
                'required',
                'string',
                'max:255',
            ],

            'descripcion' => [
                'nullable',
                'string',
                'max:5000',
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
                'decimal:0,2',
                'min:0',
                'max:9999999999999.99',
            ],

            'responsable_id' => [
                'required',
                'integer',
                'exists:users,id',
            ],
        ];
    }

    public function messages(): array
    {
        return [
            'programa_id.required' =>
                'Debe seleccionar un programa.',

            'programa_id.exists' =>
                'El programa seleccionado no es válido.',

            'subsector_id.required' =>
                'Debe seleccionar un subsector de intervención.',

            'subsector_id.exists' =>
                'El subsector seleccionado no es válido.',

            'nombre.required' =>
                'Debe ingresar el nombre del proyecto.',

            'nombre.max' =>
                'El nombre no puede superar los 255 caracteres.',

            'descripcion.max' =>
                'La descripción no puede superar los 5000 caracteres.',

            'fecha_inicio.required' =>
                'Debe ingresar la fecha de inicio.',

            'fecha_inicio.date' =>
                'La fecha de inicio no es válida.',

            'fecha_fin.required' =>
                'Debe ingresar la fecha de finalización.',

            'fecha_fin.date' =>
                'La fecha de finalización no es válida.',

            'fecha_fin.after_or_equal' =>
                'La fecha de finalización debe ser igual o posterior a la fecha de inicio.',

            'presupuesto_aprobado.required' =>
                'Debe ingresar el presupuesto aprobado.',

            'presupuesto_aprobado.numeric' =>
                'El presupuesto aprobado debe ser numérico.',

            'presupuesto_aprobado.decimal' =>
                'El presupuesto puede tener hasta dos decimales.',

            'presupuesto_aprobado.min' =>
                'El presupuesto aprobado no puede ser negativo.',

            'responsable_id.required' =>
                'Debe seleccionar un responsable.',

            'responsable_id.exists' =>
                'El responsable seleccionado no es válido.',
        ];
    }
}