<?php

namespace App\Repositories\Eloquent;

use App\Models\Rol;
use App\Repositories\Contracts\RoleRepositoryInterface;
use Illuminate\Database\Eloquent\Collection;

class RoleRepository implements RoleRepositoryInterface
{
    /**
     * Obtener todos los roles.
     */
    public function obtenerTodos(): Collection
    {
        return Rol::all();
    }

    /**
     * Obtener todos los roles ordenados por nombre.
     */
    public function obtenerTodosOrdenados(): Collection
    {
        return Rol::query()
            ->withCount('users')
            ->orderBy('nombre')
            ->get();
    }

    /**
     * Obtener un rol por su ID.
     */
    public function obtenerPorId(int $id): Rol
    {
        return Rol::findOrFail($id);
    }

    /**
     * Obtener el total de roles registrados.
     */
    public function contarTodos(): int
    {
        return Rol::count();
    }

    /**
     * Obtener el total de roles según su estado.
     */
    public function contarPorEstado(string $estado): int
    {
        return Rol::where('estado', $estado)->count();
    }

    /**
     * Crear un nuevo rol.
     */
    public function crear(array $datos): Rol
    {
        return Rol::create($datos);
    }

    /**
     * Actualizar un rol existente.
     */
    public function actualizar(Rol $rol, array $datos): Rol
    {
        $rol->update($datos);

        return $rol->refresh();
    }
}