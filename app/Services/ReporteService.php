<?php
namespace App\Services;

use App\Models\User;
use App\Repositories\Contracts\ReporteRepositoryInterface;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Illuminate\Database\Eloquent\Collection;

class ReporteService
{
    public function __construct(private readonly ReporteRepositoryInterface $repository) {}

    public function tipos(): array
    {
        return [
            'planes' => 'Planes institucionales',
            'programas' => 'Programas de inversión',
            'proyectos' => 'Proyectos de inversión',
            'avances' => 'Avances físicos',
            'presupuestos' => 'Ejecución presupuestaria',
        ];
    }

    public function entidadId(User $usuario): int
    {
        abort_if(!$usuario->entidad_id, 403, 'Su usuario no tiene entidad asignada.');
        return (int) $usuario->entidad_id;
    }

    public function proyectos(User $usuario): Collection
    {
        return $this->repository->proyectos($this->entidadId($usuario));
    }

    public function listado(User $usuario, string $tipo, array $filtros): LengthAwarePaginator
    {
        return $this->repository->consulta($tipo, $this->entidadId($usuario), $filtros)
            ->paginate(15)->withQueryString();
    }

    public function exportacion(User $usuario, string $tipo, array $filtros, int $limite): Collection
    {
        $query = $this->repository->consulta($tipo, $this->entidadId($usuario), $filtros);
        abort_if((clone $query)->count() > $limite, 422,
            "El reporte supera el límite de {$limite} registros. Aplique filtros para exportarlo.");
        return $query->get();
    }

    public function columnas(string $tipo): array
    {
        return match ($tipo) {
            'planes' => ['Código', 'Plan', 'Período inicial', 'Período final', 'Versión', 'Proceso', 'Estado'],
            'programas' => ['Código', 'Programa', 'Período inicial', 'Período final', 'Proceso', 'Estado'],
            'proyectos' => ['Código', 'Proyecto', 'Programa', 'Inicio', 'Fin', 'Presupuesto aprobado', 'Proceso', 'Estado'],
            'avances' => ['Proyecto', 'Indicador', 'Año', 'Período', 'Fecha corte', 'Programado', 'Ejecutado', 'Cumplimiento %', 'Estado'],
            'presupuestos' => ['Proyecto', 'Año', 'Período', 'Fecha corte', 'Monto programado', 'Presupuesto vigente', 'Monto ejecutado', 'Ejecución %', 'Estado'],
        };
    }

    public function fila(string $tipo, object $r): array
    {
        return match ($tipo) {
            'planes' => [$r->codigo, $r->nombre, $r->periodo_inicio, $r->periodo_fin, $r->version, $r->estado_proceso, $r->estado],
            'programas' => [$r->codigo, $r->nombre, $r->periodo_inicio, $r->periodo_fin, $r->estado_proceso, $r->estado],
            'proyectos' => [$r->codigo, $r->nombre, $r->programa?->nombre, $r->fecha_inicio?->format('Y-m-d'), $r->fecha_fin?->format('Y-m-d'), (float) $r->presupuesto_aprobado, $r->estado_proceso, $r->estado_administrativo],
            'avances' => [$r->proyecto?->codigo.' - '.$r->proyecto?->nombre, $r->indicador?->codigo.' - '.$r->indicador?->nombre, $r->anio, $r->periodo, $r->fecha_corte?->format('Y-m-d'), (float) $r->valor_programado, (float) $r->valor_ejecutado, $r->porcentaje_cumplimiento, $r->estado],
            'presupuestos' => [$r->proyecto?->codigo.' - '.$r->proyecto?->nombre, $r->anio, $r->periodo, $r->fecha_corte?->format('Y-m-d'), (float) $r->monto_programado, (float) $r->presupuesto_vigente, (float) $r->monto_ejecutado, $r->porcentaje_ejecucion, $r->estado],
        };
    }
}
