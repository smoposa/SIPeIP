<?php

namespace App\Services;

use App\Enums\EstadoEntidad;
use App\Enums\EstadoIndicador;
use App\Models\Entidad;
use App\Models\Indicador;
use App\Models\Meta;
use App\Models\User;
use App\Repositories\Contracts\IndicadorRepositoryInterface;
use DomainException;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;

class IndicadorService
{
    public function __construct(
        private readonly IndicadorRepositoryInterface $indicadorRepository
    ) {
    }

    /**
     * Listar indicadores pertenecientes a la entidad.
     */
    public function listar(
        User $usuario,
        int $porPagina = 15
    ): LengthAwarePaginator {
        return $this->indicadorRepository
            ->listarPorEntidad(
                $this->obtenerEntidadId($usuario),
                $porPagina
            );
    }

    /**
     * Obtener el resumen de indicadores.
     */
    public function obtenerResumen(
        User $usuario
    ): array {
        $entidadId = $this->obtenerEntidadId(
            $usuario
        );

        return [
            'totalIndicadores' =>
                $this->indicadorRepository
                    ->contarPorEntidad(
                        $entidadId
                    ),

            'indicadoresActivos' =>
                $this->indicadorRepository
                    ->contarPorEstadoYEntidad(
                        EstadoIndicador::ACTIVO->value,
                        $entidadId
                    ),

            'indicadoresInactivos' =>
                $this->indicadorRepository
                    ->contarPorEstadoYEntidad(
                        EstadoIndicador::INACTIVO->value,
                        $entidadId
                    ),
        ];
    }

    /**
     * Obtener datos para crear un indicador.
     */
    public function obtenerDatosCreacion(
        User $usuario,
        ?int $metaId = null
    ): array {
        $entidadId = $this->obtenerEntidadId(
            $usuario
        );

        $planes = $this->indicadorRepository
            ->obtenerPlanesActivosPorEntidad(
                $entidadId
            );

        $objetivos = $this->indicadorRepository
            ->obtenerObjetivosActivosPorEntidad(
                $entidadId
            );

        $metas = $this->indicadorRepository
            ->obtenerMetasActivasPorEntidad(
                $entidadId
            );

        $metaSeleccionada = null;

        if ($metaId) {
            $metaSeleccionada =
                $this->obtenerMetaAccesible(
                    $metaId,
                    $entidadId
                );
        }

        return [
            'codigo' => $this->generarCodigo(),

            'planes' => $planes,

            'objetivos' => $objetivos,

            'metas' => $metas,

            'responsables' => $this->indicadorRepository
                ->obtenerResponsablesActivosPorEntidad(
                    $entidadId
                ),

            'metaSeleccionada' =>
                $metaSeleccionada,

            'objetivoSeleccionado' =>
                $metaSeleccionada?->objetivo,

            'planSeleccionado' =>
                $metaSeleccionada?->objetivo?->plan,
        ];
    }

    /**
     * Obtener datos para editar un indicador.
     */
    public function obtenerDatosEdicion(
        int $id,
        User $usuario
    ): array {
        $entidadId = $this->obtenerEntidadId(
            $usuario
        );

        $indicador = $this->indicadorRepository
            ->buscarPorIdYEntidad(
                $id,
                $entidadId
            );

        $planes = $this->indicadorRepository
            ->obtenerPlanesActivosPorEntidad(
                $entidadId
            );

        $objetivos = $this->indicadorRepository
            ->obtenerObjetivosActivosPorEntidad(
                $entidadId
            );

        $metas = $this->indicadorRepository
            ->obtenerMetasActivasPorEntidad(
                $entidadId
            );

        return [
            'indicador' => $indicador,

            'planes' => $planes,

            'objetivos' => $objetivos,

            'metas' => $metas,

            'responsables' => $this->indicadorRepository
                ->obtenerResponsablesActivosPorEntidad(
                    $entidadId
                ),

            'metaSeleccionada' =>
                $indicador->meta,

            'objetivoSeleccionado' =>
                $indicador->meta?->objetivo,

            'planSeleccionado' =>
                $indicador->meta?->objetivo?->plan,
        ];
    }

    /**
     * Obtener un indicador perteneciente a la entidad.
     */
    public function obtenerAccesible(
        int $id,
        User $usuario
    ): Indicador {
        return $this->indicadorRepository
            ->buscarPorIdYEntidad(
                $id,
                $this->obtenerEntidadId($usuario)
            );
    }

