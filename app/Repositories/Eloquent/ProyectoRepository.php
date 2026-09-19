<?php

namespace App\Repositories\Eloquent;

use App\Models\Macrosector;
use App\Models\Programa;
use App\Models\Proyecto;
use App\Models\Subsector;
use App\Models\User;
use App\Repositories\Contracts\ProyectoRepositoryInterface;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Illuminate\Database\Eloquent\Collection;

class ProyectoRepository implements ProyectoRepositoryInterface
{
    public function __construct(
        private readonly Proyecto $model
    ) {
    }

    /**
     * Contar todos los proyectos de una entidad.
     */
    public function contarPorEntidad(
        int $entidadId
    ): int {
        return $this->model
            ->newQuery()
            ->where('entidad_id', $entidadId)
            ->count();
    }

    /**
     * Contar proyectos administrativamente activos.
     */
    public function contarActivosPorEntidad(
        int $entidadId
    ): int {
        return $this->model
            ->newQuery()
            ->where('entidad_id', $entidadId)
            ->where('estado_administrativo', 'Activo')
            ->count();
    }

    /**
     * Contar proyectos administrativamente inactivos.
     */
    public function contarInactivosPorEntidad(
        int $entidadId
    ): int {
        return $this->model
            ->newQuery()
            ->where('entidad_id', $entidadId)
            ->where('estado_administrativo', 'Inactivo')
            ->count();
    }

    /**
     * Obtener el presupuesto total registrado por la entidad.
     */
    public function obtenerPresupuestoTotalPorEntidad(
        int $entidadId
    ): string {
        return (string) $this->model
            ->newQuery()
            ->where('entidad_id', $entidadId)
            ->sum('presupuesto_aprobado');
    }

    /**
     * Obtener el último proyecto registrado por una entidad.
     */
    public function obtenerUltimoPorEntidad(
        int $entidadId
    ): ?Proyecto {
        return $this->model
            ->newQuery()
            ->where('entidad_id', $entidadId)
            ->orderByDesc('id')
            ->first();
    }

    /**
     * Listar proyectos pertenecientes a una entidad.
     */
    public function listarPorEntidad(
        int $entidadId,
        int $porPagina = 10
    ): LengthAwarePaginator {
        return $this->model
            ->newQuery()
            ->where('entidad_id', $entidadId)
            ->with([
                'programa',
                'entidad',
                'responsable.rol',
                'usuario',
                'subsector.sector.macrosector',
            ])
            ->orderByDesc('id')
            ->paginate($porPagina);
    }

    /**
     * Buscar un proyecto dentro de una entidad.
     */
    public function buscarPorIdYEntidad(
        int $id,
        int $entidadId
    ): Proyecto {
        return $this->model
            ->newQuery()
            ->where('entidad_id', $entidadId)
            ->with([
                'programa.objetivos.plan',
                'entidad',
                'responsable.rol',
                'usuario',
                'subsector.sector.macrosector',
            ])
            ->findOrFail($id);
    }

    /**
     * Obtener programas activos de una entidad.
     */
    public function obtenerProgramasActivosPorEntidad(
        int $entidadId
    ): Collection {
        return Programa::query()
            ->where('entidad_id', $entidadId)
            ->where('estado', 'Activo')
            ->orderBy('codigo')
            ->get();
    }

    /**
     * Obtener usuarios activos pertenecientes a una entidad.
     */
    public function obtenerResponsablesActivosPorEntidad(
        int $entidadId
    ): Collection {
        return User::query()
            ->where('entidad_id', $entidadId)
            ->where('estado', 'Activo')
            ->with('rol')
            ->orderBy('nombres')
            ->orderBy('apellidos')
            ->get();
    }

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
     * Buscar un subsector activo junto con su jerarquía.
     */
    public function buscarSubsectorActivoPorId(
        int $id
    ): Subsector {
        return Subsector::query()
            ->where('estado', 'Activo')
            ->whereHas(
                'sector',
                function ($query) {
                    $query->where('estado', 'Activo');
                }
            )
            ->whereHas(
                'sector.macrosector',
                function ($query) {
                    $query->where('estado', 'Activo');
                }
            )
            ->with('sector.macrosector')
            ->findOrFail($id);
    }

    /**
     * Crear un proyecto.
     */
    public function crear(
        array $datos
    ): Proyecto {
        return $this->model
            ->newQuery()
            ->create($datos);
    }

    /**
     * Actualizar un proyecto.
     */
    public function actualizar(
        Proyecto $proyecto,
        array $datos
    ): Proyecto {
        $proyecto->fill($datos);
        $proyecto->save();

        return $proyecto->refresh();
    }
}