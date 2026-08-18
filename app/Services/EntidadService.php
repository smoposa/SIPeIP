<?php

namespace App\Services;

use App\Enums\EstadoEntidad;
use App\Models\Entidad;
use App\Models\User;
use App\Repositories\Contracts\EntidadRepositoryInterface;

class EntidadService
{
    public function __construct(
        private readonly EntidadRepositoryInterface $entidadRepository
    ) {
    }


    /**
     * Obtener los datos generales del módulo de entidades
     * según el ámbito institucional.
     */
    public function obtenerResumen(User $usuarioAutenticado): array
    {
        /*
         * Administrador Global:
         * puede consultar todas las entidades.
         */
        if ($this->esAdministradorGlobal($usuarioAutenticado)) {

            return [
                'totalEntidades' => $this->entidadRepository->contarTodas(),

                'entidadesActivas' => $this->entidadRepository->contarPorEstado(
                    EstadoEntidad::ACTIVO->value
                ),

                'entidadesInactivas' => $this->entidadRepository->contarPorEstado(
                    EstadoEntidad::INACTIVO->value
                ),

                'entidades' => $this->entidadRepository->obtenerTodasOrdenadas(),
            ];
        }


        /*
         * Usuario institucional:
         * solamente puede consultar su propia entidad.
         */
        $entidadId = $usuarioAutenticado->entidad_id;

        return [
            'totalEntidades' => 1,

            'entidadesActivas' => $this->entidadRepository->contarPorEstadoYEntidad(
                EstadoEntidad::ACTIVO->value,
                $entidadId
            ),

            'entidadesInactivas' => $this->entidadRepository->contarPorEstadoYEntidad(
                EstadoEntidad::INACTIVO->value,
                $entidadId
            ),

            'entidades' => $this->entidadRepository->obtenerColeccionPorId(
                $entidadId
            ),
        ];
    }


    /**
     * Obtener una entidad por su ID
     * según el ámbito institucional.
     */
    public function obtenerPorId(
        int $id,
        User $usuarioAutenticado
    ): Entidad {

        $entidad = $this->entidadRepository->obtenerPorId($id);

        // El Administrador Global puede acceder a cualquier entidad.
        if ($this->esAdministradorGlobal($usuarioAutenticado)) {
            return $entidad;
        }

        // Los demás usuarios solo pueden acceder
        // a la entidad a la que pertenecen.
        if ($entidad->id !== $usuarioAutenticado->entidad_id) {
            abort(
                403,
                'No tiene autorización para acceder a esta entidad.'
            );
        }

        return $entidad;
    }


    /**
     * Crear una entidad.
     */
    public function crear(array $datos): Entidad
    {
        return $this->entidadRepository->crear([
            ...$datos,
            'estado' => EstadoEntidad::ACTIVO->value,
        ]);
    }


    /**
     * Actualizar una entidad.
     */
    public function actualizar(
        Entidad $entidad,
        array $datos
    ): Entidad {
        return $this->entidadRepository->actualizar(
            $entidad,
            $datos
        );
    }


    /**
     * Actualizar el estado de una entidad.
     */
    public function actualizarEstado(
        Entidad $entidad,
        bool $activo
    ): Entidad {
        return $this->entidadRepository->actualizar(
            $entidad,
            [
                'estado' => $activo
                    ? EstadoEntidad::ACTIVO->value
                    : EstadoEntidad::INACTIVO->value,
            ]
        );
    }


    /**
     * Determinar si el usuario es Administrador Global.
     */
    private function esAdministradorGlobal(User $usuario): bool
    {
        return $usuario->rol?->codigo === 'ADMIN_GLOBAL';
    }
}