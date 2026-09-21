<?php

namespace App\Repositories\Eloquent;

use App\Models\Presupuesto;
use App\Models\Proyecto;
use App\Repositories\Contracts\PresupuestoRepositoryInterface;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Illuminate\Database\Eloquent\Collection;

class PresupuestoRepository implements PresupuestoRepositoryInterface
{
    public function __construct(private readonly Presupuesto $model) {}

    public function listarPorEntidad(int $entidadId, int $porPagina = 10): LengthAwarePaginator
    {
        return $this->model->newQuery()->where('entidad_id', $entidadId)
            ->with(['proyecto.programa', 'creador'])
            ->orderByDesc('fecha_corte')->orderByDesc('id')->paginate($porPagina);
    }

    public function buscarPorIdYEntidad(int $id, int $entidadId): Presupuesto
    {
        return $this->model->newQuery()->where('entidad_id', $entidadId)
            ->with(['proyecto.programa', 'creador', 'editor'])->findOrFail($id);
    }

    public function buscarProyectoPorEntidad(int $id, int $entidadId): Proyecto
    {
        return Proyecto::query()->where('entidad_id', $entidadId)->findOrFail($id);
    }

    public function obtenerProyectosActivosPorEntidad(int $entidadId): Collection
    {
        return Proyecto::query()->where('entidad_id', $entidadId)
            ->where('estado_administrativo', 'Activo')->with('programa')->orderBy('codigo')->get();
    }

    public function crear(array $datos): Presupuesto { return $this->model->newQuery()->create($datos); }

    public function actualizar(Presupuesto $presupuesto, array $datos): Presupuesto
    {
        $presupuesto->update($datos);
        return $presupuesto->refresh();
    }
}
