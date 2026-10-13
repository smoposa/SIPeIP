<?php

namespace App\Http\Requests\Objetivos;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;
use App\Models\Objetivo;
use App\Models\Ods;
use App\Models\OdsMeta;
use App\Models\PndObjetivo;
use App\Models\PndPolitica;
use App\Rules\CatalogoDisponible;

class StoreObjetivoRequest extends FormRequest
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
                new CatalogoDisponible(PndObjetivo::class),
            ],

            'pnd_politica_id' => [
                new CatalogoDisponible(PndPolitica::class),
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
                Rule::exists('ods', 'id'),
                new CatalogoDisponible(Ods::class),
            ],

            'ods_meta_id' => [
                new CatalogoDisponible(OdsMeta::class),
                'required',
                'integer',
                Rule::exists('ods_metas', 'id')
                    ->where(
                        fn ($query) => $query
                            ->where(
                                'ods_id',
                                $this->input('ods_id')
                            )
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