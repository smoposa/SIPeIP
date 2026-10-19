<?php

namespace App\Http\Requests\Pnd;

use App\Models\PndEje;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class GuardarEjePndRequest extends FormRequest
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
        $eje = $this->route('eje');

        if (!$creando) {
            abort_unless($eje instanceof PndEje, 404);
        }

        $pndId = $creando
            ? (int) $this->route('pnd')
            : $eje->pnd_id;

        $puedeEditar = $creando || puedeHacer('pnd', 'editar');

        $numeroUnico = Rule::unique('pnd_ejes', 'numero')
            ->where('pnd_id', $pndId);

        if ($eje instanceof PndEje) {
            $numeroUnico->ignore($eje);
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

            'pnd_id' => ['prohibited'],
        ];
    }

    public function attributes(): array
    {
        return [
            'numero' => 'número del eje',
            'nombre' => 'nombre del eje',
            'descripcion' => 'descripción',
            'estado' => 'estado',
            'pnd_id' => 'plan nacional',
        ];
    }

    public function messages(): array
    {
        return [
            'numero.unique' => 'El número del eje ya está registrado en este plan.',
            'pnd_id.prohibited' => 'No se permite cambiar el plan al que pertenece el eje.',
        ];
    }
}