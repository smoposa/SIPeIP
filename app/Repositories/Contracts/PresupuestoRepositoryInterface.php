<?php

namespace App\Repositories\Contracts;

use App\Models\Presupuesto;
use App\Models\Proyecto;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Illuminate\Database\Eloquent\Collection;

interface PresupuestoRepositoryInterface
{
    // Listar los presupuestos de una entidad.
    public function listarPorEntidad(
        int $entidadId,
        int $porPagina = 10
    ): LengthAwarePaginator;

    // Obtener un presupuesto perteneciente a la entidad.
    public function buscarPorIdYEntidad(
        int $id,
        int $entidadId
    ): Presupuesto;

    // Obtener y bloquear un presupuesto de la entidad dentro de una transacción.
    public function buscarPorIdYEntidadParaActualizar(
        int $id,
        int $entidadId
    ): Presupuesto;

    // Obtener un proyecto perteneciente a la entidad.
    public function buscarProyectoPorEntidad(
        int $id,
        int $entidadId
    ): Proyecto;

    // Obtener los proyectos activos de la entidad.
    public function obtenerProyectosActivosPorEntidad(
        int $entidadId
    ): Collection;

    // Registrar un presupuesto.
    public function crear(array $datos): Presupuesto;

    // Actualizar un presupuesto.
    public function actualizar(
        Presupuesto $presupuesto,
        array $datos
    ): Presupuesto;
}