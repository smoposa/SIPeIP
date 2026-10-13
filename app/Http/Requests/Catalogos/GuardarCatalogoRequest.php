<?php

namespace App\Http\Requests\Catalogos;

use App\Services\CatalogoDefinition;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class GuardarCatalogoRequest extends FormRequest
{
    public function authorize(): bool
    {
        $definicion = CatalogoDefinition::obtener($this->route('recurso'));

        return puedeHacer($definicion['modulo'], $this->isMethod('POST') ? 'crear' : 'editar');
    }

    public function rules(): array
    {
        $definicion = CatalogoDefinition::obtener($this->route('recurso'));
        $rules = [];
        foreach ($definicion['campos'] as $campo => $configuracion) {
            $rules[$campo] = explode('|', $configuracion['reglas']);
        }
        if (isset($definicion['padre'])) {
            $padre = CatalogoDefinition::obtener($definicion['padre']['recurso']);
            $modeloPadre = $padre['modelo'];
            $rules[$definicion['padre']['campo']] = ['required', 'integer', Rule::exists((new $modeloPadre)->getTable(), 'id')];
        }
        $modelo = $definicion['modelo'];
        $tabla = (new $modelo)->getTable();
        $registro = $this->route('id') ? $modelo::query()->findOrFail($this->route('id')) : null;
        foreach ($definicion['unicos'] as $unico) {
            $rule = Rule::unique($tabla, $unico['campo']);
            if ($registro) {
                $rule->ignore($registro);
            }
            if ($unico['ambito']) {
                $rule->where($unico['ambito'], $this->input($unico['ambito']));
            }
            $rules[$unico['campo']][] = $rule;
        }

        return $rules;
    }

    public function attributes(): array
    {
        $definicion = CatalogoDefinition::obtener($this->route('recurso'));
        $attributes = array_map(fn ($campo) => $campo['etiqueta'], $definicion['campos']);
        if (isset($definicion['padre'])) {
            $attributes[$definicion['padre']['campo']] = 'registro superior';
        }

        return $attributes;
    }
}
