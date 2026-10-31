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
    // Consultas generales

    // Obtener la jerarquía con filtro opcional de estado en todos los niveles.
    public function obtenerJerarquia(
        bool $soloActivos = true
    ): Collection {
        return Macrosector::query()
            ->when(
                $soloActivos,
                fn ($consulta) => $consulta->where('estado', 'Activo')
            )
            ->with([
                'sectores' => function ($consulta) use ($soloActivos) {
                    $consulta
                        ->when(
                            $soloActivos,
                            fn ($query) => $query->where('estado', 'Activo')
                        )
                        ->orderBy('nombre')
                        ->with([
                            'subsectores' => function ($consultaSubsector) use ($soloActivos) {
                                $consultaSubsector
                                    ->when(
                                        $soloActivos,
                                        fn ($query) => $query->where('estado', 'Activo')
                                    )
                                    ->orderBy('codigo');
                            },
                        ]);
                },
            ])
            ->orderBy('nombre')
            ->get();
    }

    // Contar macrosectores según el filtro de estado.
    public function contarMacrosectores(
        bool $soloActivos = true
    ): int {
        return Macrosector::query()
            ->when(
                $soloActivos,
                fn ($consulta) => $consulta->where('estado', 'Activo')
            )
            ->count();
    }

    // Contar sectores activos cuyo macrosector también esté activo.
    public function contarSectores(
        bool $soloActivos = true
    ): int {
        return Sector::query()
            ->when(
                $soloActivos,
                function ($consulta) {
                    $consulta
                        ->where('estado', 'Activo')
                        ->whereHas(
                            'macrosector',
                            fn ($query) => $query->where('estado', 'Activo')
                        );
                }
            )
            ->count();
    }

    // Contar subsectores activos cuyos niveles superiores estén activos.
    public function contarSubsectores(
        bool $soloActivos = true
    ): int {
        return Subsector::query()
            ->when(
                $soloActivos,
                function ($consulta) {
                    $consulta
                        ->where('estado', 'Activo')
                        ->whereHas('sector', function ($query) {
                            $query
                                ->where('estado', 'Activo')
                                ->whereHas(
                                    'macrosector',
                                    fn ($macrosector) => $macrosector
                                        ->where('estado', 'Activo')
                                );
                        });
                }
            )
            ->count();
    }

    // Macrosector

    // Obtener macrosectores activos para los selectores.
    public function obtenerMacrosectoresActivos(): Collection
    {
        return Macrosector::query()
            ->where('estado', 'Activo')
            ->orderBy('nombre')
            ->get();
    }

    // Obtener un macrosector por ID.
    public function obtenerMacrosectorPorId(int $id): Macrosector
    {
        return Macrosector::query()
            ->with([
                'sectores.subsectores',
            ])
            ->findOrFail($id);
    }

    // Crear un macrosector.
    public function crearMacrosector(array $datos): Macrosector
    {
        return Macrosector::create($datos);
    }

    // Actualizar un macrosector.
    public function actualizarMacrosector(
        Macrosector $macrosector,
        array $datos
    ): Macrosector {
        $macrosector->update($datos);

        return $macrosector->refresh();
    }

    // Sector

    // Obtener sectores activos de un macrosector activo.
    public function obtenerSectoresActivosPorMacrosector(
        int $macrosectorId
    ): Collection {
        return Sector::query()
            ->where('macrosector_id', $macrosectorId)
            ->where('estado', 'Activo')
            ->whereHas(
                'macrosector',
                fn ($consulta) => $consulta->where('estado', 'Activo')
            )
            ->orderBy('nombre')
            ->get();
    }

    // Obtener un sector por ID.
    public function obtenerSectorPorId(int $id): Sector
    {
        return Sector::query()
            ->with([
                'macrosector',
                'subsectores',
            ])
            ->findOrFail($id);
    }

    // Crear un sector.
    public function crearSector(array $datos): Sector
    {
        return Sector::create($datos);
    }

    // Actualizar un sector.
    public function actualizarSector(
        Sector $sector,
        array $datos
    ): Sector {
        $sector->update($datos);

        return $sector->refresh();
    }

    // Subsector

    // Obtener subsectores activos con su sector y macrosector activos.
    public function obtenerSubsectoresActivosPorSector(
        int $sectorId
    ): Collection {
        return Subsector::query()
            ->where('sector_id', $sectorId)
            ->where('estado', 'Activo')
            ->whereHas('sector', function ($consulta) {
                $consulta
                    ->where('estado', 'Activo')
                    ->whereHas(
                        'macrosector',
                        fn ($query) => $query->where('estado', 'Activo')
                    );
            })
            ->orderBy('codigo')
            ->get();
    }

    // Obtener un subsector por ID.
    public function obtenerSubsectorPorId(int $id): Subsector
    {
        return Subsector::query()
            ->with([
                'sector.macrosector',
            ])
            ->findOrFail($id);
    }

    // Crear un subsector.
    public function crearSubsector(array $datos): Subsector
    {
        return Subsector::create($datos);
    }

    // Actualizar un subsector.
    public function actualizarSubsector(
        Subsector $subsector,
        array $datos
    ): Subsector {
        $subsector->update($datos);

        return $subsector->refresh();
    }

    // Listados del catálogo

    // Listar macrosectores y contar sus niveles inferiores según el filtro.
    public function listarMacrosectoresCatalogo(
        bool $soloActivos = true
    ): Collection {
        return Macrosector::query()
            ->when(
                $soloActivos,
                fn ($consulta) => $consulta->where('estado', 'Activo')
            )
            ->withCount([
                'sectores' => function ($consulta) use ($soloActivos) {
                    $consulta->when(
                        $soloActivos,
                        fn ($query) => $query->where('estado', 'Activo')
                    );
                },
            ])
            ->with([
                'sectores' => function ($consulta) use ($soloActivos) {
                    $consulta
                        ->select('id', 'macrosector_id')
                        ->when(
                            $soloActivos,
                            fn ($query) => $query->where('estado', 'Activo')
                        )
                        ->withCount([
                            'subsectores' => function ($query) use ($soloActivos) {
                                $query->when(
                                    $soloActivos,
                                    fn ($subsector) => $subsector
                                        ->where('estado', 'Activo')
                                );
                            },
                        ]);
                },
            ])
            ->orderBy('nombre')
            ->get();
    }

    // Listar sectores y contar sus subsectores según el filtro.
    public function listarSectoresCatalogo(
        int $macrosectorId,
        bool $soloActivos = true
    ): Collection {
        return Sector::query()
            ->where('macrosector_id', $macrosectorId)
            ->when(
                $soloActivos,
                function ($consulta) {
                    $consulta
                        ->where('estado', 'Activo')
                        ->whereHas(
                            'macrosector',
                            fn ($query) => $query->where('estado', 'Activo')
                        );
                }
            )
            ->withCount([
                'subsectores' => function ($consulta) use ($soloActivos) {
                    $consulta->when(
                        $soloActivos,
                        fn ($query) => $query->where('estado', 'Activo')
                    );
                },
            ])
            ->orderBy('nombre')
            ->get();
    }

    // Listar subsectores según su estado y el de sus niveles superiores.
    public function listarSubsectoresCatalogo(
        int $sectorId,
        bool $soloActivos = true
    ): Collection {
        return Subsector::query()
            ->where('sector_id', $sectorId)
            ->when(
                $soloActivos,
                function ($consulta) {
                    $consulta
                        ->where('estado', 'Activo')
                        ->whereHas('sector', function ($query) {
                            $query
                                ->where('estado', 'Activo')
                                ->whereHas(
                                    'macrosector',
                                    fn ($macrosector) => $macrosector
                                        ->where('estado', 'Activo')
                                );
                        });
                }
            )
            ->orderBy('codigo')
            ->get();
    }
}