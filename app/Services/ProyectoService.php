<?php

namespace App\Services;

use App\Enums\EstadoAdministrativoProyecto;
use App\Enums\EstadoProcesoProyecto;
use App\Enums\EstadoProyecto;
use App\Models\Programa;
use App\Models\Proyecto;
use App\Models\User;
use App\Repositories\Contracts\ProyectoRepositoryInterface;
use Carbon\Carbon;
use Illuminate\Auth\Access\AuthorizationException;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Illuminate\Support\Facades\DB;
use Illuminate\Validation\ValidationException;

class ProyectoService
{
    public function __construct(
        private readonly ProyectoRepositoryInterface $repository
    ) {
    }

    /**
     * Obtener el resumen de proyectos de la entidad.
     */
    public function obtenerResumen(
        User $usuario
    ): array {
        $entidadId = $this->obtenerEntidadId($usuario);

        return [
            'totalProyectos' => $this->repository
                ->contarPorEntidad($entidadId),

            'totalActivos' => $this->repository
                ->contarActivosPorEntidad($entidadId),

            'totalInactivos' => $this->repository
                ->contarInactivosPorEntidad($entidadId),

            'presupuestoTotal' => $this->repository
                ->obtenerPresupuestoTotalPorEntidad($entidadId),
        ];
    }

    /**
     * Listar proyectos pertenecientes a la entidad.
     */
    public function listar(
        User $usuario,
        int $porPagina = 10
    ): LengthAwarePaginator {
        return $this->repository
            ->listarPorEntidad(
                $this->obtenerEntidadId($usuario),
                $porPagina
            );
    }

    /**
     * Obtener los datos necesarios para el formulario.
     */
    public function obtenerDatosFormulario(
        User $usuario,
        ?Proyecto $proyecto = null
    ): array {
        $entidadId = $this->obtenerEntidadId($usuario);

        return [
            'codigo' => $proyecto?->codigo
                ?? $this->generarCodigo($entidadId),

            'programas' => $this->repository
                ->obtenerProgramasActivosPorEntidad($entidadId),

            'responsables' => $this->repository
                ->obtenerResponsablesActivosPorEntidad($entidadId),

            'macrosectores' => $this->repository
                ->obtenerMacrosectoresActivos(),

            'proyecto' => $proyecto,
        ];
    }

    /**
     * Obtener un proyecto garantizando aislamiento por entidad.
     */
    public function obtenerPorId(
        User $usuario,
        int $proyectoId
    ): Proyecto {
        return $this->repository
            ->buscarPorIdYEntidad(
                $proyectoId,
                $this->obtenerEntidadId($usuario)
            );
    }

    /**
     * Crear un proyecto de inversión pública.
     */
    public function crear(
        User $usuario,
        array $datos
    ): Proyecto {
        $entidadId = $this->obtenerEntidadId($usuario);

        $programa = $this->validarRelaciones(
            $entidadId,
            $datos
        );

        $this->validarPeriodoPrograma(
            $programa,
            $datos['fecha_inicio'],
            $datos['fecha_fin']
        );

        return DB::transaction(function () use (
            $usuario,
            $entidadId,
            $datos
        ) {
            return $this->repository->crear([
                'programa_id' => $datos['programa_id'],
                'entidad_id' => $entidadId,
                'subsector_id' => $datos['subsector_id'],
                'codigo' => $this->generarCodigo($entidadId),
                'nombre' => $datos['nombre'],
                'descripcion' => $datos['descripcion'] ?? null,
                'fecha_inicio' => $datos['fecha_inicio'],
                'fecha_fin' => $datos['fecha_fin'],
                'presupuesto_aprobado' => $datos[
                    'presupuesto_aprobado'
                ],
                'responsable_id' => $datos['responsable_id'],
                'estado' => EstadoProyecto::PLANIFICADO->value,
                'estado_administrativo' =>
                    EstadoAdministrativoProyecto::ACTIVO->value,
                'estado_proceso' =>
                    EstadoProcesoProyecto::BORRADOR->value,
                'usuario_id' => $usuario->id,
            ]);
        });
    }

    /**
     * Actualizar la información general de un proyecto.
     */
    public function actualizar(
        User $usuario,
        int $proyectoId,
        array $datos
    ): Proyecto {
        $entidadId = $this->obtenerEntidadId($usuario);

        $proyecto = $this->repository
            ->buscarPorIdYEntidad(
                $proyectoId,
                $entidadId
            );

        $programa = $this->validarRelaciones(
            $entidadId,
            $datos
        );

        $this->validarPeriodoPrograma(
            $programa,
            $datos['fecha_inicio'],
            $datos['fecha_fin']
        );

        return DB::transaction(function () use (
            $proyecto,
            $datos
        ) {
            return $this->repository->actualizar(
                $proyecto,
                [
                    'programa_id' => $datos['programa_id'],
                    'subsector_id' => $datos['subsector_id'],
                    'nombre' => $datos['nombre'],
                    'descripcion' => $datos['descripcion'] ?? null,
                    'fecha_inicio' => $datos['fecha_inicio'],
                    'fecha_fin' => $datos['fecha_fin'],
                    'presupuesto_aprobado' => $datos[
                        'presupuesto_aprobado'
                    ],
                    'responsable_id' => $datos['responsable_id'],
                    'estado' => $datos['estado'],
                ]
            );
        });
    }

