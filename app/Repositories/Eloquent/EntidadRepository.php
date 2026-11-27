<?php

namespace App\Repositories\Eloquent;

use App\Models\Entidad;
use App\Repositories\Contracts\EntidadRepositoryInterface;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;

class EntidadRepository implements EntidadRepositoryInterface
{
    public function obtenerTodasOrdenadas(): Collection
    {
        return Entidad::query()->orderBy('nombre')->get();
    }

    public function obtenerPaginadas(
        ?int $entidadId,
        string $buscar = '',
        string $estado = '',
        int $porPagina = 7
    ): LengthAwarePaginator {
        return Entidad::query()
            ->when($entidadId !== null, fn ($query) => $query->where('id', $entidadId))
            ->when($buscar !== '', function ($query) use ($buscar) {
                $query->where(function ($query) use ($buscar) {
                    $query->where('nombre', 'like', "%{$buscar}%")
                        ->orWhere('codigoInstitucional', 'like', "%{$buscar}%")
                        ->orWhere('siglas', 'like', "%{$buscar}%")
                        ->orWhere('tipoEntidad', 'like', "%{$buscar}%")
                        ->orWhere('provincia', 'like', "%{$buscar}%");
                });
            })
            ->when($estado !== '', fn ($query) => $query->where('estado', $estado))
            ->orderBy('nombre')->orderBy('id')->paginate($porPagina)->withQueryString();
    }

    public function obtenerPorId(int $id): Entidad
    {
        return Entidad::query()->findOrFail($id);
    }

    public function obtenerColeccionPorId(int $id): Collection
    {
        return Entidad::query()->where('id', $id)->orderBy('nombre')->get();
    }

    public function contarTodas(): int
    {
        return Entidad::query()->count();
    }

    public function contarPorEstado(string $estado): int
    {
        return Entidad::query()->where('estado', $estado)->count();
    }

    public function contarPorEstadoYEntidad(string $estado, int $entidadId): int
    {
        return Entidad::query()->where('id', $entidadId)->where('estado', $estado)->count();
    }

    public function crear(array $datos): Entidad
    {
        return Entidad::create($datos);
    }

    public function actualizar(Entidad $entidad, array $datos): Entidad
    {
        $entidad->update($datos);
        return $entidad->refresh();
    }
}
