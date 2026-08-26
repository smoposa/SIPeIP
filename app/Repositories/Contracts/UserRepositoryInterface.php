<?php

namespace App\Repositories\Contracts;

use App\Models\User;
use Illuminate\Database\Eloquent\Collection;

interface UserRepositoryInterface
{
    /**
     * Obtener todos los usuarios.
     */
    public function obtenerTodos(): Collection;


    /**
     * Obtener los usuarios pertenecientes a una entidad.
     */
    public function obtenerPorEntidad(int $entidadId): Collection;


    /**
     * Buscar un usuario por su ID.
     */
    public function buscarPorId(int $id): User;


    /**
     * Contar todos los usuarios.
     */
    public function contarTodos(): int;


    /**
     * Contar usuarios de una entidad.
     */
    public function contarPorEntidad(int $entidadId): int;


    /**
     * Contar usuarios por estado.
     */
    public function contarPorEstado(string $estado, ?int $entidadId = null): int;

    /**
     * Contar administradores globales activos.
     */
    public function contarAdministradoresGlobalesActivos(): int;

    /**
     * Crear un usuario.
     */
    public function crear(array $datos): User;


    /**
     * Actualizar un usuario.
     */
    public function actualizar(User $usuario, array $datos): bool;
}