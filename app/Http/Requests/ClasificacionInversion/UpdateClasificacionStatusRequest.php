<?php

namespace App\Http\Requests\ClasificacionInversion;

use Illuminate\Foundation\Http\FormRequest;

class UpdateClasificacionStatusRequest extends FormRequest
{
    /**
     * La autorización se controlará mediante
     * los permisos definidos en el controlador.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Convertir el valor recibido a booleano.
     */
    protected function prepareForValidation(): void
    {
        $this->merge([
            'estado' => $this->boolean('estado'),
        ]);
    }

    /**
     * Validar el cambio de estado.
     */
    public function rules(): array
    {
        return [
            'estado' => [
                'required',
                'boolean',
            ],
        ];
    }

    /**
     * Mensajes personalizados.
     */
    public function messages(): array
    {
        return [
            'estado.required' => 'Debe indicar el estado del registro.',
            'estado.boolean' => 'El estado seleccionado no es válido.',
        ];
    }
}