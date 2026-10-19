<?php

namespace App\Http\Requests\Pnd;

use App\Models\PndMeta;
use App\Models\PndObjetivo;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class GuardarMetaPndRequest extends FormRequest
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

        $registro = $this->route('meta');

        abort_unless($registro instanceof PndMeta, 404);
        abort_unless((int) $registro->pnd_objetivo_id === (int) $padre->id, 404);

        return puedeHacer('pnd', 'editar')
            || puedeHacer('pnd', 'estado');
    }

    public function rules(): array
    {
        $creando = $this->isMethod('POST');
        $padre = $this->route('objetivo');
        $registro = $this->route('meta');
        $editar = $creando || puedeHacer('pnd', 'editar');

        $unico = Rule::unique('pnd_metas', 'numero')
            ->where('pnd_objetivo_id', $padre->id);

        if ($registro instanceof PndMeta) {
            $unico->ignore($registro);
        }

        return [
            'numero' => $editar
                ? ['required', 'integer', 'min:1', $unico]
                : ['exclude'],

            'descripcion' => $editar
                ? ['required', 'string', 'max:10000']
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
            'numero.unique' => 'El identificador ya está registrado en este objetivo.',
            'pnd_objetivo_id.prohibited' => 'El objetivo se asigna desde la ruta y no se puede cambiar.',
            'pnd_politica_id.prohibited' => 'La política se asigna desde la ruta y no se puede cambiar.',
        ];
    }
}
