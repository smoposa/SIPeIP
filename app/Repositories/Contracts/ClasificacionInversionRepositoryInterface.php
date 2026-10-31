<?php

namespace App\Repositories\Contracts;

use App\Models\Macrosector;
use App\Models\Sector;
use App\Models\Subsector;
use Illuminate\Database\Eloquent\Collection;

interface ClasificacionInversionRepositoryInterface
{
    // Consultas generales

    // Obtener la clasificación jerárquica con filtro opcional de estado.
    public function obtenerJerarquia(
        bool $soloActivos = true
    ): Collection;

    // Contar macrosectores según el filtro de estado.
    public function contarMacrosectores(
        bool $soloActivos = true
    ): int;

    // Contar sectores según su estado y el de su macrosector.
    public function contarSectores(
        bool $soloActivos = true
    ): int;

    // Contar subsectores según su estado y el de sus niveles superiores.
    public function contarSubsectores(
        bool $soloActivos = true
    ): int;

    // Macrosector

    // Obtener macrosectores activos para los selectores.
    public function obtenerMacrosectoresActivos(): Collection;

    // Obtener un macrosector por ID.
    public function obtenerMacrosectorPorId(int $id): Macrosector;

    // Crear un macrosector.
    public function crearMacrosector(array $datos): Macrosector;

    // Actualizar un macrosector.
    public function actualizarMacrosector(
        Macrosector $macrosector,
        array $datos
    ): Macrosector;

    // Sector

    // Obtener sectores activos de un macrosector activo.
    public function obtenerSectoresActivosPorMacrosector(
        int $macrosectorId
    ): Collection;

    // Obtener un sector por ID.
    public function obtenerSectorPorId(int $id): Sector;

    // Crear un sector.
    public function crearSector(array $datos): Sector;

    // Actualizar un sector.
    public function actualizarSector(
        Sector $sector,
        array $datos
    ): Sector;

    // Subsector

    // Obtener subsectores activos con sus niveles superiores activos.
    public function obtenerSubsectoresActivosPorSector(
        int $sectorId
    ): Collection;

    // Obtener un subsector por ID.
    public function obtenerSubsectorPorId(int $id): Subsector;

    // Crear un subsector.
    public function crearSubsector(array $datos): Subsector;

    // Actualizar un subsector.
    public function actualizarSubsector(
        Subsector $subsector,
        array $datos
    ): Subsector;

    // Listados del catálogo

    // Listar macrosectores y contar sus niveles inferiores según el filtro.
    public function listarMacrosectoresCatalogo(
        bool $soloActivos = true
    ): Collection;

    // Listar sectores y contar sus subsectores según el filtro.
    public function listarSectoresCatalogo(
        int $macrosectorId,
        bool $soloActivos = true
    ): Collection;

    // Listar subsectores según su estado y el de sus niveles superiores.
    public function listarSubsectoresCatalogo(
        int $sectorId,
        bool $soloActivos = true
    ): Collection;
}