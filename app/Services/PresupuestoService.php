<?php

namespace App\Services;

use App\Enums\EstadoSeguimiento;
use App\Models\Presupuesto;
use App\Models\User;
use App\Repositories\Contracts\PresupuestoRepositoryInterface;
use Illuminate\Auth\Access\AuthorizationException;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Illuminate\Support\Facades\DB;
use Illuminate\Validation\ValidationException;
use Carbon\Carbon;

class PresupuestoService
{
    public function __construct(private readonly PresupuestoRepositoryInterface $repository) {}

    public function listar(User $usuario): LengthAwarePaginator
    {
        return $this->repository->listarPorEntidad($this->entidadId($usuario));
    }

    public function datosFormulario(User $usuario, ?Presupuesto $presupuesto = null): array
    {
        return ['proyectos' => $this->repository->obtenerProyectosActivosPorEntidad($this->entidadId($usuario)), 'presupuesto' => $presupuesto];
    }

    public function obtener(User $usuario, int $id): Presupuesto
    {
        return $this->repository->buscarPorIdYEntidad($id, $this->entidadId($usuario));
    }

    public function crear(User $usuario, array $datos): Presupuesto
    {
        $entidadId = $this->entidadId($usuario);
        $proyecto = $this->repository->buscarProyectoPorEntidad((int) $datos['proyecto_id'], $entidadId);
        $this->validarPeriodo($proyecto, $datos);
        return DB::transaction(fn () => $this->repository->crear([...$datos, 'entidad_id' => $entidadId, 'created_by' => $usuario->id, 'updated_by' => null]));
    }

    public function actualizar(User $usuario, int $id, array $datos): Presupuesto
    {
        $presupuesto = $this->obtener($usuario, $id);
        if ($presupuesto->estado === EstadoSeguimiento::CERRADO->value) {
            throw ValidationException::withMessages(['estado' => 'Un presupuesto cerrado no puede modificarse.']);
        }
        $proyecto = $this->repository->buscarProyectoPorEntidad((int) $datos['proyecto_id'], $this->entidadId($usuario));
        $this->validarPeriodo($proyecto, $datos);
        return DB::transaction(fn () => $this->repository->actualizar($presupuesto, [...$datos, 'updated_by' => $usuario->id]));
    }

    private function entidadId(User $usuario): int
    {
        if (!$usuario->entidad_id) throw new AuthorizationException('El usuario no tiene una entidad asignada.');
        return (int) $usuario->entidad_id;
    }

    private function validarPeriodo($proyecto, array $datos): void
    {
        $anio = (int) $datos['anio'];
        if ($anio < $proyecto->fecha_inicio->year || $anio > $proyecto->fecha_fin->year) {
            throw ValidationException::withMessages(['anio' => 'El año debe encontrarse dentro del periodo de ejecución del proyecto.']);
        }
        if (Carbon::parse($datos['fecha_corte'])->year !== $anio) {
            throw ValidationException::withMessages(['fecha_corte' => 'La fecha de corte debe pertenecer al año seleccionado.']);
        }
    }
}
