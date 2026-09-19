<?php

namespace App\Repositories\Contracts;

use App\Models\Macrosector;
use App\Models\Sector;
use App\Models\Subsector;
use Illuminate\Database\Eloquent\Collection;

interface ClasificacionInversionRepositoryInterface
{
    /*
    |--------------------------------------------------------------------------
    | Consultas generales
    |--------------------------------------------------------------------------
    */

    /**
     * Obtener toda la clasificación jerárquica.
     */
    public function obtenerJerarquia(): Collection;

    /**
     * Contar los registros de cada nivel.
     */
    public function contarMacrosectores(): int;

    public function contarSectores(): int;

    public function contarSubsectores(): int;


    /*
    |--------------------------------------------------------------------------
    | Macrosector
    |--------------------------------------------------------------------------
    */

    public function obtenerMacrosectoresActivos(): Collection;

    public function obtenerMacrosectorPorId(int $id): Macrosector;

    public function crearMacrosector(array $datos): Macrosector;

    public function actualizarMacrosector(
        Macrosector $macrosector,
        array $datos
    ): Macrosector;


    /*
    |--------------------------------------------------------------------------
    | Sector
    |--------------------------------------------------------------------------
    */

    public function obtenerSectoresActivosPorMacrosector(
        int $macrosectorId
    ): Collection;

    public function obtenerSectorPorId(int $id): Sector;

    public function crearSector(array $datos): Sector;

    public function actualizarSector(
        Sector $sector,
        array $datos
    ): Sector;


    /*
    |--------------------------------------------------------------------------
    | Subsector
    |--------------------------------------------------------------------------
    */

    public function obtenerSubsectoresActivosPorSector(
        int $sectorId
    ): Collection;

    public function obtenerSubsectorPorId(int $id): Subsector;

    public function crearSubsector(array $datos): Subsector;

    public function actualizarSubsector(
        Subsector $subsector,
        array $datos
    ): Subsector;
}