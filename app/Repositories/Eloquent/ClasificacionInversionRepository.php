<?php

namespace App\Repositories\Eloquent;

use App\Models\Macrosector;
use App\Models\Sector;
use App\Models\Subsector;
use App\Repositories\Contracts\ClasificacionInversionRepositoryInterface;
use Illuminate\Database\Eloquent\Collection;

class ClasificacionInversionRepository implements
    ClasificacionInversionRepositoryInterface
{
    /*
    |--------------------------------------------------------------------------
    | Consultas generales
    |--------------------------------------------------------------------------
    */

    /**
     * Obtener la clasificación completa:
     * Macrosector → Sector → Subsector.
     */
    public function obtenerJerarquia(): Collection
    {
        return Macrosector::query()
            ->with([
                'sectores' => function ($consulta) {
                    $consulta
                        ->orderBy('nombre')
                        ->with([
                            'subsectores' => function ($consultaSubsector) {
                                $consultaSubsector
                                    ->orderBy('codigo');
                            },
                        ]);
                },
            ])
            ->orderBy('nombre')
            ->get();
    }

    /**
     * Contar macrosectores.
     */
    public function contarMacrosectores(): int
    {
        return Macrosector::query()->count();
    }

    /**
     * Contar sectores.
     */
    public function contarSectores(): int
    {
        return Sector::query()->count();
    }

    /**
     * Contar subsectores.
     */
    public function contarSubsectores(): int
    {
        return Subsector::query()->count();
    }


    /*
    |--------------------------------------------------------------------------
    | Macrosector
    |--------------------------------------------------------------------------
    */

    /**
     * Obtener macrosectores activos.
     */
    public function obtenerMacrosectoresActivos(): Collection
    {
        return Macrosector::query()
            ->where('estado', 'Activo')
            ->orderBy('nombre')
            ->get();
    }

    /**
     * Obtener un macrosector por ID.
     */
    public function obtenerMacrosectorPorId(int $id): Macrosector
    {
        return Macrosector::query()
            ->with([
                'sectores.subsectores',
            ])
            ->findOrFail($id);
    }

    /**
     * Crear un macrosector.
     */
    public function crearMacrosector(array $datos): Macrosector
    {
        return Macrosector::create($datos);
    }

    /**
     * Actualizar un macrosector.
     */
    public function actualizarMacrosector(
        Macrosector $macrosector,
        array $datos
    ): Macrosector {
        $macrosector->update($datos);

        return $macrosector->refresh();
    }


    /*
    |--------------------------------------------------------------------------
    | Sector
    |--------------------------------------------------------------------------
    */

    /**
     * Obtener los sectores activos de un macrosector.
     */
    public function obtenerSectoresActivosPorMacrosector(
        int $macrosectorId
    ): Collection {
        return Sector::query()
            ->where('macrosector_id', $macrosectorId)
            ->where('estado', 'Activo')
            ->orderBy('nombre')
            ->get();
    }

    /**
     * Obtener un sector por ID.
     */
    public function obtenerSectorPorId(int $id): Sector
    {
        return Sector::query()
            ->with([
                'macrosector',
                'subsectores',
            ])
            ->findOrFail($id);
    }

    /**
     * Crear un sector.
     */
    public function crearSector(array $datos): Sector
    {
        return Sector::create($datos);
    }

    /**
     * Actualizar un sector.
     */
    public function actualizarSector(
        Sector $sector,
        array $datos
    ): Sector {
        $sector->update($datos);

        return $sector->refresh();
    }


    /*
    |--------------------------------------------------------------------------
    | Subsector
    |--------------------------------------------------------------------------
    */

    /**
     * Obtener los subsectores activos de un sector.
     */
    public function obtenerSubsectoresActivosPorSector(
        int $sectorId
    ): Collection {
        return Subsector::query()
            ->where('sector_id', $sectorId)
            ->where('estado', 'Activo')
            ->orderBy('codigo')
            ->get();
    }

    /**
     * Obtener un subsector por ID.
     */
    public function obtenerSubsectorPorId(int $id): Subsector
    {
        return Subsector::query()
            ->with([
                'sector.macrosector',
            ])
            ->findOrFail($id);
    }

    /**
     * Crear un subsector.
     */
    public function crearSubsector(array $datos): Subsector
    {
        return Subsector::create($datos);
    }

    /**
     * Actualizar un subsector.
     */
    public function actualizarSubsector(
        Subsector $subsector,
        array $datos
    ): Subsector {
        $subsector->update($datos);

        return $subsector->refresh();
    }
}