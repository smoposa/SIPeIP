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
                'ods.agenda',
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
                'ods.agenda',
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
        return PndObjetivo::query()->disponibles()->with(['eje.pnd'])
            ->orderBy('numero')
            ->get();
    }

    public function obtenerOdsActivos(): Collection
    {
        return Ods::query()->disponibles()->with('agenda')
            ->orderBy('codigo')
            ->get();
    }

    public function obtenerPoliticasActivasPorPnd(
        int $pndObjetivoId
    ): Collection {
        return PndPolitica::query()->disponibles()
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
        return OdsMeta::query()->disponibles()
            ->where('ods_id', $odsId)
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