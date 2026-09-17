<?php

namespace App\Repositories\Contracts;

use App\Models\Indicador;
use App\Models\Meta;
use App\Models\User;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Illuminate\Database\Eloquent\Collection;

interface IndicadorRepositoryInterface
{
    public function contarPorEntidad(
        int $entidadId
    ): int;

    public function contarPorEstadoYEntidad(
        string $estado,
        int $entidadId
    ): int;

    public function listarPorEntidad(
        int $entidadId,
        int $porPagina = 15
    ): LengthAwarePaginator;

    public function obtenerUltimo(): ?Indicador;

    public function buscarPorIdYEntidad(
        int $id,
        int $entidadId
    ): Indicador;

    public function obtenerPlanesActivosPorEntidad(
        int $entidadId
    ): Collection;

    public function obtenerObjetivosActivosPorEntidad(
        int $entidadId
    ): Collection;

    public function obtenerMetasActivasPorEntidad(
        int $entidadId
    ): Collection;

    public function buscarMetaActivaPorIdYEntidad(
        int $metaId,
        int $entidadId
    ): ?Meta;

    public function obtenerResponsablesActivosPorEntidad(
        int $entidadId
    ): Collection;

    public function buscarResponsableActivoPorIdYEntidad(
        int $responsableId,
        int $entidadId
    ): ?User;

    public function crear(
        array $datos
    ): Indicador;

    public function actualizar(
        Indicador $indicador,
        array $datos
    ): Indicador;
}
