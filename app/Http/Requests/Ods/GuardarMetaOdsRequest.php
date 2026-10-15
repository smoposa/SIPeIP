<?php

namespace App\Http\Requests\Ods;

use App\Models\Ods;
use App\Models\OdsMeta;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class GuardarMetaOdsRequest extends FormRequest
{
    public function authorize(): bool
    {
        $ods = $this->route('ods');
        $meta = $this->route('meta');

        abort_unless($ods instanceof Ods, 404);

        if ($this->isMethod('POST')) {
            return puedeHacer('ods', 'crear');
        }

        if (!$this->isMethod('PUT')) {
            return false;
        }

        abort_unless($meta instanceof OdsMeta, 404);
        abort_unless((int) $meta->ods_id === (int) $ods->id, 404);

        return puedeHacer('ods', 'editar')
            || puedeHacer('ods', 'estado');
    }

    public function rules(): array
    {
        $ods = $this->route('ods');
        $meta = $this->route('meta');

        $creando = $this->isMethod('POST');

        $puedeEditarInformacion = $creando
            || puedeHacer('ods', 'editar');

        $puedeCambiarEstado = puedeHacer('ods', 'estado');

        $codigoUnico = Rule::unique('ods_metas', 'codigo')
            ->where('ods_id', $ods->id);

        if (!$creando && $meta instanceof OdsMeta) {
            $codigoUnico->ignore($meta);
        }

        return [
            'codigo' => $puedeEditarInformacion
                ? [
                    'required',
                    'string',
                    'max:20',
                    $codigoUnico,
                ]
                : ['exclude'],

            'nombre' => $puedeEditarInformacion
                ? [
                    'required',
                    'string',
                    'max:255',
                ]
                : ['exclude'],

            'descripcion' => $puedeEditarInformacion
                ? [
                    'nullable',
                    'string',
                    'max:10000',
                ]
                : ['exclude'],

            'estado' => $puedeCambiarEstado
                ? [
                    'required',
                    'string',
                    Rule::in(['Activo', 'Inactivo']),
                ]
                : ['exclude'],

            'ods_id' => ['prohibited'],
        ];
    }

    public function attributes(): array
    {
        return [
            'codigo' => 'código',
            'nombre' => 'título',
            'descripcion' => 'descripción',
            'estado' => 'estado',
            'ods_id' => 'objetivo',
        ];
    }

    public function messages(): array
    {
        return [
            'codigo.unique' => 'El código ya está registrado en este objetivo.',
            'ods_id.prohibited' => 'No se permite cambiar el objetivo de la meta.',
            'estado.required' => 'Debe indicar el estado de la meta.',
            'estado.in' => 'El estado seleccionado no es válido.',
        ];
    }
}