<?php

namespace App\Repositories\Eloquent;

use App\Models\Avance;
use App\Models\Indicador;
use App\Models\Proyecto;
use App\Repositories\Contracts\AvanceRepositoryInterface;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Illuminate\Database\Eloquent\Collection;

class AvanceRepository implements AvanceRepositoryInterface
{
    public function __construct(private readonly Avance $model) {}

    public function listarPorEntidad(int $entidadId, int $porPagina = 10): LengthAwarePaginator
    {
        return $this->model->newQuery()
            ->where('entidad_id', $entidadId)
            ->with(['proyecto.programa', 'indicador.meta', 'creador'])
            ->orderByDesc('fecha_corte')->orderByDesc('id')->paginate($porPagina);
    }

    public function buscarPorIdYEntidad(int $id, int $entidadId): Avance
    {
        return $this->model->newQuery()->where('entidad_id', $entidadId)
            ->with(['proyecto.programa', 'indicador.meta', 'creador', 'editor'])
            ->findOrFail($id);
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

    public function obtenerIndicadoresDelProyecto(Proyecto $proyecto): Collection
    {
        return Indicador::query()
            ->where('estado', 'Activo')
            ->whereHas('meta.objetivo.programas', fn ($query) => $query->where('programas.id', $proyecto->programa_id))
            ->with('meta.objetivo')->orderBy('codigo')->get();
    }

    public function indicadorPerteneceAlProyecto(int $indicadorId, Proyecto $proyecto): bool
    {
        return $this->obtenerIndicadoresDelProyecto($proyecto)->contains('id', $indicadorId);
    }

    public function crear(array $datos): Avance { return $this->model->newQuery()->create($datos); }

    public function actualizar(Avance $avance, array $datos): Avance
    {
        $avance->update($datos);
        return $avance->refresh();
    }
}
