<?php

namespace App\Repositories\Contracts;

use App\Models\Meta;
use App\Models\Objetivo;
use App\Models\User;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Illuminate\Database\Eloquent\Collection;

interface MetaRepositoryInterface
{
    public function listarPorEntidad(
        int $entidadId,
        int $porPagina = 15
    ): LengthAwarePaginator;

    public function obtenerUltima(): ?Meta;

    public function buscarPorIdYEntidad(
        int $id,
        int $entidadId
    ): Meta;

    public function obtenerObjetivosActivosPorEntidad(
        int $entidadId
    ): Collection;

    public function buscarObjetivoActivoPorIdYEntidad(
        int $objetivoId,
        int $entidadId
    ): ?Objetivo;

    public function obtenerResponsablesActivosPorEntidad(
        int $entidadId
    ): Collection;

    public function buscarResponsableActivoPorIdYEntidad(
        int $responsableId,
        int $entidadId
    ): ?User;

    public function crear(array $datos): Meta;

    public function actualizar(
        Meta $meta,
        array $datos
    ): Meta;
}
