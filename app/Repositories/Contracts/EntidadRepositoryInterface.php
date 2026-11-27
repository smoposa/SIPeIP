<?php

namespace App\Repositories\Contracts;

use App\Models\Entidad;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;

interface EntidadRepositoryInterface
{
    /**
     * Obtener todas las entidades ordenadas por nombre.
     */
    public function obtenerTodasOrdenadas(): Collection;


    /**
     * Obtener las entidades paginadas según el ámbito institucional.
     */
    public function obtenerPaginadas(
        ?int $entidadId,
        string $buscar = '',
        string $estado = '',
        int $porPagina = 7
    ): LengthAwarePaginator;


    /**
     * Obtener una entidad por su ID.
     */
    public function obtenerPorId(int $id): Entidad;


    /**
     * Obtener una entidad como colección.
     */
    public function obtenerColeccionPorId(int $id): Collection;


    /**
     * Contar todas las entidades.
     */
    public function contarTodas(): int;


    /**
     * Contar entidades por estado.
     */
    public function contarPorEstado(string $estado): int;


    /**
     * Contar una entidad por estado.
     */
    public function contarPorEstadoYEntidad(
        string $estado,
        int $entidadId
    ): int;


    /**
     * Crear una entidad.
     */
    public function crear(array $datos): Entidad;


    /**
     * Actualizar una entidad.
     */
    public function actualizar(
        Entidad $entidad,
        array $datos
    ): Entidad;
}
