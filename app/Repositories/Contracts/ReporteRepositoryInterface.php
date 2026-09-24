<?php
namespace App\Repositories\Contracts;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;

interface ReporteRepositoryInterface
{
    public function consulta(string $tipo, int $entidadId, array $filtros): Builder;
    public function proyectos(int $entidadId): Collection;
}
