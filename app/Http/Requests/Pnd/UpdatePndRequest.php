<?php

namespace App\Http\Requests\Pnd;

class UpdatePndRequest extends StorePndRequest
{
    public function authorize(): bool
    {
        return puedeHacer('pnd', 'editar')
            || puedeHacer('pnd', 'estado');
    }

    public function rules(): array
    {
        $reglas = parent::rules();

        // Excluir la información que el usuario no puede editar.
        if (!puedeHacer('pnd', 'editar')) {

            foreach ([
                'nombre',
                'periodo_inicio',
                'periodo_fin',
                'descripcion',
            ] as $campo) {
                $reglas[$campo] = ['exclude'];
            }

        }

        $reglas['estado'] = puedeHacer('pnd', 'estado')
            ? [
                'required',
                'string',
                'in:Activo,Inactivo',
            ]
            : ['exclude'];

        return $reglas;
    }
}