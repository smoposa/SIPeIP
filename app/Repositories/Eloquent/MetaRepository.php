<?php

namespace App\Repositories\Eloquent;

use App\Models\Meta;
use App\Models\Objetivo;
use App\Models\Plan;
use App\Models\User;
use App\Repositories\Contracts\MetaRepositoryInterface;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Illuminate\Database\Eloquent\Collection;

class MetaRepository implements MetaRepositoryInterface
{
    public function contarPorEntidad(
        int $entidadId
    ): int {
        return Meta::query()
            ->whereHas(
                'objetivo.plan',
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
        return Meta::query()
            ->where(
                'estado',
                $estado
            )
            ->whereHas(
                'objetivo.plan',
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
        return Meta::query()
            ->with([
                'objetivo.plan.entidad',
                'responsable',
            ])
            ->whereHas(
                'objetivo.plan',
                fn ($query) => $query->where(
                    'entidad_id',
                    $entidadId
                )
            )
            ->orderByDesc('id')
            ->paginate($porPagina);
    }

    public function obtenerUltima(): ?Meta
    {
        return Meta::query()
            ->orderByDesc('id')
            ->first();
    }

    /**
     * Buscar una meta por ID asegurando que pertenezca
     * a la entidad indicada.
     */
    public function buscarPorIdYEntidad(
        int $id,
        int $entidadId
    ): Meta {
        return Meta::query()
            ->with([
                'objetivo.plan.entidad',
                'responsable',
                'usuario',

                'indicadores' => function ($query) {
                    $query
                        ->with([
                            'responsable',
                        ])
                        ->orderBy('codigo');
                },
            ])
            ->whereHas(
                'objetivo.plan',
                fn ($query) => $query->where(
                    'entidad_id',
                    $entidadId
                )
            )
            ->findOrFail($id);
    }

    /**
     * Obtener todos los planes activos
     * pertenecientes a la entidad.
     */
    public function obtenerPlanesActivosPorEntidad(
        int $entidadId
    ): Collection {
        return Plan::query()
            ->where(
                'entidad_id',
                $entidadId
            )
            ->where(
                'estado',
                'Activo'
            )
            ->orderBy('nombre')
            ->get();
    }

    /**
     * Obtener los objetivos activos
     * pertenecientes a planes activos de la entidad.
     */
    public function obtenerObjetivosActivosPorEntidad(
        int $entidadId
    ): Collection {
        return Objetivo::query()
            ->with([
                'plan.entidad',
            ])
            ->where(
                'estado',
                'Activo'
            )
            ->whereHas(
                'plan',
                fn ($query) => $query
                    ->where(
                        'entidad_id',
                        $entidadId
                    )
                    ->where(
                        'estado',
                        'Activo'
                    )
            )
            ->orderBy('codigo')
            ->get();
    }

    /**
     * Buscar un objetivo activo perteneciente
     * a un plan activo de la entidad.
     */
    public function buscarObjetivoActivoPorIdYEntidad(
        int $objetivoId,
        int $entidadId
    ): ?Objetivo {
        return Objetivo::query()
            ->with([
                'plan.entidad',
            ])
            ->whereKey($objetivoId)
            ->where(
                'estado',
                'Activo'
            )
            ->whereHas(
                'plan',
                fn ($query) => $query
                    ->where(
                        'entidad_id',
                        $entidadId
                    )
                    ->where(
                        'estado',
                        'Activo'
                    )
            )
            ->first();
    }

    /**
     * Obtener responsables activos
     * pertenecientes a la entidad.
     */
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

    /**
     * Buscar un responsable activo
     * perteneciente a la entidad.
     */
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
    ): Meta {
        return Meta::create(
            $datos
        );
    }

    public function actualizar(
        Meta $meta,
        array $datos
    ): Meta {
        $meta->update(
            $datos
        );

        return $meta->refresh();
    }
}