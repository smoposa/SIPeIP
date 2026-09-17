<?php

namespace App\Repositories\Contracts;

use App\Models\Objetivo;
use App\Models\Plan;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Illuminate\Database\Eloquent\Collection;

interface ObjetivoRepositoryInterface
{
    public function listarPorEntidad(
        int $entidadId,
        int $porPagina = 10
    ): LengthAwarePaginator;

    public function obtenerUltimo(): ?Objetivo;

    public function buscarPorIdYEntidad(
        int $id,
        int $entidadId
    ): Objetivo;

    public function obtenerPlanesActivosPorEntidad(
        int $entidadId
    ): Collection;

    public function buscarPlanActivoPorIdYEntidad(
        int $planId,
        int $entidadId
    ): ?Plan;

    public function obtenerPndActivos(): Collection;

    public function obtenerOdsActivos(): Collection;

    public function obtenerPoliticasActivasPorPnd(
        int $pndId
    ): Collection;

    public function obtenerMetasActivasPorOds(
        int $odsId
    ): Collection;

    public function crear(array $datos): Objetivo;

    public function actualizar(
        Objetivo $objetivo,
        array $datos
    ): Objetivo;
}