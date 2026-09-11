<?php

namespace App\Repositories\Contracts;

use App\Models\Plan;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;

interface PlanRepositoryInterface
{
    /**
     * Contar todos los planes pertenecientes a una entidad.
     */
    public function contarPorEntidad(int $entidadId): int;

    /**
     * Contar planes activos pertenecientes a una entidad.
     */
    public function contarActivosPorEntidad(int $entidadId): int;

    /**
     * Contar planes inactivos pertenecientes a una entidad.
     */
    public function contarInactivosPorEntidad(int $entidadId): int;

    /**
     * Obtener el último plan registrado por una entidad.
     */
    public function obtenerUltimoPorEntidad(int $entidadId): ?Plan;

    /**
     * Listar los planes pertenecientes a una entidad.
     */
    public function listarPorEntidad(
        int $entidadId,
        int $porPagina = 10
    ): LengthAwarePaginator;

    /**
     * Buscar un plan por ID asegurando
     * que pertenezca a la entidad indicada.
     */
    public function buscarPorIdYEntidad(
        int $id,
        int $entidadId
    ): Plan;

    /**
     * Crear un nuevo plan institucional.
     */
    public function crear(array $datos): Plan;

    /**
     * Actualizar un plan institucional.
     */
    public function actualizar(
        Plan $plan,
        array $datos
    ): Plan;

    /**
     * Eliminar un plan institucional.
     */
    public function eliminar(Plan $plan): void;
}