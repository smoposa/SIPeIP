<?php

namespace App\Repositories\Contracts;

use App\Models\Programa;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Illuminate\Support\Collection;

interface ProgramaRepositoryInterface
{
    /**
     * Contar todos los programas pertenecientes a una entidad.
     */
    public function contarPorEntidad(
        int $entidadId
    ): int;

    /**
     * Contar programas activos pertenecientes a una entidad.
     */
    public function contarActivosPorEntidad(
        int $entidadId
    ): int;

    /**
     * Contar programas inactivos pertenecientes a una entidad.
     */
    public function contarInactivosPorEntidad(
        int $entidadId
    ): int;

    /**
     * Obtener el último programa registrado por una entidad.
     */
    public function obtenerUltimoPorEntidad(
        int $entidadId
    ): ?Programa;

    /**
     * Listar los programas pertenecientes a una entidad.
     */
    public function listarPorEntidad(
        int $entidadId,
        int $porPagina = 10
    ): LengthAwarePaginator;

    /**
     * Buscar un programa por ID asegurando
     * que pertenezca a la entidad indicada.
     */
    public function buscarPorIdYEntidad(
        int $id,
        int $entidadId
    ): Programa;

    /**
     * Obtener los responsables activos
     * disponibles para una entidad.
     */
    public function obtenerResponsablesActivosPorEntidad(
        int $entidadId
    ): Collection;

    /**
     * Obtener los objetivos estratégicos activos
     * pertenecientes a una entidad.
     */
    public function obtenerObjetivosActivosPorEntidad(
        int $entidadId
    ): Collection;

    /**
     * Crear un programa.
     */
    public function crear(
        array $datos
    ): Programa;

    /**
     * Actualizar un programa.
     */
    public function actualizar(
        Programa $programa,
        array $datos
    ): Programa;

    /**
     * Sincronizar los objetivos estratégicos
     * asociados con un programa.
     */
    public function sincronizarObjetivos(
        Programa $programa,
        array $objetivos
    ): void;
}