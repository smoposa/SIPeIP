<?php

namespace App\Http\Requests\Ods;

class UpdateAgendaOdsRequest extends StoreAgendaOdsRequest
{
    public function authorize(): bool
    {
        return puedeHacer('ods', 'editar')
            || puedeHacer('ods', 'estado');
    }

    public function rules(): array
    {
        $reglas = parent::rules();

        // Excluir los datos básicos si no tiene permiso de edición.
        if (!puedeHacer('ods', 'editar')) {

            foreach ([
                'nombre',
                'periodo_inicio',
                'periodo_fin',
                'descripcion',
            ] as $campo) {
                $reglas[$campo] = ['exclude'];
            }

        }

        // Validar el estado únicamente si tiene permiso para modificarlo.
        $reglas['estado'] = puedeHacer('ods', 'estado')
            ? [
                'required',
                'string',
                'in:Activo,Inactivo',
            ]
            : ['exclude'];

        return $reglas;
    }
}