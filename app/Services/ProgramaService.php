<?php

namespace App\Services;

use App\Enums\EstadoProcesoPrograma;
use App\Enums\EstadoPrograma;
use App\Models\Programa;
use App\Models\User;
use App\Repositories\Contracts\ProgramaRepositoryInterface;
use Illuminate\Auth\Access\AuthorizationException;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\DB;
use Illuminate\Validation\ValidationException;

class ProgramaService
{
    public function __construct(
        private readonly ProgramaRepositoryInterface $repository
    ) {
    }

    /**
     * Obtener el resumen institucional.
     */
    public function obtenerResumen(
        User $usuario
    ): array {
        $entidadId = $this->obtenerEntidadId($usuario);

        return [
            'totalProgramas' => $this->repository
                ->contarPorEntidad($entidadId),

            'totalActivos' => $this->repository
                ->contarActivosPorEntidad($entidadId),

            'totalInactivos' => $this->repository
                ->contarInactivosPorEntidad($entidadId),
        ];
    }

    /**
     * Listar los programas de la entidad.
     */
    public function listar(
        User $usuario,
        int $porPagina = 10
    ): LengthAwarePaginator {
        return $this->repository->listarPorEntidad(
            $this->obtenerEntidadId($usuario),
            $porPagina
        );
    }

    /**
     * Obtener los datos del formulario.
     */
    public function obtenerDatosFormulario(
        User $usuario
    ): array {
        $entidadId = $this->obtenerEntidadId($usuario);

        return [
            'codigo' => $this->generarSiguienteCodigo(
                $entidadId
            ),

            'responsables' => $this->repository
                ->obtenerResponsablesActivosPorEntidad(
                    $entidadId
                ),

            'objetivos' => $this->repository
                ->obtenerObjetivosActivosPorEntidad(
                    $entidadId
                ),

            'estados' => EstadoPrograma::cases(),

            'estadosProceso' =>
                EstadoProcesoPrograma::cases(),
        ];
    }

    /**
     * Crear un programa.
     */
    public function crear(
        User $usuario,
        array $datos
    ): Programa {
        $entidadId = $this->obtenerEntidadId($usuario);

        $objetivos = $this->validarRelaciones(
            $entidadId,
            $datos
        );

        return DB::transaction(function () use (
            $usuario,
            $entidadId,
            $datos,
            $objetivos
        ): Programa {
            $datosPrograma = Arr::except(
                $datos,
                [
                    'objetivos',
                    'codigo',
                    'entidad_id',
                    'usuario_id',
                    'estado',
                    'estado_proceso',
                ]
            );

            $datosPrograma['entidad_id'] = $entidadId;
            $datosPrograma['usuario_id'] = $usuario->id;

            $datosPrograma['codigo'] =
                $this->generarSiguienteCodigo(
                    $entidadId
                );

            $datosPrograma['estado'] =
                EstadoPrograma::ACTIVO->value;

            $datosPrograma['estado_proceso'] =
                EstadoProcesoPrograma::BORRADOR->value;

            $programa = $this->repository->crear(
                $datosPrograma
            );

            $this->repository->sincronizarObjetivos(
                $programa,
                $objetivos
            );

            return $programa;
        });
    }

    /**
     * Obtener un programa perteneciente a la entidad.
     */
    public function obtenerPorId(
        User $usuario,
        int $programaId
    ): Programa {
        return $this->repository->buscarPorIdYEntidad(
            $programaId,
            $this->obtenerEntidadId($usuario)
        );
    }

    /**
     * Obtener los datos para editar.
     */
    public function obtenerDatosEdicion(
        User $usuario,
        int $programaId
    ): array {
        return array_merge(
            $this->obtenerDatosFormulario($usuario),
            [
                'programa' => $this->obtenerPorId(
                    $usuario,
                    $programaId
                ),
            ]
        );
    }

