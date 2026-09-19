<?php

namespace App\Repositories\Eloquent;

use App\Models\Objetivo;
use App\Models\Programa;
use App\Models\User;
use App\Repositories\Contracts\ProgramaRepositoryInterface;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Illuminate\Support\Collection;

class ProgramaRepository implements ProgramaRepositoryInterface
{
    public function __construct(
        private readonly Programa $model
    ) {
    }

    /**
     * Contar todos los programas pertenecientes a una entidad.
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
     * Contar programas activos pertenecientes a una entidad.
     */
    public function contarActivosPorEntidad(
        int $entidadId
    ): int {
        return $this->model
            ->newQuery()
            ->where('entidad_id', $entidadId)
            ->where('estado', 'Activo')
            ->count();
    }

    /**
     * Contar programas inactivos pertenecientes a una entidad.
     */
    public function contarInactivosPorEntidad(
        int $entidadId
    ): int {
        return $this->model
            ->newQuery()
            ->where('entidad_id', $entidadId)
            ->where('estado', 'Inactivo')
            ->count();
    }

    /**
     * Obtener el último programa registrado por una entidad.
     */
    public function obtenerUltimoPorEntidad(
        int $entidadId
    ): ?Programa {
        return $this->model
            ->newQuery()
            ->where('entidad_id', $entidadId)
            ->orderByDesc('id')
            ->first();
    }

    /**
     * Listar los programas pertenecientes a una entidad.
     */
    public function listarPorEntidad(
        int $entidadId,
        int $porPagina = 10
    ): LengthAwarePaginator {
        return $this->model
            ->newQuery()
            ->where('entidad_id', $entidadId)
            ->with([
                'entidad',
                'responsable.rol',
                'usuario',
                'objetivos',
            ])
            ->withCount('proyectos')
            ->orderByDesc('id')
            ->paginate($porPagina);
    }

    /**
     * Buscar un programa dentro de una entidad.
     */
    public function buscarPorIdYEntidad(
        int $id,
        int $entidadId
    ): Programa {
        return $this->model
            ->newQuery()
            ->where('entidad_id', $entidadId)
            ->with([
                'entidad',
                'responsable.rol',
                'usuario',
                'objetivos.metas.indicadores',
                'proyectos',
            ])
            ->findOrFail($id);
    }

    /**
     * Obtener responsables activos de una entidad.
     *
     * Se consideran los usuarios activos pertenecientes a la entidad.
     * La autorización para administrar inversión pública se controla
     * mediante roles y permisos en las acciones del módulo.
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
     * Obtener los objetivos estratégicos activos
     * pertenecientes a los planes de una entidad.
     */
    public function obtenerObjetivosActivosPorEntidad(
        int $entidadId
    ): Collection {
        return Objetivo::query()
            ->whereHas(
                'plan',
                function ($query) use ($entidadId) {
                    $query->where(
                        'entidad_id',
                        $entidadId
                    );
                }
            )
            ->where('estado', 'Activo')
            ->with('plan')
            ->orderBy('codigo')
            ->get();
    }

    /**
     * Crear un programa.
     */
    public function crear(
        array $datos
    ): Programa {
        return $this->model
            ->newQuery()
            ->create($datos);
    }

    /**
     * Actualizar un programa.
     */
    public function actualizar(
        Programa $programa,
        array $datos
    ): Programa {
        $programa->fill($datos);
        $programa->save();

        return $programa->refresh();
    }

    /**
     * Sincronizar objetivos estratégicos.
     */
    public function sincronizarObjetivos(
        Programa $programa,
        array $objetivos
    ): void {
        $programa->objetivos()->sync(
            $objetivos
        );
    }
}