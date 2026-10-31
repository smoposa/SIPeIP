<?php

namespace App\Repositories\Contracts;

use App\Models\Ods;
use App\Models\AgendaOds;
use App\Models\OdsMeta;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Illuminate\Database\Eloquent\Collection;

interface OdsRepositoryInterface
{
    public function listarAgendas(bool $soloActivas = true): LengthAwarePaginator;

    public function obtenerAgenda(int $id): AgendaOds;

    public function crearAgenda(array $datos): AgendaOds;

    public function actualizarAgenda(AgendaOds $agenda, array $datos): AgendaOds;

    public function actualizarEstadoAgenda(AgendaOds $agenda, string $estado): AgendaOds;

    public function obtenerTodosOrdenados(?int $agendaId = null): Collection;

    public function obtenerConMetas(Ods $ods): Ods;

    public function actualizarObjetivo(Ods $ods, array $datos): Ods;

    public function actualizarEstadoObjetivo(Ods $ods, string $estado): Ods;

    public function obtenerAgendaParaActualizar(int $id): AgendaOds;

    public function crearObjetivo(array $datos): Ods;

    public function crearMeta(array $datos): OdsMeta;

    public function actualizarMeta(OdsMeta $meta, array $datos): OdsMeta;
}