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
        private readonly ClasificacionInversionRepositoryInterface $repository,
        private readonly CatalogoService $catalogos
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
        return $this->catalogos->guardar('sectores', $datos, $sector->id);
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
        return $this->catalogos->guardar('subsectores', $datos, $subsector->id);
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

    /**
     * Datos de consulta del primer nivel, incluidos registros inactivos.
     */
    public function datosListadoMacrosectores(): array
    {
        return [
            'nivel' => 'macrosector',
            'titulo' => 'Clasificación de la inversión',
            'registros' => $this->repository->listarMacrosectoresCatalogo(),
        ];
    }

    public function datosListadoSectores(int $macrosectorId): array
    {
        return [
            'nivel' => 'sector',
            'titulo' => 'Sectores',
            'macrosector' => $this->repository->obtenerMacrosectorPorId($macrosectorId),
            'registros' => $this->repository->listarSectoresCatalogo($macrosectorId),
        ];
    }

    public function datosListadoSubsectores(int $sectorId): array
    {
        return [
            'nivel' => 'subsector',
            'titulo' => 'Subsectores',
            'sector' => $this->repository->obtenerSectorPorId($sectorId),
            'registros' => $this->repository->listarSubsectoresCatalogo($sectorId),
        ];
    }

    /**
     * Registrar un macrosector desde el panel con estado inicial Activo.
     */
    public function registrarMacrosectorPanel(array $datos): Macrosector
    {
        return $this->repository->crearMacrosector([
            'nombre' => $datos['nombre'],
            'estado' => 'Activo',
        ]);
    }

    public function guardarMacrosectorPanel(Macrosector $macrosector, array $datos): Macrosector
    {
        return $this->repository->actualizarMacrosector(
            $macrosector,
            $this->camposPanel($datos, ['nombre', 'estado'])
        );
    }

    /**
     * El macrosector se fija desde la ruta y no puede cambiarse en el panel.
     */
    public function registrarSectorPanel(Macrosector $macrosector, array $datos): Sector
    {
        if ($macrosector->estado !== 'Activo') {
            throw \Illuminate\Validation\ValidationException::withMessages([
                'nombre' => 'Active el macrosector antes de registrar nuevos sectores.',
            ]);
        }

        return $this->repository->crearSector([
            'macrosector_id' => $macrosector->id,
            'nombre' => $datos['nombre'],
            'estado' => 'Activo',
        ]);
    }

    public function guardarSectorPanel(Sector $sector, array $datos): Sector
    {
        return $this->repository->actualizarSector(
            $sector,
            $this->camposPanel($datos, ['nombre', 'estado'])
        );
    }

    /**
     * El sector se fija desde la ruta y se conserva el nivel Nacional.
     */
    public function registrarSubsectorPanel(Sector $sector, array $datos): Subsector
    {
        $macrosector = $this->repository->obtenerMacrosectorPorId($sector->macrosector_id);

        if ($sector->estado !== 'Activo' || $macrosector->estado !== 'Activo') {
            throw \Illuminate\Validation\ValidationException::withMessages([
                'nombre' => 'Active el sector y su macrosector antes de registrar nuevos subsectores.',
            ]);
        }

        return $this->repository->crearSubsector([
            'sector_id' => $sector->id,
            'codigo' => $datos['codigo'],
            'nombre' => $datos['nombre'],
            'nivel_gobierno' => 'Nacional',
            'estado' => 'Activo',
        ]);
    }

    public function guardarSubsectorPanel(Subsector $subsector, array $datos): Subsector
    {
        return $this->repository->actualizarSubsector(
            $subsector,
            $this->camposPanel($datos, ['codigo', 'nombre', 'estado'])
        );
    }

    /**
     * Recibir solo campos validados, preservando relaciones y estado no enviado.
     */
    private function camposPanel(array $datos, array $permitidos): array
    {
        $campos = array_intersect_key($datos, array_flip($permitidos));

        if (
            array_key_exists('estado', $campos)
            && !in_array($campos['estado'], ['Activo', 'Inactivo'], true)
        ) {
            throw \Illuminate\Validation\ValidationException::withMessages([
                'estado' => 'El estado seleccionado no es válido.',
            ]);
        }

        return $campos;
    }
}
