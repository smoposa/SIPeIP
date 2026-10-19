<?php

namespace App\Http\Requests\Pnd;

use App\Models\PndObjetivo;
use App\Models\PndPolitica;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class GuardarPoliticaPndRequest extends FormRequest
{
    public function authorize(): bool
    {
        $objetivo = $this->route('objetivo');
        $padre = $this->route('objetivo');

        abort_unless($objetivo instanceof PndObjetivo, 404);
        abort_unless($padre instanceof PndObjetivo, 404);

        if ($this->isMethod('POST')) {
            return puedeHacer('pnd', 'crear');
        }

        $registro = $this->route('politica');

        abort_unless($registro instanceof PndPolitica, 404);
        abort_unless((int) $registro->pnd_objetivo_id === (int) $padre->id, 404);

        return puedeHacer('pnd', 'editar')
            || puedeHacer('pnd', 'estado');
    }

    public function rules(): array
    {
        $creando = $this->isMethod('POST');
        $padre = $this->route('objetivo');
        $registro = $this->route('politica');
        $editar = $creando || puedeHacer('pnd', 'editar');

        $unico = Rule::unique('pnd_politicas', 'codigo')
            ->where('pnd_objetivo_id', $padre->id);

        if ($registro instanceof PndPolitica) {
            $unico->ignore($registro);
        }

        return [
            'codigo' => $editar
                ? ['required', 'string', 'max:20', $unico]
                : ['exclude'],

            'nombre' => $editar
                ? ['required', 'string', 'max:255']
                : ['exclude'],

            'estado' => !$creando && puedeHacer('pnd', 'estado')
                ? ['required', 'string', Rule::in(['Activo', 'Inactivo'])]
                : ['exclude'],

            'pnd_objetivo_id' => ['prohibited'],
            'pnd_politica_id' => ['prohibited'],
        ];
    }

    public function attributes(): array
    {
        return [
            'codigo' => 'código',
            'numero' => 'número',
            'nombre' => 'nombre de la política',
            'descripcion' => 'descripción',
            'estado' => 'estado',
        ];
    }

    public function messages(): array
    {
        return [
            'codigo.unique' => 'El identificador ya está registrado en este objetivo.',
            'pnd_objetivo_id.prohibited' => 'El objetivo se asigna desde la ruta y no se puede cambiar.',
            'pnd_politica_id.prohibited' => 'La política se asigna desde la ruta y no se puede cambiar.',
        ];
    }
}
