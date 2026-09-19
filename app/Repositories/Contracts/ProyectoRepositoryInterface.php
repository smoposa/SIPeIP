<?php

namespace App\Repositories\Contracts;

use App\Models\Proyecto;
use App\Models\Subsector;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Illuminate\Database\Eloquent\Collection;

interface ProyectoRepositoryInterface
{
    public function contarPorEntidad(
        int $entidadId
    ): int;

    public function contarActivosPorEntidad(
        int $entidadId
    ): int;

    public function contarInactivosPorEntidad(
        int $entidadId
    ): int;

    public function obtenerPresupuestoTotalPorEntidad(
        int $entidadId
    ): string;

    public function obtenerUltimoPorEntidad(
        int $entidadId
    ): ?Proyecto;

    public function listarPorEntidad(
        int $entidadId,
        int $porPagina = 10
    ): LengthAwarePaginator;

    public function buscarPorIdYEntidad(
        int $id,
        int $entidadId
    ): Proyecto;

    public function obtenerProgramasActivosPorEntidad(
        int $entidadId
    ): Collection;

    public function obtenerResponsablesActivosPorEntidad(
        int $entidadId
    ): Collection;

    public function obtenerMacrosectoresActivos(): Collection;

    public function buscarSubsectorActivoPorId(
        int $id
    ): Subsector;

    public function crear(
        array $datos
    ): Proyecto;

    public function actualizar(
        Proyecto $proyecto,
        array $datos
    ): Proyecto;
}