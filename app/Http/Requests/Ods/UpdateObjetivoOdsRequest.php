<?php

namespace App\Http\Requests\Ods;

use App\Models\Ods;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UpdateObjetivoOdsRequest extends FormRequest
{
    public function authorize(): bool
    {
        return puedeHacer('ods', 'editar')
            || puedeHacer('ods', 'estado');
    }

    public function rules(): array
    {
        $ods = $this->route('ods');

        abort_unless($ods instanceof Ods, 404);

        $puedeEditar = puedeHacer('ods', 'editar');
        $puedeEstado = puedeHacer('ods', 'estado');

        return [
            'codigo' => $puedeEditar
                ? [
                    'required',
                    'string',
                    'max:20',
                    Rule::unique($ods->getTable(), 'codigo')
                        ->where('agenda_id', $ods->agenda_id)
                        ->ignore($ods),
                ]
                : ['exclude'],

            'nombre' => $puedeEditar
                ? [
                    'required',
                    'string',
                    'max:150',
                ]
                : ['exclude'],

            'descripcion' => $puedeEditar
                ? [
                    'required',
                    'string',
                    'max:10000',
                ]
                : ['exclude'],

            'estado' => $puedeEstado
                ? [
                    'required',
                    'string',
                    Rule::in(['Activo', 'Inactivo']),
                ]
                : ['exclude'],

            'agenda_id' => ['prohibited'],
        ];
    }

    public function attributes(): array
    {
        return [
            'codigo' => 'código',
            'nombre' => 'nombre',
            'descripcion' => 'descripción',
            'agenda_id' => 'agenda',
            'estado' => 'estado',
        ];
    }

    public function messages(): array
    {
        return [
            'codigo.unique' => 'El código ya está registrado en esta agenda.',
            'agenda_id.prohibited' => 'No se permite cambiar la agenda del objetivo.',
            'estado.required' => 'Debe indicar el estado del objetivo.',
            'estado.in' => 'El estado seleccionado no es válido.',
        ];
    }
}