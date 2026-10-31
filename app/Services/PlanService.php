<?php

namespace App\Services;

use App\Models\User;
use App\Models\Plan;
use App\Models\Entidad;
use App\Enums\EstadoPlan;
use App\Enums\EstadoEntidad;
use App\Enums\EstadoProcesoPlan;
use App\Repositories\Contracts\PlanRepositoryInterface;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use DomainException;

class PlanService
{
    public function __construct(
        private readonly PlanRepositoryInterface $planRepository
    ) {
    }

    /**
     * Obtener resumen de planes accesibles.
     */
    public function obtenerResumen(User $usuario): array
    {
        $entidadId = $this->obtenerEntidadId($usuario);

        return [
            'totalPlanes' =>
                $this->planRepository->contarPorEntidad($entidadId),

            'planesActivos' =>
                $this->planRepository->contarActivosPorEntidad($entidadId),

            'planesInactivos' =>
                $this->planRepository->contarInactivosPorEntidad($entidadId),
        ];
    }

    /**
     * Listar planes de la entidad del usuario.
     */
    public function listar(
        User $usuario,
        int $porPagina = 10
    ): LengthAwarePaginator {
        $entidadId = $this->obtenerEntidadId($usuario);

        return $this->planRepository->listarPorEntidad(
            $entidadId,
            $porPagina
        );
    }

    /**
     * Obtener un plan de la entidad del usuario.
     */
    public function obtenerAccesible(
        int $id,
        User $usuario
    ): Plan {
        $entidadId = $this->obtenerEntidadId($usuario);

        return $this->planRepository->buscarPorIdYEntidad(
            $id,
            $entidadId
        );
    }

    /**
     * Obtener los datos para consultar el detalle del plan.
     */
    public function obtenerDetalle(
        int $id,
        User $usuario,
        bool $consultarObjetivos = false
    ): Plan {
        $plan = $this->obtenerAccesible(
            $id,
            $usuario
        );

        if ($consultarObjetivos) {
            $plan->loadMissing([
                'objetivos.pnd',
                'objetivos.politicaPnd',
                'objetivos.ods',
                'objetivos.metaOds',
                'objetivos.usuario',
            ]);

            $plan->objetivos->loadCount('metas');
        }

        return $plan;
    }

    /**
     * Generar el siguiente código del plan.
     */
    public function generarCodigo(User $usuario): string
    {
        $entidad = $this->obtenerEntidadActiva(
            $usuario
        );

        return $this->generarCodigoParaEntidad(
            $entidad
        );
    }

    /**
     * Crear un Plan Estratégico Institucional.
     */
    public function crear(
        array $datos,
        User $usuario
    ): Plan {
        $entidad = $this->obtenerEntidadActiva(
            $usuario
        );

        $datos['codigo'] =
            $this->generarCodigoParaEntidad($entidad);

        $datos['entidad_id'] = $entidad->id;
        $datos['usuario_id'] = $usuario->id;

        $datos['tipo'] =
            'Plan Estratégico Institucional';

        $datos['estado'] =
            EstadoPlan::ACTIVO->value;

        $datos['estado_proceso'] =
            EstadoProcesoPlan::BORRADOR->value;

        $datos['version'] = 1;

        return $this->planRepository->crear($datos);
    }

    /**
     * Actualizar información de un plan accesible.
     */
    public function actualizar(
        int $id,
        array $datos,
        User $usuario
    ): Plan {
        $plan = $this->obtenerAccesible(
            $id,
            $usuario
        );

        return $this->planRepository->actualizar(
            $plan,
            $datos
        );
    }

    /**
     * Cambiar el estado administrativo.
     */
    public function cambiarEstadoAdministrativo(
        int $id,
        bool $activo,
        User $usuario
    ): Plan {
        $plan = $this->obtenerAccesible(
            $id,
            $usuario
        );

        return $this->planRepository->actualizar(
            $plan,
            [
                'estado' => $activo
                    ? EstadoPlan::ACTIVO->value
                    : EstadoPlan::INACTIVO->value,
            ]
        );
    }

    /**
     * Obtener la entidad activa del usuario.
     */
    private function obtenerEntidadActiva(
        User $usuario
    ): Entidad {
        if (!$usuario->entidad_id) {
            throw new DomainException(
                'El usuario no tiene una entidad institucional asignada.'
            );
        }

        $entidad = $usuario->entidad;

        if (!$entidad) {
            throw new DomainException(
                'La entidad institucional asignada al usuario no existe.'
            );
        }

        if ($entidad->estado !== EstadoEntidad::ACTIVO->value) {
            throw new DomainException(
                'La entidad institucional asignada al usuario se encuentra inactiva.'
            );
        }

        return $entidad;
    }

    /**
     * Obtener el identificador de la entidad activa.
     */
    private function obtenerEntidadId(User $usuario): int
    {
        return (int) $this->obtenerEntidadActiva(
            $usuario
        )->id;
    }

    /**
     * Generar el código institucional del plan.
     */
    private function generarCodigoParaEntidad(
        Entidad $entidad
    ): string {
        $siglas = trim(
            (string) $entidad->siglas
        );

        if ($siglas === '') {
            throw new DomainException(
                'La entidad del usuario no tiene siglas institucionales registradas.'
            );
        }

        $ultimoPlan = $this->planRepository
            ->obtenerUltimoPorEntidad(
                (int) $entidad->id
            );

        $nuevoNumero = 1;

        if ($ultimoPlan) {
            $partes = explode(
                '-',
                $ultimoPlan->codigo
            );

            $ultimoNumero = (int) end($partes);

            $nuevoNumero = $ultimoNumero + 1;
        }

        return 'PEI-' .
            strtoupper($siglas) .
            '-' .
            str_pad(
                (string) $nuevoNumero,
                3,
                '0',
                STR_PAD_LEFT
            );
    }
}