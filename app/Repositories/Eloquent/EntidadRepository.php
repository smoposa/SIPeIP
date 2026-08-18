<?php

namespace App\Repositories\Eloquent;

use App\Models\Entidad;
use App\Repositories\Contracts\EntidadRepositoryInterface;
use Illuminate\Database\Eloquent\Collection;

class EntidadRepository implements EntidadRepositoryInterface
{
    /**
     * Obtener todas las entidades ordenadas por nombre.
     */
    public function obtenerTodasOrdenadas(): Collection
    {
        return Entidad::query()
            ->orderBy('nombre')
            ->get();
    }

    /**
     * Obtener una entidad por su ID.
     */
    public function obtenerPorId(int $id): Entidad
    {
        return Entidad::query()
            ->findOrFail($id);
    }

    /**
     * Contar todas las entidades.
     */
    public function contarTodas(): int
    {
        return Entidad::query()->count();
    }

    /**
     * Contar entidades por estado.
     */
    public function contarPorEstado(string $estado): int
    {
        return Entidad::query()
            ->where('estado', $estado)
            ->count();
    }

    /**
     * Crear una entidad.
     */
    public function crear(array $datos): Entidad
    {
        return Entidad::create($datos);
    }

    /**
     * Actualizar una entidad.
     */
    public function actualizar(Entidad $entidad, array $datos): Entidad
    {
        $entidad->update($datos);

        return $entidad->refresh();
    }
}