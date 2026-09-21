<?php

namespace App\Repositories\Eloquent;

use App\Enums\EstadoPlan;
use App\Models\Plan;
use App\Repositories\Contracts\PlanRepositoryInterface;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;

class PlanRepository implements PlanRepositoryInterface
{
    /**
     * Contar todos los planes pertenecientes a una entidad.
     */
    public function contarPorEntidad(int $entidadId): int
    {
        return Plan::where('entidad_id', $entidadId)
            ->count();
    }

    /**
     * Contar planes activos pertenecientes a una entidad.
     */
    public function contarActivosPorEntidad(int $entidadId): int
    {
        return Plan::where('entidad_id', $entidadId)
            ->where('estado', EstadoPlan::ACTIVO->value)
            ->count();
    }

    /**
     * Contar planes inactivos pertenecientes a una entidad.
     */
    public function contarInactivosPorEntidad(int $entidadId): int
    {
        return Plan::where('entidad_id', $entidadId)
            ->where('estado', EstadoPlan::INACTIVO->value)
            ->count();
    }

    /**
     * Obtener el último plan registrado por una entidad.
     */
    public function obtenerUltimoPorEntidad(int $entidadId): ?Plan
    {
        return Plan::where('entidad_id', $entidadId)
            ->orderByDesc('id')
            ->first();
    }

    /**
     * Listar los planes pertenecientes a una entidad.
     */
    public function listarPorEntidad(
        int $entidadId,
        int $porPagina = 10
    ): LengthAwarePaginator {
        return Plan::with('entidad')
            ->where('entidad_id', $entidadId)
            ->orderByDesc('id')
            ->paginate($porPagina);
    }

    /**
     * Buscar un plan por ID asegurando
     * que pertenezca a la entidad indicada.
     */
    public function buscarPorIdYEntidad(
        int $id,
        int $entidadId
    ): Plan {
        return Plan::with([
                'entidad',
                'usuario',
                'objetivos' => function ($query) {
                    $query
                        ->with([
                            'pnd',
                            'politicaPnd',
                            'ods',
                            'metaOds',
                        ])
                        ->withCount('metas')
                        ->orderBy('codigo');
                },
            ])
            ->where('entidad_id', $entidadId)
            ->where('id', $id)
            ->firstOrFail();
    }

    /**
     * Crear un nuevo plan institucional.
     */
    public function crear(array $datos): Plan
    {
        return Plan::create($datos);
    }

    /**
     * Actualizar un plan institucional.
     */
    public function actualizar(
        Plan $plan,
        array $datos
    ): Plan {
        $plan->update($datos);

        return $plan->refresh();
    }
}
