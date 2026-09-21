<?php

namespace App\Services;

use App\Enums\EstadoSeguimiento;
use App\Models\Avance;
use App\Models\User;
use App\Repositories\Contracts\AvanceRepositoryInterface;
use Illuminate\Auth\Access\AuthorizationException;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Illuminate\Support\Facades\DB;
use Illuminate\Validation\ValidationException;
use Carbon\Carbon;

class AvanceService
{
    public function __construct(private readonly AvanceRepositoryInterface $repository) {}

    public function listar(User $usuario): LengthAwarePaginator
    {
        return $this->repository->listarPorEntidad($this->entidadId($usuario));
    }

    public function datosFormulario(User $usuario, ?Avance $avance = null): array
    {
        $proyectos = $this->repository->obtenerProyectosActivosPorEntidad($this->entidadId($usuario));
        $proyecto = $avance ? $avance->proyecto : ($proyectos->firstWhere('id', (int) request('proyecto_id')));

        return [
            'proyectos' => $proyectos,
            'indicadores' => $proyecto ? $this->repository->obtenerIndicadoresDelProyecto($proyecto) : collect(),
            'avance' => $avance,
        ];
    }

    public function indicadores(User $usuario, int $proyectoId)
    {
        $proyecto = $this->repository->buscarProyectoPorEntidad($proyectoId, $this->entidadId($usuario));
        return $this->repository->obtenerIndicadoresDelProyecto($proyecto);
    }

    public function obtener(User $usuario, int $id): Avance
    {
        return $this->repository->buscarPorIdYEntidad($id, $this->entidadId($usuario));
    }

    public function crear(User $usuario, array $datos): Avance
    {
        $entidadId = $this->entidadId($usuario);
        $proyecto = $this->repository->buscarProyectoPorEntidad((int) $datos['proyecto_id'], $entidadId);
        $this->validarIndicador((int) $datos['indicador_id'], $proyecto);
        $this->validarPeriodo($proyecto, $datos);

        return DB::transaction(fn () => $this->repository->crear([
            ...$datos,
            'entidad_id' => $entidadId,
            'created_by' => $usuario->id,
            'updated_by' => null,
        ]));
    }

    public function actualizar(User $usuario, int $id, array $datos): Avance
    {
        $avance = $this->obtener($usuario, $id);
        $this->validarEditable($avance->estado);
        $proyecto = $this->repository->buscarProyectoPorEntidad((int) $datos['proyecto_id'], $this->entidadId($usuario));
        $this->validarIndicador((int) $datos['indicador_id'], $proyecto);
        $this->validarPeriodo($proyecto, $datos);

        return DB::transaction(fn () => $this->repository->actualizar($avance, [
            ...$datos,
            'updated_by' => $usuario->id,
        ]));
    }

    private function validarIndicador(int $indicadorId, $proyecto): void
    {
        if (!$this->repository->indicadorPerteneceAlProyecto($indicadorId, $proyecto)) {
            throw ValidationException::withMessages(['indicador_id' => 'El indicador no pertenece a la planificación vinculada con el proyecto.']);
        }
    }

    private function validarEditable(string $estado): void
    {
        if ($estado === EstadoSeguimiento::CERRADO->value) {
            throw ValidationException::withMessages(['estado' => 'Un avance cerrado no puede modificarse.']);
        }
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

    private function entidadId(User $usuario): int
    {
        if (!$usuario->entidad_id) throw new AuthorizationException('El usuario no tiene una entidad asignada.');
        return (int) $usuario->entidad_id;
    }
}
