<?php

namespace App\Http\Requests\ClasificacionInversion;

use App\Models\Subsector;
use App\Models\Sector;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class GuardarSubsectorPanelRequest extends FormRequest
{
    public function authorize(): bool
    {
        if ($this->isMethod('POST')) {
            abort_unless($this->route('sector') instanceof Sector, 404);
            return puedeHacer('clasificacion_inversion', 'crear');
        }

        abort_unless($this->route('subsector') instanceof Subsector, 404);

        return puedeHacer('clasificacion_inversion', 'editar')
            || puedeHacer('clasificacion_inversion', 'estado');
    }

    protected function prepareForValidation(): void
    {
        $datos = [];
        if (is_string($this->input('nombre'))) {
            $datos['nombre'] = trim($this->input('nombre'));
        }
        if (is_string($this->input('codigo'))) {
            $datos['codigo'] = strtoupper(trim($this->input('codigo')));
        }
        $this->merge($datos);
    }

    public function rules(): array
    {
        $creando = $this->isMethod('POST');
        $registro = $this->route('subsector');
        $informacion = $creando || puedeHacer('clasificacion_inversion', 'editar');

        if ($creando) {
            $padre = $this->route('sector');
            abort_unless($padre instanceof Sector, 404);
            $padreId = $padre->id;
        } else {
            $padreId = $registro->sector_id;
        }

        $nombreUnico = Rule::unique('subsectores', 'nombre')->where('sector_id', $padreId);
        $codigoUnico = Rule::unique('subsectores', 'codigo');

        if ($registro instanceof Subsector) {
            $nombreUnico->ignore($registro);
            $codigoUnico->ignore($registro);
        }

        return [
            'nombre' => $informacion
                ? ['required', 'string', 'max:255', $nombreUnico]
                : ['exclude'],

            'codigo' => $informacion
                ? [
                    'required', 'string', 'max:10',
                    'regex:/^[A-Z][0-9]{4}$/',
                    $codigoUnico,
                ]
                : ['exclude'],

            'estado' => !$creando && puedeHacer('clasificacion_inversion', 'estado')
                ? ['required', 'string', Rule::in(['Activo', 'Inactivo'])]
                : ['exclude'],

            'macrosector_id' => ['prohibited'],
            'sector_id' => ['prohibited'],
            'nivel_gobierno' => ['prohibited'],
        ];
    }

    public function attributes(): array
    {
        return [
            'nombre' => 'nombre',
            'codigo' => 'código',
            'estado' => 'estado',
        ];
    }

    public function messages(): array
    {
        return [
            'nombre.unique' => 'Ya existe un registro con ese nombre en este nivel de clasificación.',
            'codigo.unique' => 'Ya existe un subsector con este código.',
            'codigo.regex' => 'El código debe tener una letra mayúscula y cuatro números. Ejemplo: A0102.',
            'macrosector_id.prohibited' => 'El macrosector se asigna desde la ruta y no se puede cambiar.',
            'sector_id.prohibited' => 'El sector se asigna desde la ruta y no se puede cambiar.',
            'nivel_gobierno.prohibited' => 'El nivel de gobierno se conserva automáticamente.',
        ];
    }
}
