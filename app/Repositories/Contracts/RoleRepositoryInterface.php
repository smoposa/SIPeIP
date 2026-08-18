<?php

namespace App\Repositories\Contracts;

use App\Models\Rol;
use Illuminate\Database\Eloquent\Collection;

interface RoleRepositoryInterface
{
    /**
     * Obtener todos los roles ordenados por nombre.
     */
    public function obtenerTodosOrdenados(): Collection;

    /**
     * Obtener los roles activos permitidos
     * para administradores institucionales.
     */
    public function obtenerAsignablesInstitucion(): Collection;

    /**
     * Obtener un rol por su ID.
     */
    public function obtenerPorId(int $id): Rol;

    /**
     * Obtener el total de roles registrados.
     */
    public function contarTodos(): int;

    /**
     * Obtener el total de roles según su estado.
     */
    public function contarPorEstado(string $estado): int;

    /**
     * Crear un nuevo rol.
     */
    public function crear(array $datos): Rol;

    /**
     * Actualizar un rol existente.
     */
    public function actualizar(Rol $rol, array $datos): Rol;

    /**
     * Actualizar los roles permitidos para instituciones.
     */
    public function actualizarAsignacionInstitucional(
        array $rolesSeleccionados
    ): void;
}