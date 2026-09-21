<?php

namespace App\Http\Requests\Seguimiento;

use App\Enums\EstadoSeguimiento;
use App\Enums\PeriodoSeguimiento;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class AvanceRequest extends FormRequest
{
    public function authorize(): bool { return true; }

    public function rules(): array
    {
        $avanceId = $this->route('avance');
        return [
            'proyecto_id' => ['required', 'integer', 'exists:proyectos,id'],
            'indicador_id' => ['required', 'integer', 'exists:indicadores,id'],
            'anio' => ['required', 'integer', 'between:2000,2100'],
            'periodo' => [
                'required',
                Rule::in(PeriodoSeguimiento::values()),
                Rule::unique('avances', 'periodo')->where(fn ($query) => $query
                    ->where('proyecto_id', $this->input('proyecto_id'))
                    ->where('indicador_id', $this->input('indicador_id'))
                    ->where('anio', $this->input('anio')))
                    ->ignore($avanceId),
            ],
            'fecha_corte' => ['required', 'date'],
            'valor_programado' => ['required', 'numeric', 'gt:0', 'max:99999999999999.9999'],
            'valor_ejecutado' => ['required', 'numeric', 'min:0', 'max:99999999999999.9999'],
            'resultado' => ['nullable', 'string', 'max:5000'],
            'observaciones' => ['nullable', 'string', 'max:5000'],
            'estado' => ['required', Rule::in(EstadoSeguimiento::values())],
        ];
    }

    public function messages(): array
    {
        return [
            'proyecto_id.required' => 'Debe seleccionar un proyecto.',
            'indicador_id.required' => 'Debe seleccionar un indicador.',
            'anio.required' => 'Debe ingresar el año.',
            'periodo.required' => 'Debe seleccionar el periodo.',
            'fecha_corte.required' => 'Debe ingresar la fecha de corte.',
            'valor_programado.gt' => 'El valor programado debe ser mayor que cero.',
            'valor_ejecutado.min' => 'El valor ejecutado no puede ser negativo.',
            'periodo.unique' => 'Ya existe un avance para el proyecto, indicador, año y periodo seleccionados.',
        ];
    }
}
