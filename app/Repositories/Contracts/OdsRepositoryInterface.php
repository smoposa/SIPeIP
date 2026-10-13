<?php

namespace App\Repositories\Contracts;

use App\Models\Ods;
use App\Models\AgendaOds;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Illuminate\Database\Eloquent\Collection;

interface OdsRepositoryInterface
{
    public function listarAgendas(): LengthAwarePaginator;

    public function obtenerAgenda(int $id): AgendaOds;

    /**
     * Obtener todos los ODS ordenados por código.
     */
    public function obtenerTodosOrdenados(?int $agendaId = null): Collection;

    /**
     * Obtener un ODS con sus metas asociadas.
     */
    public function obtenerConMetas(Ods $ods): Ods;
}