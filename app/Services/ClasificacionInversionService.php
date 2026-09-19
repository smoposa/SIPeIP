<?php

namespace App\Services;

use App\Models\Macrosector;
use App\Models\Sector;
use App\Models\Subsector;
use App\Repositories\Contracts\ClasificacionInversionRepositoryInterface;
use Illuminate\Database\Eloquent\Collection;

class ClasificacionInversionService
{
    public function __construct(
        private readonly ClasificacionInversionRepositoryInterface $repository
    ) {
    }

    /*
    |--------------------------------------------------------------------------
    | Consultas generales
    |--------------------------------------------------------------------------
    */

    /**
     * Obtener el resumen y la clasificación completa.
     */
    public function obtenerResumen(): array
    {
        return [
            'totalMacrosectores' => $this->repository
                ->contarMacrosectores(),

            'totalSectores' => $this->repository
                ->contarSectores(),

            'totalSubsectores' => $this->repository
                ->contarSubsectores(),

            'macrosectores' => $this->repository
                ->obtenerJerarquia(),
        ];
    }

    /**
     * Obtener la clasificación jerárquica completa.
     */
    public function obtenerJerarquia(): Collection
    {
        return $this->repository->obtenerJerarquia();
    }


    /*
    |--------------------------------------------------------------------------
    | Macrosector
    |--------------------------------------------------------------------------
    */

    public function obtenerMacrosectoresActivos(): Collection
    {
        return $this->repository->obtenerMacrosectoresActivos();
    }

    public function obtenerMacrosectorPorId(int $id): Macrosector
    {
        return $this->repository->obtenerMacrosectorPorId($id);
    }

    public function crearMacrosector(array $datos): Macrosector
    {
        return $this->repository->crearMacrosector([
            ...$datos,
            'estado' => 'Activo',
        ]);
    }

    public function actualizarMacrosector(
        Macrosector $macrosector,
        array $datos
    ): Macrosector {
        return $this->repository->actualizarMacrosector(
            $macrosector,
            $datos
        );
    }

    public function actualizarEstadoMacrosector(
        Macrosector $macrosector,
        bool $activo
    ): Macrosector {
        return $this->repository->actualizarMacrosector(
            $macrosector,
            [
                'estado' => $activo
                    ? 'Activo'
                    : 'Inactivo',
            ]
        );
    }


    /*
    |--------------------------------------------------------------------------
    | Sector
    |--------------------------------------------------------------------------
    */

    public function obtenerSectoresActivosPorMacrosector(
        int $macrosectorId
    ): Collection {
        return $this->repository
            ->obtenerSectoresActivosPorMacrosector(
                $macrosectorId
            );
    }

    public function obtenerSectorPorId(int $id): Sector
    {
        return $this->repository->obtenerSectorPorId($id);
    }

    public function crearSector(array $datos): Sector
    {
        return $this->repository->crearSector([
            ...$datos,
            'estado' => 'Activo',
        ]);
    }

    public function actualizarSector(
        Sector $sector,
        array $datos
    ): Sector {
        return $this->repository->actualizarSector(
            $sector,
            $datos
        );
    }

    public function actualizarEstadoSector(
        Sector $sector,
        bool $activo
    ): Sector {
        return $this->repository->actualizarSector(
            $sector,
            [
                'estado' => $activo
                    ? 'Activo'
                    : 'Inactivo',
            ]
        );
    }


    /*
    |--------------------------------------------------------------------------
    | Subsector
    |--------------------------------------------------------------------------
    */

    public function obtenerSubsectoresActivosPorSector(
        int $sectorId
    ): Collection {
        return $this->repository
            ->obtenerSubsectoresActivosPorSector(
                $sectorId
            );
    }

    public function obtenerSubsectorPorId(int $id): Subsector
    {
        return $this->repository->obtenerSubsectorPorId($id);
    }

    public function crearSubsector(array $datos): Subsector
    {
        return $this->repository->crearSubsector([
            ...$datos,
            'estado' => 'Activo',
        ]);
    }

    public function actualizarSubsector(
        Subsector $subsector,
        array $datos
    ): Subsector {
        return $this->repository->actualizarSubsector(
            $subsector,
            $datos
        );
    }

    public function actualizarEstadoSubsector(
        Subsector $subsector,
        bool $activo
    ): Subsector {
        return $this->repository->actualizarSubsector(
            $subsector,
            [
                'estado' => $activo
                    ? 'Activo'
                    : 'Inactivo',
            ]
        );
    }
}