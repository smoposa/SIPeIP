<?php

namespace App\Repositories\Eloquent;

use App\Models\User;
use App\Repositories\Contracts\UserRepositoryInterface;
use Illuminate\Database\Eloquent\Collection;

class UserRepository implements UserRepositoryInterface
{
    /**
     * Obtener todos los usuarios.
     */
    public function obtenerTodos(): Collection
    {
        return User::with(['rol', 'entidad'])
            ->orderBy('apellidos')
            ->orderBy('nombres')
            ->get();
    }


    /**
     * Obtener los usuarios pertenecientes a una entidad.
     */
    public function obtenerPorEntidad(int $entidadId): Collection
    {
        return User::with(['rol', 'entidad'])
            ->where('entidad_id', $entidadId)
            ->orderBy('apellidos')
            ->orderBy('nombres')
            ->get();
    }


    /**
     * Buscar un usuario por su ID.
     */
    public function buscarPorId(int $id): User
    {
        return User::with(['rol', 'entidad'])
            ->findOrFail($id);
    }


    /**
     * Contar todos los usuarios.
     */
    public function contarTodos(): int
    {
        return User::count();
    }


    /**
     * Contar usuarios de una entidad.
     */
    public function contarPorEntidad(int $entidadId): int
    {
        return User::where('entidad_id', $entidadId)
            ->count();
    }


    /**
     * Contar usuarios por estado.
     */
    public function contarPorEstado(
        string $estado,
        ?int $entidadId = null
    ): int {
        $query = User::where('estado', $estado);

        if ($entidadId !== null) {
            $query->where('entidad_id', $entidadId);
        }

        return $query->count();
    }

    /**
     * Contar administradores globales activos.
     */
    public function contarAdministradoresGlobalesActivos(): int
    {
        return User::where('estado', 'Activo')
            ->whereHas('rol', function ($query) {
                $query->where('codigo', 'ADMIN_GLOBAL');
            })
            ->count();
    }

    /**
     * Crear un usuario.
     */
    public function crear(array $datos): User
    {
        return User::create($datos);
    }


    /**
     * Actualizar un usuario.
     */
    public function actualizar(User $usuario, array $datos): bool
    {
        return $usuario->update($datos);
    }
}