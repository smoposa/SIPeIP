<?php

namespace App\Http\Requests\Seguimiento;

use App\Enums\EstadoSeguimiento;
use App\Enums\PeriodoSeguimiento;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class PresupuestoRequest extends FormRequest
{
    public function authorize(): bool { return true; }

    public function rules(): array
    {
        $presupuestoId = $this->route('presupuesto');
        return [
            'proyecto_id' => ['required', 'integer', 'exists:proyectos,id'],
            'anio' => ['required', 'integer', 'between:2000,2100'],
            'periodo' => [
                'required',
                Rule::in(PeriodoSeguimiento::values()),
                Rule::unique('presupuestos', 'periodo')->where(fn ($query) => $query
                    ->where('proyecto_id', $this->input('proyecto_id'))
                    ->where('anio', $this->input('anio')))
                    ->ignore($presupuestoId),
            ],
            'fecha_corte' => ['required', 'date'],
            'monto_programado' => ['required', 'numeric', 'gt:0', 'max:9999999999999.99'],
            'presupuesto_vigente' => ['required', 'numeric', 'min:0', 'max:9999999999999.99'],
            'monto_ejecutado' => ['required', 'numeric', 'min:0', 'max:9999999999999.99'],
            'observaciones' => ['nullable', 'string', 'max:5000'],
            'estado' => ['required', Rule::in(EstadoSeguimiento::values())],
        ];
    }

    public function messages(): array
    {
        return [
            'proyecto_id.required' => 'Debe seleccionar un proyecto.',
            'anio.required' => 'Debe ingresar el año.',
            'periodo.required' => 'Debe seleccionar el periodo.',
            'fecha_corte.required' => 'Debe ingresar la fecha de corte.',
            'monto_programado.gt' => 'El monto programado debe ser mayor que cero.',
            'presupuesto_vigente.min' => 'El presupuesto vigente no puede ser negativo.',
            'monto_ejecutado.min' => 'El monto ejecutado no puede ser negativo.',
            'periodo.unique' => 'Ya existe un presupuesto para el proyecto, año y periodo seleccionados.',
        ];
    }
}
