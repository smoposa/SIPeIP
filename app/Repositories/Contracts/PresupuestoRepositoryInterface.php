<?php

namespace App\Repositories\Contracts;

use App\Models\Presupuesto;
use App\Models\Proyecto;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Illuminate\Database\Eloquent\Collection;

interface PresupuestoRepositoryInterface
{
    public function listarPorEntidad(int $entidadId, int $porPagina = 10): LengthAwarePaginator;
    public function buscarPorIdYEntidad(int $id, int $entidadId): Presupuesto;
    public function buscarProyectoPorEntidad(int $id, int $entidadId): Proyecto;
    public function obtenerProyectosActivosPorEntidad(int $entidadId): Collection;
    public function crear(array $datos): Presupuesto;
    public function actualizar(Presupuesto $presupuesto, array $datos): Presupuesto;
}
