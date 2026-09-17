<?php

namespace App\Services;

use App\Enums\EstadoEntidad;
use App\Enums\EstadoObjetivo;
use App\Models\Entidad;
use App\Models\Objetivo;
use App\Models\Plan;
use App\Models\User;
use App\Repositories\Contracts\ObjetivoRepositoryInterface;
use DomainException;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Illuminate\Database\Eloquent\Collection;

class ObjetivoService
{
    public function __construct(
        private readonly ObjetivoRepositoryInterface $objetivoRepository
    ) {
    }

    /**
     * Listar objetivos de la entidad.
     */
    public function listar(
        User $usuario,
        int $porPagina = 10
    ): LengthAwarePaginator {
        return $this->objetivoRepository
            ->listarPorEntidad(
                $this->obtenerEntidadId($usuario),
                $porPagina
            );
    }

    /**
     * Obtener los datos necesarios
     * para crear un objetivo.
     */
    public function obtenerDatosCreacion(
        User $usuario,
        ?int $planId = null
    ): array {
        $entidadId = $this->obtenerEntidadId($usuario);

        $planSeleccionado = null;

        if ($planId) {
            $planSeleccionado = $this->objetivoRepository
                ->buscarPlanActivoPorIdYEntidad(
                    $planId,
                    $entidadId
                );
        }

        return [
            'codigo' => $this->generarCodigo(),

            'planSeleccionado' => $planSeleccionado,

            'planes' => $this->objetivoRepository
                ->obtenerPlanesActivosPorEntidad($entidadId),

            'pnd' => $this->objetivoRepository
                ->obtenerPndActivos(),

            'ods' => $this->objetivoRepository
                ->obtenerOdsActivos(),
        ];
    }

    /**
     * Obtener los datos necesarios
     * para editar un objetivo.
     */
    public function obtenerDatosEdicion(
        int $id,
        User $usuario
    ): array {
        $entidadId = $this->obtenerEntidadId($usuario);

        return [
            'objetivo' => $this->objetivoRepository
                ->buscarPorIdYEntidad(
                    $id,
                    $entidadId
                ),

            'planes' => $this->objetivoRepository
                ->obtenerPlanesActivosPorEntidad(
                    $entidadId
                ),

            'pnd' => $this->objetivoRepository
                ->obtenerPndActivos(),

            'ods' => $this->objetivoRepository
                ->obtenerOdsActivos(),
        ];
    }

    /**
     * Obtener un objetivo perteneciente
     * a la entidad del usuario.
     */
    public function obtenerAccesible(
        int $id,
        User $usuario
    ): Objetivo {
        return $this->objetivoRepository
            ->buscarPorIdYEntidad(
                $id,
                $this->obtenerEntidadId($usuario)
            );
    }

    /**
     * Crear un objetivo institucional.
     */
    public function crear(
        array $datos,
        User $usuario
    ): Objetivo {
        $entidadId = $this->obtenerEntidadId($usuario);

        $plan = $this->obtenerPlanAccesible(
            (int) $datos['plan_id'],
            $entidadId
        );

        $datos['plan_id'] = $plan->id;
        $datos['codigo'] = $this->generarCodigo();
        $datos['estado'] = EstadoObjetivo::ACTIVO->value;
        $datos['usuario_id'] = $usuario->id;

        return $this->objetivoRepository->crear(
            $datos
        );
    }

    /**
     * Actualizar un objetivo institucional.
     */
    public function actualizar(
        int $id,
        array $datos,
        User $usuario
    ): Objetivo {
        $entidadId = $this->obtenerEntidadId($usuario);

        $objetivo = $this->objetivoRepository
            ->buscarPorIdYEntidad(
                $id,
                $entidadId
            );

        $plan = $this->obtenerPlanAccesible(
            (int) $datos['plan_id'],
            $entidadId
        );

        $datos['plan_id'] = $plan->id;

        return $this->objetivoRepository->actualizar(
            $objetivo,
            $datos
        );
    }

    /**
     * Cambiar el estado del objetivo.
     */
    public function cambiarEstado(
        int $id,
        bool $activo,
        User $usuario
    ): Objetivo {
        $objetivo = $this->obtenerAccesible(
            $id,
            $usuario
        );

        return $this->objetivoRepository->actualizar(
            $objetivo,
            [
                'estado' => $activo
                    ? EstadoObjetivo::ACTIVO->value
                    : EstadoObjetivo::INACTIVO->value,
            ]
        );
    }

    /**
     * Obtener políticas activas de un objetivo PND.
     */
    public function obtenerPoliticas(
        int $pndId
    ): Collection {
        return $this->objetivoRepository
            ->obtenerPoliticasActivasPorPnd(
                $pndId
            );
    }

    /**
     * Obtener metas activas de un ODS.
     */
    public function obtenerMetasOds(
        int $odsId
    ): Collection {
        return $this->objetivoRepository
            ->obtenerMetasActivasPorOds(
                $odsId
            );
    }

    /**
     * Generar el siguiente código OEI.
     */
    private function generarCodigo(): string
    {
        $ultimoObjetivo = $this->objetivoRepository
            ->obtenerUltimo();

        $nuevoNumero = 1;

        if ($ultimoObjetivo) {
            $partes = explode(
                '-',
                $ultimoObjetivo->codigo
            );

            $ultimoNumero = (int) end($partes);

            $nuevoNumero = $ultimoNumero + 1;
        }

        return 'OEI-' .
            str_pad(
                (string) $nuevoNumero,
                2,
                '0',
                STR_PAD_LEFT
            );
    }

    /**
     * Obtener una entidad activa.
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
     * Obtener el ID de la entidad activa.
     */
    private function obtenerEntidadId(
        User $usuario
    ): int {
        return (int) $this->obtenerEntidadActiva(
            $usuario
        )->id;
    }

    /**
     * Validar que el plan seleccionado
     * pertenezca a la entidad.
     */
    private function obtenerPlanAccesible(
        int $planId,
        int $entidadId
    ): Plan {
        $plan = $this->objetivoRepository
            ->buscarPlanActivoPorIdYEntidad(
                $planId,
                $entidadId
            );

        if (!$plan) {
            throw new DomainException(
                'El plan seleccionado no pertenece a la entidad del usuario o se encuentra inactivo.'
            );
        }

        return $plan;
    }
}