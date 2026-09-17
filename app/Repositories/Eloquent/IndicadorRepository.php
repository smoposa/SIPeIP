<?php

namespace App\Repositories\Eloquent;

use App\Models\Indicador;
use App\Models\Meta;
use App\Models\User;
use App\Repositories\Contracts\IndicadorRepositoryInterface;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Illuminate\Database\Eloquent\Collection;

class IndicadorRepository implements IndicadorRepositoryInterface
{
    public function contarPorEntidad(
        int $entidadId
    ): int {
        return Indicador::query()
            ->whereHas(
                'meta.objetivo.plan',
                fn ($query) => $query->where(
                    'entidad_id',
                    $entidadId
                )
            )
            ->count();
    }

    public function contarPorEstadoYEntidad(
        string $estado,
        int $entidadId
    ): int {
        return Indicador::query()
            ->where(
                'estado',
                $estado
            )
            ->whereHas(
                'meta.objetivo.plan',
                fn ($query) => $query->where(
                    'entidad_id',
                    $entidadId
                )
            )
            ->count();
    }

    public function listarPorEntidad(
        int $entidadId,
        int $porPagina = 15
    ): LengthAwarePaginator {
        return Indicador::query()
            ->with([
                'meta.objetivo.plan.entidad',
                'responsable',
            ])
            ->whereHas(
                'meta.objetivo.plan',
                fn ($query) => $query->where(
                    'entidad_id',
                    $entidadId
                )
            )
            ->orderByDesc('id')
            ->paginate($porPagina);
    }

    public function obtenerUltimo(): ?Indicador
    {
        return Indicador::query()
            ->orderByDesc('id')
            ->first();
    }

    public function buscarPorIdYEntidad(
        int $id,
        int $entidadId
    ): Indicador {
        return Indicador::query()
            ->with([
                'meta.objetivo.plan.entidad',
                'responsable',
                'usuario',
            ])
            ->whereHas(
                'meta.objetivo.plan',
                fn ($query) => $query->where(
                    'entidad_id',
                    $entidadId
                )
            )
            ->findOrFail($id);
    }

    public function obtenerMetasActivasPorEntidad(
        int $entidadId
    ): Collection {
        return Meta::query()
            ->with([
                'objetivo.plan.entidad',
            ])
            ->where(
                'estado',
                'Activo'
            )
            ->whereHas(
                'objetivo',
                fn ($query) => $query
                    ->where(
                        'estado',
                        'Activo'
                    )
                    ->whereHas(
                        'plan',
                        fn ($planQuery) => $planQuery
                            ->where(
                                'entidad_id',
                                $entidadId
                            )
                            ->where(
                                'estado',
                                'Activo'
                            )
                    )
            )
            ->orderBy('codigo')
            ->get();
    }

    public function buscarMetaActivaPorIdYEntidad(
        int $metaId,
        int $entidadId
    ): ?Meta {
        return Meta::query()
            ->with([
                'objetivo.plan.entidad',
            ])
            ->whereKey($metaId)
            ->where(
                'estado',
                'Activo'
            )
            ->whereHas(
                'objetivo',
                fn ($query) => $query
                    ->where(
                        'estado',
                        'Activo'
                    )
                    ->whereHas(
                        'plan',
                        fn ($planQuery) => $planQuery
                            ->where(
                                'entidad_id',
                                $entidadId
                            )
                            ->where(
                                'estado',
                                'Activo'
                            )
                    )
            )
            ->first();
    }

    public function obtenerResponsablesActivosPorEntidad(
        int $entidadId
    ): Collection {
        return User::query()
            ->where(
                'entidad_id',
                $entidadId
            )
            ->where(
                'estado',
                'Activo'
            )
            ->orderBy('nombres')
            ->orderBy('apellidos')
            ->get();
    }

    public function buscarResponsableActivoPorIdYEntidad(
        int $responsableId,
        int $entidadId
    ): ?User {
        return User::query()
            ->whereKey($responsableId)
            ->where(
                'entidad_id',
                $entidadId
            )
            ->where(
                'estado',
                'Activo'
            )
            ->first();
    }

    public function crear(
        array $datos
    ): Indicador {
        return Indicador::create($datos);
    }

    public function actualizar(
        Indicador $indicador,
        array $datos
    ): Indicador {
        $indicador->update($datos);

        return $indicador->refresh();
    }
}