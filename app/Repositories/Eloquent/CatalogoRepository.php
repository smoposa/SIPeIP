<?php

namespace App\Repositories\Eloquent;

use App\Repositories\Contracts\CatalogoRepositoryInterface;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class CatalogoRepository implements CatalogoRepositoryInterface
{
    public function listar(array $definicion): LengthAwarePaginator
    {
        return $definicion['modelo']::query()->orderBy('id')->paginate(15);
    }

    public function opciones(array $definicion): Collection
    {
        return $definicion['modelo']::query()->orderBy('id')->get();
    }

    public function buscar(array $definicion, int $id, bool $bloquear = false): Model
    {
        $query = $definicion['modelo']::query()->with($definicion['relaciones'] ?? []);
        if ($bloquear) {
            $query->lockForUpdate();
        }

        return $query->findOrFail($id);
    }

    public function guardar(array $definicion, array $datos, ?Model $registro = null): Model
    {
        $modelo = $definicion['modelo'];
        $registro ??= new $modelo;
        $registro->fill($datos);
        $registro->save();

        return $registro;
    }

    public function tieneDependencias(array $definicion, int $id): bool
    {
        foreach ($definicion['dependencias'] as [$tabla, $campo]) {
            if (DB::table($tabla)->where($campo, $id)->exists()) {
                return true;
            }
        }

        return false;
    }

}
