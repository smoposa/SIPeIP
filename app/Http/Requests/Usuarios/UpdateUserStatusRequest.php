<?php

namespace App\Http\Requests\Usuarios;

use App\Enums\EstadoUsuario;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UpdateUserStatusRequest extends FormRequest
{
    /**
     * Determinar si el usuario está autorizado.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Reglas de validación.
     */
    public function rules(): array
    {
        return [
            'estado' => [
                'required',
                Rule::enum(EstadoUsuario::class),
            ],
        ];
    }
}