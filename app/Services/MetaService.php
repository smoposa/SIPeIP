<?php

namespace App\Services;

use App\Enums\EstadoEntidad;
use App\Enums\EstadoMeta;
use App\Models\Entidad;
use App\Models\Meta;
use App\Models\Objetivo;
use App\Models\User;
use App\Repositories\Contracts\MetaRepositoryInterface;
use DomainException;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;

class MetaService
{
    public function __construct(
        private readonly MetaRepositoryInterface $metaRepository
    ) {
    }

    /**
     * Listar metas pertenecientes a la entidad.
     */
    public function listar(
        User $usuario,
        int $porPagina = 15
    ): LengthAwarePaginator {
        return $this->metaRepository
            ->listarPorEntidad(
                $this->obtenerEntidadId($usuario),
                $porPagina
            );
    }

        /**
     * Obtener el resumen de metas de la entidad.
     */
    public function obtenerResumen(
        User $usuario
    ): array {
        $entidadId = $this->obtenerEntidadId(
            $usuario
        );

        return [
            'totalMetas' => $this->metaRepository
                ->contarPorEntidad(
                    $entidadId
                ),

            'metasActivas' => $this->metaRepository
                ->contarPorEstadoYEntidad(
                    EstadoMeta::ACTIVO->value,
                    $entidadId
                ),

            'metasInactivas' => $this->metaRepository
                ->contarPorEstadoYEntidad(
                    EstadoMeta::INACTIVO->value,
                    $entidadId
                ),
        ];
    }

    /**
     * Obtener los datos necesarios para crear una meta.
     */
    public function obtenerDatosCreacion(
        User $usuario,
        ?int $objetivoId = null
    ): array {
        $entidadId = $this->obtenerEntidadId(
            $usuario
        );

        $objetivoSeleccionado = null;

        if ($objetivoId) {
            $objetivoSeleccionado =
                $this->obtenerObjetivoAccesible(
                    $objetivoId,
                    $entidadId
                );
        }

        return [
            'codigo' => $this->generarCodigo(),

            'objetivos' => $this->metaRepository
                ->obtenerObjetivosActivosPorEntidad(
                    $entidadId
                ),

            'responsables' => $this->metaRepository
                ->obtenerResponsablesActivosPorEntidad(
                    $entidadId
                ),

            'objetivoSeleccionado' =>
                $objetivoSeleccionado,

            'planSeleccionado' =>
                $objetivoSeleccionado?->plan,
        ];
    }

    /**
     * Obtener los datos necesarios para editar una meta.
     */
    public function obtenerDatosEdicion(
        int $id,
        User $usuario
    ): array {
        $entidadId = $this->obtenerEntidadId(
            $usuario
        );

        return [
            'meta' => $this->metaRepository
                ->buscarPorIdYEntidad(
                    $id,
                    $entidadId
                ),

            'objetivos' => $this->metaRepository
                ->obtenerObjetivosActivosPorEntidad(
                    $entidadId
                ),

            'responsables' => $this->metaRepository
                ->obtenerResponsablesActivosPorEntidad(
                    $entidadId
                ),
        ];
    }

    /**
     * Obtener una meta perteneciente a la entidad.
     */
    public function obtenerAccesible(
        int $id,
        User $usuario
    ): Meta {
        return $this->metaRepository
            ->buscarPorIdYEntidad(
                $id,
                $this->obtenerEntidadId($usuario)
            );
    }

    /**
     * Crear una meta institucional.
     */
    public function crear(
        array $datos,
        User $usuario
    ): Meta {
        $entidadId = $this->obtenerEntidadId(
            $usuario
        );

        $objetivo = $this->obtenerObjetivoAccesible(
            (int) $datos['objetivo_id'],
            $entidadId
        );

        $responsable =
            $this->obtenerResponsableAccesible(
                (int) $datos['responsable_id'],
                $entidadId
            );

        $datos['objetivo_id'] = $objetivo->id;
        $datos['responsable_id'] = $responsable->id;
        $datos['codigo'] = $this->generarCodigo();
        $datos['estado'] = EstadoMeta::ACTIVO->value;
        $datos['usuario_id'] = $usuario->id;

        return $this->metaRepository->crear(
            $datos
        );
    }

    /**
     * Actualizar una meta institucional.
     */
    public function actualizar(
        int $id,
        array $datos,
        User $usuario
    ): Meta {
        $entidadId = $this->obtenerEntidadId(
            $usuario
        );

        $meta = $this->metaRepository
            ->buscarPorIdYEntidad(
                $id,
                $entidadId
            );

        $objetivo = $this->obtenerObjetivoAccesible(
            (int) $datos['objetivo_id'],
            $entidadId
        );

        $responsable =
            $this->obtenerResponsableAccesible(
                (int) $datos['responsable_id'],
                $entidadId
            );

        $datos['objetivo_id'] = $objetivo->id;
        $datos['responsable_id'] = $responsable->id;

        return $this->metaRepository->actualizar(
            $meta,
            $datos
        );
    }

    /**
     * Cambiar el estado administrativo de una meta.
     */
    public function cambiarEstado(
        int $id,
        bool $activo,
        User $usuario
    ): Meta {
        $meta = $this->obtenerAccesible(
            $id,
            $usuario
        );

        return $this->metaRepository->actualizar(
            $meta,
            [
                'estado' => $activo
                    ? EstadoMeta::ACTIVO->value
                    : EstadoMeta::INACTIVO->value,
            ]
        );
    }

    /**
     * Generar el siguiente código de meta.
     */
    private function generarCodigo(): string
    {
        $ultimaMeta = $this->metaRepository
            ->obtenerUltima();

        $nuevoNumero = 1;

        if ($ultimaMeta) {
            $partes = explode(
                '-',
                $ultimaMeta->codigo
            );

            $ultimoNumero = (int) end($partes);

            $nuevoNumero = $ultimoNumero + 1;
        }

        return 'META-' .
            str_pad(
                (string) $nuevoNumero,
                2,
                '0',
                STR_PAD_LEFT
            );
    }

    /**
     * Obtener una entidad institucional activa.
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
     * Obtener el identificador de la entidad activa.
     */
    private function obtenerEntidadId(
        User $usuario
    ): int {
        return (int) $this->obtenerEntidadActiva(
            $usuario
        )->id;
    }

    /**
     * Validar que el objetivo pertenezca a la entidad.
     */
    private function obtenerObjetivoAccesible(
        int $objetivoId,
        int $entidadId
    ): Objetivo {
        $objetivo = $this->metaRepository
            ->buscarObjetivoActivoPorIdYEntidad(
                $objetivoId,
                $entidadId
            );

        if (!$objetivo) {
            throw new DomainException(
                'El objetivo seleccionado no pertenece a la entidad del usuario o se encuentra inactivo.'
            );
        }

        return $objetivo;
    }

    /**
     * Validar que el responsable pertenezca a la entidad.
     */
    private function obtenerResponsableAccesible(
        int $responsableId,
        int $entidadId
    ): User {
        $responsable = $this->metaRepository
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