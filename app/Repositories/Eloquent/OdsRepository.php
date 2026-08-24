<?php

namespace App\Repositories\Eloquent;

use App\Models\Ods;
use App\Repositories\Contracts\OdsRepositoryInterface;
use Illuminate\Database\Eloquent\Collection;

class OdsRepository implements OdsRepositoryInterface
{
    /**
     * Obtener todos los ODS ordenados por código.
     */
    public function obtenerTodosOrdenados(): Collection
    {
        return Ods::orderBy('codigo')->get();
    }

    /**
     * Obtener un ODS con sus metas asociadas.
     */
    public function obtenerConMetas(Ods $ods): Ods
    {
        $ods->load([
            'metas' => function ($query) {
                $query->orderBy('codigo');
            },
        ]);

        return $ods;
    }
}