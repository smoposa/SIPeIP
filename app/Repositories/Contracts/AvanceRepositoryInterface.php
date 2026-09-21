<?php

namespace App\Repositories\Contracts;

use App\Models\Avance;
use App\Models\Proyecto;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Illuminate\Database\Eloquent\Collection;

interface AvanceRepositoryInterface
{
    public function listarPorEntidad(int $entidadId, int $porPagina = 10): LengthAwarePaginator;
    public function buscarPorIdYEntidad(int $id, int $entidadId): Avance;
    public function buscarProyectoPorEntidad(int $id, int $entidadId): Proyecto;
    public function obtenerProyectosActivosPorEntidad(int $entidadId): Collection;
    public function obtenerIndicadoresDelProyecto(Proyecto $proyecto): Collection;
    public function indicadorPerteneceAlProyecto(int $indicadorId, Proyecto $proyecto): bool;
    public function crear(array $datos): Avance;
    public function actualizar(Avance $avance, array $datos): Avance;
}
