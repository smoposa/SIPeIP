<?php

namespace App\Http\Requests\Catalogos;

use App\Services\CatalogoDefinition;
use Illuminate\Foundation\Http\FormRequest;

class EstadoCatalogoRequest extends FormRequest
{
    public function authorize(): bool
    {
        $definicion = CatalogoDefinition::obtener($this->route('recurso'));

        return puedeHacer($definicion['modulo'], 'estado');
    }

    public function rules(): array
    {
        return ['estado' => ['required', 'in:Activo,Inactivo']];
    }
}
