<?php

namespace App\Services;

use App\Enums\EstadoPlan;
use App\Enums\EstadoProcesoPlan;
use App\Models\Plan;
use App\Models\User;
use App\Repositories\Contracts\PlanRepositoryInterface;
use DomainException;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;

class PlanService
{
    public function __construct(
        private readonly PlanRepositoryInterface $planRepository
    ) {
    }

    /**
     * Obtener resumen de planes accesibles
     * para el usuario autenticado.
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
     * Listar planes accesibles para
     * el usuario autenticado.
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
     * Obtener un plan asegurando que
     * pertenezca a la entidad del usuario.
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
     * Generar el siguiente código automático
     * para el Plan Estratégico Institucional.
     */
    public function generarCodigo(User $usuario): string
    {
        $entidadId = $this->obtenerEntidadId($usuario);

        $siglas = $this->obtenerSiglasEntidad($usuario);

        $ultimoPlan = $this->planRepository
            ->obtenerUltimoPorEntidad($entidadId);

        $nuevoNumero = 1;

        if ($ultimoPlan) {
            $partes = explode('-', $ultimoPlan->codigo);

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

    /**
     * Crear un nuevo Plan Estratégico Institucional.
     */
    public function crear(
        array $datos,
        User $usuario
    ): Plan {
        $entidadId = $this->obtenerEntidadId($usuario);

        $datos['codigo'] =
            $this->generarCodigo($usuario);

        $datos['entidad_id'] =
            $entidadId;

        $datos['usuario_id'] =
            $usuario->id;

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
     * Actualizar un plan asegurando primero
     * que pertenezca a la entidad del usuario.
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
     * Cambiar el estado administrativo
     * Activo / Inactivo.
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
     * Obtener el identificador de la entidad
     * asociada al usuario.
     */
    private function obtenerEntidadId(User $usuario): int
    {
        if (!$usuario->entidad_id) {
            throw new DomainException(
                'El usuario no tiene una entidad institucional asignada.'
            );
        }

        return (int) $usuario->entidad_id;
    }

    /**
     * Obtener las siglas institucionales
     * necesarias para generar el código del plan.
     */
    private function obtenerSiglasEntidad(User $usuario): string
    {
        $siglas = $usuario->entidad?->siglas;

        if (!$siglas) {
            throw new DomainException(
                'La entidad del usuario no tiene siglas institucionales registradas.'
            );
        }

        return trim($siglas);
    }
}