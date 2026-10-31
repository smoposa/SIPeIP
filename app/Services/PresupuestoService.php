<?php

namespace App\Services;

use App\Enums\EstadoSeguimiento;
use App\Models\Presupuesto;
use App\Models\User;
use App\Repositories\Contracts\PresupuestoRepositoryInterface;
use Carbon\Carbon;
use Illuminate\Auth\Access\AuthorizationException;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Illuminate\Support\Facades\DB;
use Illuminate\Validation\ValidationException;

class PresupuestoService
{
    public function __construct(
        private readonly PresupuestoRepositoryInterface $repository
    ) {
    }

    // Listar los presupuestos de la entidad del usuario.
    public function listar(User $usuario): LengthAwarePaginator
    {
        return $this->repository->listarPorEntidad(
            $this->entidadId($usuario)
        );
    }

    // Obtener los datos necesarios para el formulario.
    public function datosFormulario(
        User $usuario,
        ?Presupuesto $presupuesto = null
    ): array {
        return [
            'proyectos' => $this->repository
                ->obtenerProyectosActivosPorEntidad(
                    $this->entidadId($usuario)
                ),

            'presupuesto' => $presupuesto,
        ];
    }

    // Obtener un presupuesto de la entidad del usuario.
    public function obtener(
        User $usuario,
        int $id
    ): Presupuesto {
        return $this->repository->buscarPorIdYEntidad(
            $id,
            $this->entidadId($usuario)
        );
    }

    // Registrar un presupuesto dentro de la entidad del usuario.
    public function crear(
        User $usuario,
        array $datos
    ): Presupuesto {
        $entidadId = $this->entidadId($usuario);

        $proyecto = $this->repository->buscarProyectoPorEntidad(
            (int) $datos['proyecto_id'],
            $entidadId
        );

        $this->validarPeriodo($proyecto, $datos);

        return DB::transaction(
            fn () => $this->repository->crear([
                ...$datos,
                'entidad_id' => $entidadId,
                'created_by' => $usuario->id,
                'updated_by' => null,
            ])
        );
    }

    // Actualizar un presupuesto que no se encuentre cerrado.
    public function actualizar(
        User $usuario,
        int $id,
        array $datos
    ): Presupuesto {
        $presupuesto = $this->obtener(
            $usuario,
            $id
        );

        if ($presupuesto->estado === EstadoSeguimiento::CERRADO->value) {
            throw ValidationException::withMessages([
                'estado' => 'Un presupuesto cerrado no puede modificarse.',
            ]);
        }

        $proyecto = $this->repository->buscarProyectoPorEntidad(
            (int) $datos['proyecto_id'],
            $this->entidadId($usuario)
        );

        $this->validarPeriodo($proyecto, $datos);

        return DB::transaction(
            fn () => $this->repository->actualizar(
                $presupuesto,
                [
                    ...$datos,
                    'updated_by' => $usuario->id,
                ]
            )
        );
    }

    // Reabrir un presupuesto cerrado de la entidad del usuario.
    public function reabrir(
        User $usuario,
        int $id
    ): Presupuesto {
        $rolesPermitidos = config(
            'permisos.acciones.presupuestos.reabrir',
            []
        );

        if (!in_array($usuario->rol?->codigo, $rolesPermitidos, true)) {
            throw new AuthorizationException(
                'No tiene permisos para reabrir presupuestos.'
            );
        }

        $entidadId = $this->entidadId($usuario);

        return DB::transaction(function () use (
            $usuario,
            $id,
            $entidadId
        ) {
            // Bloquear el registro mientras se realiza la reapertura.
            $presupuesto = $this->repository
                ->buscarPorIdYEntidadParaActualizar(
                    $id,
                    $entidadId
                );

            if ($presupuesto->estado !== EstadoSeguimiento::CERRADO->value) {
                throw ValidationException::withMessages([
                    'estado' => 'Solo se pueden reabrir presupuestos cerrados.',
                ]);
            }

            // Actualizar el estado, el último editor y la fecha.
            return $this->repository->actualizar(
                $presupuesto,
                [
                    'estado' => EstadoSeguimiento::BORRADOR->value,
                    'updated_by' => $usuario->id,
                    'updated_at' => now(),
                ]
            );
        });
    }

    // Obtener la entidad asignada al usuario.
    private function entidadId(User $usuario): int
    {
        if (!$usuario->entidad_id) {
            throw new AuthorizationException(
                'El usuario no tiene una entidad asignada.'
            );
        }

        return (int) $usuario->entidad_id;
    }

    // Validar el año y la fecha de corte del seguimiento presupuestario.
    private function validarPeriodo(
        $proyecto,
        array $datos
    ): void {
        $anio = (int) $datos['anio'];

        if (
            $anio < $proyecto->fecha_inicio->year
            || $anio > $proyecto->fecha_fin->year
        ) {
            throw ValidationException::withMessages([
                'anio' => 'El año debe encontrarse dentro del periodo de ejecución del proyecto.',
            ]);
        }

        if (Carbon::parse($datos['fecha_corte'])->year !== $anio) {
            throw ValidationException::withMessages([
                'fecha_corte' => 'La fecha de corte debe pertenecer al año seleccionado.',
            ]);
        }
    }
}