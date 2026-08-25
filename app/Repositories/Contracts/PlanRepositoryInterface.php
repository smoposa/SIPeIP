<?php

namespace App\Repositories\Contracts;

use App\Models\Plan;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Illuminate\Database\Eloquent\Collection;

interface PlanRepositoryInterface
{
    public function contarPorEntidad(int $entidadId): int;

    public function contarActivosPorEntidad(int $entidadId): int;

    public function contarInactivosPorEntidad(int $entidadId): int;

    public function obtenerUltimoPorEntidad(int $entidadId): ?Plan;

    public function listarPorEntidad(int $entidadId, int $porPagina = 10): LengthAwarePaginator;

    public function buscarPorIdYEntidad(int $id, int $entidadId): Plan;

    public function crear(array $datos): Plan;

    public function actualizar(Plan $plan, array $datos): Plan;

    public function eliminar(Plan $plan): void;
}