<?php
namespace App\Repositories\Eloquent;

use App\Models\{Avance, Plan, Presupuesto, Programa, Proyecto};
use App\Repositories\Contracts\ReporteRepositoryInterface;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;

class ReporteRepository implements ReporteRepositoryInterface
{
    public function consulta(string $tipo, int $entidadId, array $filtros): Builder
    {
        $query = match ($tipo) {
            'planes' => Plan::query()->with('entidad'),
            'programas' => Programa::query()->with('entidad'),
            'proyectos' => Proyecto::query()->with(['programa', 'entidad']),
            'avances' => Avance::query()->with(['proyecto', 'indicador']),
            'presupuestos' => Presupuesto::query()->with('proyecto'),
            default => abort(422),
        };
        // La entidad proviene exclusivamente del usuario autenticado.
        $query->where('entidad_id', $entidadId);

        if (!empty($filtros['anio'])) {
            $anio = (int) $filtros['anio'];
            if (in_array($tipo, ['planes', 'programas'], true)) {
                $query->where('periodo_inicio', '<=', $anio)->where('periodo_fin', '>=', $anio);
            } elseif ($tipo === 'proyectos') {
                $query->whereYear('fecha_inicio', '<=', $anio)->whereYear('fecha_fin', '>=', $anio);
            } else {
                $query->where('anio', $anio);
            }
        }
        if (in_array($tipo, ['avances', 'presupuestos'], true)) {
            if (!empty($filtros['periodo'])) {
                $query->where('periodo', $filtros['periodo']);
            }
            if (!empty($filtros['proyecto_id'])) {
                $query->where('proyecto_id', (int) $filtros['proyecto_id']);
            }
        }
        return $query->orderByDesc('id');
    }

    public function proyectos(int $entidadId): Collection
    {
        return Proyecto::query()->where('entidad_id', $entidadId)
            ->orderBy('codigo')->get(['id', 'codigo', 'nombre']);
    }
}