    /**
     * Crear un indicador institucional.
     */
    public function crear(
        array $datos,
        User $usuario
    ): Indicador {
        $entidadId = $this->obtenerEntidadId(
            $usuario
        );

        $planId = (int) $datos['plan_id'];
        $objetivoId = (int) $datos['objetivo_id'];

        $meta = $this->obtenerMetaAccesible(
            (int) $datos['meta_id'],
            $entidadId
        );

        $this->validarJerarquiaPlanificacion(
            $meta,
            $objetivoId,
            $planId
        );

        $responsable =
            $this->obtenerResponsableAccesible(
                (int) $datos['responsable_id'],
                $entidadId
            );

        /*
         * plan_id y objetivo_id sirven para validar
         * el contexto, pero no pertenecen a indicadores.
         */
        unset(
            $datos['plan_id'],
            $datos['objetivo_id']
        );

        $datos['meta_id'] = $meta->id;
        $datos['responsable_id'] = $responsable->id;
        $datos['codigo'] = $this->generarCodigo();
        $datos['estado'] = EstadoIndicador::ACTIVO->value;
        $datos['usuario_id'] = $usuario->id;

        return $this->indicadorRepository->crear(
            $datos
        );
    }

    /**
     * Actualizar un indicador institucional.
     */
    public function actualizar(
        int $id,
        array $datos,
        User $usuario
    ): Indicador {
        $entidadId = $this->obtenerEntidadId(
            $usuario
        );

        $indicador = $this->indicadorRepository
            ->buscarPorIdYEntidad(
                $id,
                $entidadId
            );

        $planId = (int) $datos['plan_id'];
        $objetivoId = (int) $datos['objetivo_id'];

        $meta = $this->obtenerMetaAccesible(
            (int) $datos['meta_id'],
            $entidadId
        );

        $this->validarJerarquiaPlanificacion(
            $meta,
            $objetivoId,
            $planId
        );

        $responsable =
            $this->obtenerResponsableAccesible(
                (int) $datos['responsable_id'],
                $entidadId
            );

        /*
         * Estos campos no pertenecen a la tabla indicadores.
         */
        unset(
            $datos['plan_id'],
            $datos['objetivo_id']
        );

        $datos['meta_id'] = $meta->id;
        $datos['responsable_id'] = $responsable->id;

        return $this->indicadorRepository->actualizar(
            $indicador,
            $datos
        );
    }

    /**
     * Cambiar el estado administrativo.
     */
    public function cambiarEstado(
        int $id,
        bool $activo,
        User $usuario
    ): Indicador {
        $indicador = $this->obtenerAccesible(
            $id,
            $usuario
        );

        return $this->indicadorRepository->actualizar(
            $indicador,
            [
                'estado' => $activo
                    ? EstadoIndicador::ACTIVO->value
                    : EstadoIndicador::INACTIVO->value,
            ]
        );
    }

    /**
     * Generar el siguiente código de indicador.
     */
    private function generarCodigo(): string
    {
        $ultimoIndicador = $this->indicadorRepository
            ->obtenerUltimo();

        $nuevoNumero = 1;

        if ($ultimoIndicador) {
            $partes = explode(
                '-',
                $ultimoIndicador->codigo
            );

            $ultimoNumero = (int) end($partes);

            $nuevoNumero = $ultimoNumero + 1;
        }

        return 'IND-' .
            str_pad(
                (string) $nuevoNumero,
                2,
                '0',
                STR_PAD_LEFT
            );
    }

    /**
     * Obtener la entidad institucional activa.
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

        if (
            $entidad->estado !==
            EstadoEntidad::ACTIVO->value
        ) {
            throw new DomainException(
                'La entidad institucional asignada al usuario se encuentra inactiva.'
            );
        }

        return $entidad;
    }

    /**
     * Obtener el identificador de la entidad.
     */
    private function obtenerEntidadId(
        User $usuario
    ): int {
        return (int) $this->obtenerEntidadActiva(
            $usuario
        )->id;
    }

    /**
     * Obtener una meta activa perteneciente
     * a la entidad del usuario.
     */
    private function obtenerMetaAccesible(
        int $metaId,
        int $entidadId
    ): Meta {
        $meta = $this->indicadorRepository
            ->buscarMetaActivaPorIdYEntidad(
                $metaId,
                $entidadId
            );

        if (!$meta) {
            throw new DomainException(
                'La meta seleccionada no pertenece a la entidad del usuario o se encuentra inactiva.'
            );
        }

        return $meta;
    }

    /**
     * Validar la relación Plan → Objetivo → Meta.
     */
    private function validarJerarquiaPlanificacion(
        Meta $meta,
        int $objetivoId,
        int $planId
    ): void {
        if (
            (int) $meta->objetivo_id !== $objetivoId ||
            (int) $meta->objetivo?->plan_id !== $planId
        ) {
            throw new DomainException(
                'La meta seleccionada no pertenece al objetivo y plan institucional indicados.'
            );
        }
    }

    /**
     * Obtener un responsable activo perteneciente
     * a la entidad del usuario.
     */
    private function obtenerResponsableAccesible(
        int $responsableId,
        int $entidadId
    ): User {
        $responsable = $this->indicadorRepository
            ->buscarResponsableActivoPorIdYEntidad(
                $responsableId,
                $entidadId
            );

        if (!$responsable) {
            throw new DomainException(
                'El responsable seleccionado no pertenece a la entidad del usuario o se encuentra inactivo.'
            );
        }

        return $responsable;
    }
}