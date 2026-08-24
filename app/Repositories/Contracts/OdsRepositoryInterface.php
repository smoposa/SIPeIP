<?php

namespace App\Repositories\Contracts;

use App\Models\Ods;
use Illuminate\Database\Eloquent\Collection;

interface OdsRepositoryInterface
{
    /**
     * Obtener todos los ODS ordenados por código.
     */
    public function obtenerTodosOrdenados(): Collection;

    /**
     * Obtener un ODS con sus metas asociadas.
     */
    public function obtenerConMetas(Ods $ods): Ods;
}