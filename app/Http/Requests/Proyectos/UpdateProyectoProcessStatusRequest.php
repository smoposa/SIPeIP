<?php

namespace App\Http\Requests\Proyectos;

use App\Enums\EstadoProcesoProyecto;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UpdateProyectoProcessStatusRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'estado_proceso' => [
                'required',
                Rule::in(
                    EstadoProcesoProyecto::values()
                ),
            ],
        ];
    }

    public function messages(): array
    {
        return [
            'estado_proceso.required' =>
                'Debe seleccionar el estado del proceso.',

            'estado_proceso.in' =>
                'El estado del proceso seleccionado no es válido.',
        ];
    }
}