<?php

namespace App\Http\Requests\Objetivos;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UpdateObjetivoRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'plan_id' => [
                'required',
                'integer',
                'exists:planes,id',
            ],

            'pnd_id' => [
                'required',
                'integer',
                'exists:pnd_objetivos,id',
            ],

            'pnd_politica_id' => [
                'required',
                'integer',
                Rule::exists('pnd_politicas', 'id')
                    ->where(
                        fn ($query) => $query->where(
                            'pnd_objetivo_id',
                            $this->input('pnd_id')
                        )
                    ),
            ],

            'ods_id' => [
                'required',
                'integer',
                Rule::exists('ods', 'id')
                    ->where('estado', 'Activo'),
            ],

            'ods_meta_id' => [
                'required',
                'integer',
                Rule::exists('ods_metas', 'id')
                    ->where(
                        fn ($query) => $query
                            ->where(
                                'ods_id',
                                $this->input('ods_id')
                            )
                            ->where('estado', 'Activo')
                    ),
            ],

            'nombre' => [
                'required',
                'string',
                'max:255',
            ],

            'descripcion' => [
                'nullable',
                'string',
                'max:1000',
            ],
        ];
    }
}