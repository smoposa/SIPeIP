<?php

namespace App\Repositories\Eloquent;

use App\Models\Plan;
use App\Repositories\Contracts\PlanRepositoryInterface;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;

class PlanRepository implements PlanRepositoryInterface
{
    public function contarPorEntidad(int $entidadId): int
    {
        return Plan::where('entidad_id', $entidadId)->count();
    }

    public function contarActivosPorEntidad(int $entidadId): int
    {
        return Plan::where('entidad_id', $entidadId)
            ->where('estado', 'Activo')
            ->count();
    }

    public function contarInactivosPorEntidad(int $entidadId): int
    {
        return Plan::where('entidad_id', $entidadId)
            ->where('estado', 'Inactivo')
            ->count();
    }

    public function obtenerUltimoPorEntidad(int $entidadId): ?Plan
    {
        return Plan::where('entidad_id', $entidadId)
            ->orderByDesc('id')
            ->first();
    }

    public function listarPorEntidad(
        int $entidadId,
        int $porPagina = 10
    ): LengthAwarePaginator {
        return Plan::where('entidad_id', $entidadId)
            ->orderByDesc('id')
            ->paginate($porPagina);
    }

    public function buscarPorIdYEntidad(int $id, int $entidadId): Plan
    {
        return Plan::where('entidad_id', $entidadId)
            ->findOrFail($id);
    }

    public function crear(array $datos): Plan
    {
        return Plan::create($datos);
    }

    public function actualizar(Plan $plan, array $datos): Plan
    {
        $plan->update($datos);

        return $plan->refresh();
    }

    public function eliminar(Plan $plan): void
    {
        $plan->delete();
    }
}