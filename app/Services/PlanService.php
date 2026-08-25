<?php

namespace App\Services;

use App\Enums\EstadoPlan;
use App\Models\Plan;
use App\Repositories\Contracts\PlanRepositoryInterface;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;

class PlanService
{
    public function __construct(
        private readonly PlanRepositoryInterface $planRepository
    ) {
    }

    /**
     * Obtener resumen de planes por entidad.
     */
    public function obtenerResumenPorEntidad(int $entidadId): array
    {
        return [
            'totalPlanes' => $this->planRepository->contarPorEntidad($entidadId),
            'planesActivos' => $this->planRepository->contarActivosPorEntidad($entidadId),
            'planesInactivos' => $this->planRepository->contarInactivosPorEntidad($entidadId),
        ];
    }

    /**
     * Listar planes pertenecientes a una entidad.
     */
    public function listarPorEntidad(
        int $entidadId,
        int $porPagina = 10
    ): LengthAwarePaginator {
        return $this->planRepository->listarPorEntidad(
            $entidadId,
            $porPagina
        );
    }

    /**
     * Obtener un plan asegurando que pertenezca a la entidad.
     */
    public function obtenerPorEntidad(
        int $id,
        int $entidadId
    ): Plan {
        return $this->planRepository->buscarPorIdYEntidad(
            $id,
            $entidadId
        );
    }

    /**
     * Generar código automático del plan institucional.
     */
    public function generarCodigo(
        int $entidadId,
        string $siglas
    ): string {
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
     * Crear un nuevo plan institucional.
     */
    public function crear(
        array $datos,
        int $entidadId,
        int $usuarioId,
        string $siglas
    ): Plan {
        $datos['codigo'] = $this->generarCodigo(
            $entidadId,
            $siglas
        );

        $datos['entidad_id'] = $entidadId;
        $datos['usuario_id'] = $usuarioId;

        $datos['tipo'] = 'Plan Estratégico Institucional';

        $datos['estado'] = 'Activo';

        $datos['estado_proceso'] =
            EstadoPlan::BORRADOR->value;

        $datos['version'] = 1;

        return $this->planRepository->crear($datos);
    }

    /**
     * Actualizar información del plan.
     */
    public function actualizar(
        Plan $plan,
        array $datos
    ): Plan {
        return $this->planRepository->actualizar(
            $plan,
            $datos
        );
    }

    /**
     * Cambiar estado administrativo:
     * Activo / Inactivo.
     */
    public function cambiarEstadoAdministrativo(
        Plan $plan,
        bool $activo
    ): Plan {
        return $this->planRepository->actualizar(
            $plan,
            [
                'estado' => $activo
                    ? 'Activo'
                    : 'Inactivo',
            ]
        );
    }

    /**
     * Eliminar un plan.
     */
    public function eliminar(Plan $plan): void
    {
        $this->planRepository->eliminar($plan);
    }
}