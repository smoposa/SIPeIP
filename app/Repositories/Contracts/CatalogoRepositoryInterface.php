<?php

namespace App\Repositories\Contracts;

use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

interface CatalogoRepositoryInterface
{
    public function listar(array $definicion): LengthAwarePaginator;
    public function opciones(array $definicion): Collection;
    public function buscar(array $definicion, int $id, bool $bloquear = false): Model;
    public function guardar(array $definicion, array $datos, ?Model $registro = null): Model;
    public function tieneDependencias(array $definicion, int $id): bool;
}
