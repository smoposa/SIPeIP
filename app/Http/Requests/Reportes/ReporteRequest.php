<?php

namespace App\Http\Requests\Reportes;

use App\Enums\PeriodoSeguimiento;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class ReporteRequest extends FormRequest
{
    public function authorize(): bool
    {
        return puedeVer('reportes');
    }

    public function rules(): array
    {
        return [
            'tipo' => ['sometimes', Rule::in(['planes', 'programas', 'proyectos', 'avances', 'presupuestos'])],
            'anio' => ['nullable', 'integer', 'between:2000,2100'],
            'periodo' => ['nullable', Rule::in(PeriodoSeguimiento::values())],
            'proyecto_id' => ['nullable', 'integer', 'min:1'],
        ];
    }
}
