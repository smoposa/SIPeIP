<?php

namespace App\Services;

use App\Enums\EstadoEntidad;
use App\Models\Entidad;
use App\Repositories\Contracts\EntidadRepositoryInterface;

class EntidadService
{
    public function __construct(
        private readonly EntidadRepositoryInterface $entidadRepository
    ) {
    }

    /**
     * Obtener los datos generales del módulo de entidades.
     */
    public function obtenerResumen(): array
    {
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

    /**
     * Obtener una entidad por su ID.
     */
    public function obtenerPorId(int $id): Entidad
    {
        return $this->entidadRepository->obtenerPorId($id);
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
    public function actualizar(Entidad $entidad, array $datos): Entidad
    {
        return $this->entidadRepository->actualizar($entidad, $datos);
    }

    /**
     * Actualizar el estado de una entidad.
     */
    public function actualizarEstado(Entidad $entidad, bool $activo): Entidad
    {
        return $this->entidadRepository->actualizar($entidad, [
            'estado' => $activo
                ? EstadoEntidad::ACTIVO->value
                : EstadoEntidad::INACTIVO->value,
        ]);
    }
}