    /**
     * Actualizar la información de un programa.
     */
    public function actualizar(
        User $usuario,
        int $programaId,
        array $datos
    ): Programa {
        $entidadId = $this->obtenerEntidadId($usuario);

        $programa = $this->repository
            ->buscarPorIdYEntidad(
                $programaId,
                $entidadId
            );

        $objetivos = $this->validarRelaciones(
            $entidadId,
            $datos
        );

        return DB::transaction(function () use (
            $programa,
            $datos,
            $objetivos
        ): Programa {
            $datosPrograma = Arr::except(
                $datos,
                [
                    'objetivos',
                    'codigo',
                    'entidad_id',
                    'usuario_id',
                    'estado',
                    'estado_proceso',
                ]
            );

            $programa = $this->repository->actualizar(
                $programa,
                $datosPrograma
            );

            $this->repository->sincronizarObjetivos(
                $programa,
                $objetivos
            );

            return $programa;
        });
    }

    /**
     * Actualizar el estado administrativo.
     */
    public function actualizarEstado(
        User $usuario,
        int $programaId,
        bool $activo
    ): Programa {
        $programa = $this->obtenerPorId(
            $usuario,
            $programaId
        );

        $estado = $activo
            ? EstadoPrograma::ACTIVO->value
            : EstadoPrograma::INACTIVO->value;

        return $this->repository->actualizar(
            $programa,
            ['estado' => $estado]
        );
    }

    /**
     * Actualizar el estado del proceso.
     */
    public function actualizarEstadoProceso(
        User $usuario,
        int $programaId,
        string $estadoProceso
    ): Programa {
        if (!in_array(
            $estadoProceso,
            EstadoProcesoPrograma::values(),
            true
        )) {
            throw ValidationException::withMessages([
                'estado_proceso' =>
                    'El estado del proceso seleccionado no es válido.',
            ]);
        }

        $programa = $this->obtenerPorId(
            $usuario,
            $programaId
        );

        return $this->repository->actualizar(
            $programa,
            ['estado_proceso' => $estadoProceso]
        );
    }

    /**
     * Validar que el responsable y los objetivos
     * pertenezcan a la entidad del usuario.
     */
    private function validarRelaciones(
        int $entidadId,
        array $datos
    ): array {
        $responsableId = (int) (
            $datos['responsable_id'] ?? 0
        );

        $responsables = $this->repository
            ->obtenerResponsablesActivosPorEntidad(
                $entidadId
            );

        if (!$responsables->contains('id', $responsableId)) {
            throw ValidationException::withMessages([
                'responsable_id' =>
                    'El responsable seleccionado no pertenece '
                    . 'a la entidad o se encuentra inactivo.',
            ]);
        }

        $objetivosSolicitados = collect(
            $datos['objetivos'] ?? []
        )
            ->map(
                fn ($objetivoId): int =>
                    (int) $objetivoId
            )
            ->unique()
            ->values();

        $objetivosDisponibles = $this->repository
            ->obtenerObjetivosActivosPorEntidad(
                $entidadId
            )
            ->pluck('id')
            ->map(
                fn ($objetivoId): int =>
                    (int) $objetivoId
            );

        $objetivosInvalidos = $objetivosSolicitados
            ->diff($objetivosDisponibles);

        if (
            $objetivosSolicitados->isEmpty()
            || $objetivosInvalidos->isNotEmpty()
        ) {
            throw ValidationException::withMessages([
                'objetivos' =>
                    'Uno o más objetivos no pertenecen a la entidad '
                    . 'o se encuentran inactivos.',
            ]);
        }

        return $objetivosSolicitados->all();
    }

    /**
     * Generar el siguiente código de la entidad.
     */
    private function generarSiguienteCodigo(
        int $entidadId
    ): string {
        $ultimoPrograma = $this->repository
            ->obtenerUltimoPorEntidad(
                $entidadId
            );

        if (!$ultimoPrograma) {
            return 'PROG-001';
        }

        preg_match(
            '/(\d+)$/',
            $ultimoPrograma->codigo,
            $coincidencias
        );

        $ultimoNumero = isset($coincidencias[1])
            ? (int) $coincidencias[1]
            : 0;

        return sprintf(
            'PROG-%03d',
            $ultimoNumero + 1
        );
    }

    /**
     * Obtener la entidad del usuario.
     */
    private function obtenerEntidadId(
        User $usuario
    ): int {
        if (!$usuario->entidad_id) {
            throw new AuthorizationException(
                'El usuario no tiene una entidad institucional asignada.'
            );
        }

        return (int) $usuario->entidad_id;
    }
}