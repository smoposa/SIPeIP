<?php

namespace App\Http\Requests\Pnd;

use App\Models\PndEje;
use App\Models\PndObjetivo;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class GuardarObjetivoPndRequest extends FormRequest
{
    public function authorize(): bool
    {
        if ($this->isMethod('POST')) {
            return puedeHacer('pnd', 'crear');
        }

        return puedeHacer('pnd', 'editar')
            || puedeHacer('pnd', 'estado');
    }

    public function rules(): array
    {
        $creando = $this->isMethod('POST');
        $objetivo = $this->route('objetivo');

        if ($creando) {
            $eje = $this->route('eje');

            abort_unless($eje instanceof PndEje, 404);
        } else {
            abort_unless($objetivo instanceof PndObjetivo, 404);

            $eje = $objetivo->eje;

            abort_unless($eje instanceof PndEje, 404);
        }

        $puedeEditar = $creando || puedeHacer('pnd', 'editar');

        $numeroUnico = Rule::unique('pnd_objetivos', 'numero')
            ->where(function ($query) use ($eje) {
                $query->whereIn('pnd_eje_id', function ($subquery) use ($eje) {
                    $subquery
                        ->select('id')
                        ->from('pnd_ejes')
                        ->where('pnd_id', $eje->pnd_id);
                });
            });

        if ($objetivo instanceof PndObjetivo) {
            $numeroUnico->ignore($objetivo);
        }

        return [
            'numero' => $puedeEditar
                ? ['required', 'integer', 'min:1', $numeroUnico]
                : ['exclude'],

            'nombre' => $puedeEditar
                ? ['required', 'string', 'max:150']
                : ['exclude'],

            'descripcion' => $puedeEditar
                ? ['nullable', 'string', 'max:10000']
                : ['exclude'],

            'estado' => !$creando && puedeHacer('pnd', 'estado')
                ? ['required', 'string', Rule::in(['Activo', 'Inactivo'])]
                : ['exclude'],

            'pnd_eje_id' => ['prohibited'],
        ];
    }

    public function attributes(): array
    {
        return [
            'numero' => 'número del objetivo',
            'nombre' => 'nombre del objetivo',
            'descripcion' => 'descripción',
            'estado' => 'estado',
            'pnd_eje_id' => 'eje',
        ];
    }

    public function messages(): array
    {
        return [
            'numero.unique' => 'El número del objetivo ya está registrado en este plan nacional.',
            'pnd_eje_id.prohibited' => 'No se permite cambiar el eje del objetivo.',
        ];
    }
}