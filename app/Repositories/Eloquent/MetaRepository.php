<?php

namespace App\Repositories\Eloquent;

use App\Models\Meta;
use App\Models\Objetivo;
use App\Models\User;
use App\Repositories\Contracts\MetaRepositoryInterface;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Illuminate\Database\Eloquent\Collection;

class MetaRepository implements MetaRepositoryInterface
{
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

    public function buscarPorIdYEntidad(
        int $id,
        int $entidadId
    ): Meta {
        return Meta::query()
            ->with([
                'objetivo.plan.entidad',
                'responsable',
                'usuario',
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

    public function obtenerObjetivosActivosPorEntidad(
        int $entidadId
    ): Collection {
        return Objetivo::query()
            ->with([
                'plan.entidad',
            ])
            ->where('estado', 'Activo')
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

    public function buscarObjetivoActivoPorIdYEntidad(
        int $objetivoId,
        int $entidadId
    ): ?Objetivo {
        return Objetivo::query()
            ->with([
                'plan.entidad',
            ])
            ->whereKey($objetivoId)
            ->where('estado', 'Activo')
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

    public function crear(array $datos): Meta
    {
        return Meta::create($datos);
    }

    public function actualizar(
        Meta $meta,
        array $datos
    ): Meta {
        $meta->update($datos);

        return $meta->refresh();
    }
}
