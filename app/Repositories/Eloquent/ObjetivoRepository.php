<?php

namespace App\Repositories\Eloquent;

use App\Models\Objetivo;
use App\Models\Ods;
use App\Models\OdsMeta;
use App\Models\Plan;
use App\Models\PndObjetivo;
use App\Models\PndPolitica;
use App\Repositories\Contracts\ObjetivoRepositoryInterface;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Illuminate\Database\Eloquent\Collection;

class ObjetivoRepository implements ObjetivoRepositoryInterface
{
    public function listarPorEntidad(
        int $entidadId,
        int $porPagina = 10
    ): LengthAwarePaginator {
        return Objetivo::query()
            ->with([
                'plan',
                'pnd.eje.pnd',
                'politicaPnd',
                'ods',
                'metaOds',
            ])
            ->whereHas(
                'plan',
                fn ($query) => $query->where(
                    'entidad_id',
                    $entidadId
                )
            )
            ->orderByDesc('id')
            ->paginate($porPagina);
    }

    public function obtenerUltimo(): ?Objetivo
    {
        return Objetivo::query()
            ->orderByDesc('id')
            ->first();
    }

    public function buscarPorIdYEntidad(
        int $id,
        int $entidadId
    ): Objetivo {
        return Objetivo::query()
            ->with([
                'plan.entidad',
                'pnd.eje.pnd',
                'politicaPnd',
                'ods',
                'metaOds',
                'usuario',
            ])
            ->whereHas(
                'plan',
                fn ($query) => $query->where(
                    'entidad_id',
                    $entidadId
                )
            )
            ->findOrFail($id);
    }

    public function obtenerPlanesActivosPorEntidad(
        int $entidadId
    ): Collection {
        return Plan::query()
            ->where('entidad_id', $entidadId)
            ->where('estado', 'Activo')
            ->orderBy('nombre')
            ->get();
    }

    public function buscarPlanActivoPorIdYEntidad(
        int $planId,
        int $entidadId
    ): Plan {
        return Plan::query()
            ->where('entidad_id', $entidadId)
            ->where('estado', 'Activo')
            ->findOrFail($planId);
    }

    public function obtenerPndActivos(): Collection
    {
        return PndObjetivo::query()
            ->with([
                'eje.pnd',
            ])
            ->whereHas(
                'eje.pnd',
                fn ($query) => $query->where(
                    'estado',
                    'Activo'
                )
            )
            ->orderBy('numero')
            ->get();
    }

    public function obtenerOdsActivos(): Collection
    {
        return Ods::query()
            ->where('estado', 'Activo')
            ->orderBy('codigo')
            ->get();
    }

    public function obtenerPoliticasActivasPorPnd(
        int $pndObjetivoId
    ): Collection {
        return PndPolitica::query()
            ->where(
                'pnd_objetivo_id',
                $pndObjetivoId
            )
            ->orderBy('codigo')
            ->get([
                'id',
                'pnd_objetivo_id',
                'codigo',
                'nombre',
            ]);
    }

    public function obtenerMetasActivasPorOds(
        int $odsId
    ): Collection {
        return OdsMeta::query()
            ->where('ods_id', $odsId)
            ->where('estado', 'Activo')
            ->orderBy('codigo')
            ->get([
                'id',
                'ods_id',
                'codigo',
                'nombre',
            ]);
    }

    public function crear(array $datos): Objetivo
    {
        return Objetivo::create($datos);
    }

    public function actualizar(
        Objetivo $objetivo,
        array $datos
    ): Objetivo {
        $objetivo->update($datos);

        return $objetivo->refresh();
    }
}