    /**
     * Activar o inactivar administrativamente un proyecto.
     */
    public function actualizarEstadoAdministrativo(
        User $usuario,
        int $proyectoId,
        bool $activo
    ): Proyecto {
        $proyecto = $this->obtenerPorId(
            $usuario,
            $proyectoId
        );

        return $this->repository->actualizar(
            $proyecto,
            [
                'estado_administrativo' => $activo
                    ? EstadoAdministrativoProyecto::ACTIVO->value
                    : EstadoAdministrativoProyecto::INACTIVO->value,
            ]
        );
    }

    /**
     * Actualizar el estado del proceso de priorización.
     */
    public function actualizarEstadoProceso(
        User $usuario,
        int $proyectoId,
        string $estadoProceso
    ): Proyecto {
        if (!in_array(
            $estadoProceso,
            EstadoProcesoProyecto::values(),
            true
        )) {
            throw ValidationException::withMessages([
                'estado_proceso' =>
                    'El estado del proceso seleccionado no es válido.',
            ]);
        }

        $proyecto = $this->obtenerPorId(
            $usuario,
            $proyectoId
        );

        return $this->repository->actualizar(
            $proyecto,
            [
                'estado_proceso' => $estadoProceso,
            ]
        );
    }

    /**
     * Validar que programa, responsable y subsector sean válidos.
     */
    private function validarRelaciones(
        int $entidadId,
        array $datos
    ): Programa {
        $programa = $this->repository
            ->obtenerProgramasActivosPorEntidad($entidadId)
            ->firstWhere(
                'id',
                (int) $datos['programa_id']
            );

        if (!$programa) {
            throw ValidationException::withMessages([
                'programa_id' =>
                    'El programa seleccionado no pertenece a su entidad o está inactivo.',
            ]);
        }

        $responsableValido = $this->repository
            ->obtenerResponsablesActivosPorEntidad($entidadId)
            ->contains(
                'id',
                (int) $datos['responsable_id']
            );

        if (!$responsableValido) {
            throw ValidationException::withMessages([
                'responsable_id' =>
                    'El responsable seleccionado no pertenece a su entidad o está inactivo.',
            ]);
        }

        try {
            $this->repository->buscarSubsectorActivoPorId(
                (int) $datos['subsector_id']
            );
        } catch (\Throwable) {
            throw ValidationException::withMessages([
                'subsector_id' =>
                    'El subsector seleccionado no es válido o está inactivo.',
            ]);
        }

        return $programa;
    }

    /**
     * Verificar que las fechas estén dentro del período del programa.
     */
    private function validarPeriodoPrograma(
        Programa $programa,
        string $fechaInicio,
        string $fechaFin
    ): void {
        $anioInicio = Carbon::parse($fechaInicio)->year;
        $anioFin = Carbon::parse($fechaFin)->year;

        if (
            $anioInicio < $programa->periodo_inicio
            || $anioFin > $programa->periodo_fin
        ) {
            throw ValidationException::withMessages([
                'fecha_inicio' =>
                    'Las fechas del proyecto deben estar dentro del período del programa seleccionado.',
            ]);
        }
    }

    /**
     * Generar el siguiente código por entidad.
     */
    private function generarCodigo(
        int $entidadId
    ): string {
        $ultimoProyecto = $this->repository
            ->obtenerUltimoPorEntidad($entidadId);

        $ultimoNumero = 0;

        if (
            $ultimoProyecto
            && preg_match(
                '/(\d+)$/',
                $ultimoProyecto->codigo,
                $coincidencias
            )
        ) {
            $ultimoNumero = (int) $coincidencias[1];
        }

        return 'PRY-' . str_pad(
            (string) ($ultimoNumero + 1),
            3,
            '0',
            STR_PAD_LEFT
        );
    }

    /**
     * Obtener la entidad del usuario autenticado.
     */
    private function obtenerEntidadId(
        User $usuario
    ): int {
        if (!$usuario->entidad_id) {
            throw new AuthorizationException(
                'El usuario no tiene una entidad asignada.'
            );
        }

        return (int) $usuario->entidad_id;
    }
}