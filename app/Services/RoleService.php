<?php

namespace App\Services;

use App\Enums\EstadoRol;
use App\Models\Rol;
use App\Repositories\Contracts\RoleRepositoryInterface;
use Illuminate\Database\Eloquent\Collection;

class RoleService
{
    public function __construct(
        private readonly RoleRepositoryInterface $roleRepository
    ) {
    }

    /**
     * Obtener los datos generales del módulo de roles.
     */
    public function obtenerResumen(): array
    {
        return [
            'totalRoles'     => $this->roleRepository->contarTodos(),
            'rolesActivos'   => $this->roleRepository->contarPorEstado(EstadoRol::ACTIVO->value),
            'rolesInactivos' => $this->roleRepository->contarPorEstado(EstadoRol::INACTIVO->value),
            'roles'          => $this->roleRepository->obtenerTodosOrdenados(),
        ];
    }

    /**
     * Obtener todos los roles.
     */
    public function listar(): Collection
    {
        return $this->roleRepository->obtenerTodosOrdenados();
    }

    /**
     * Obtener un rol por su ID.
     */
    public function obtenerPorId(int $id): Rol
    {
        return $this->roleRepository->obtenerPorId($id);
    }

    /**
     * Crear un rol.
     */
    public function crear(array $datos): Rol
    {
        return $this->roleRepository->crear([
            ...$datos,
            'estado' => EstadoRol::ACTIVO->value,
        ]);
    }

    /**
     * Actualizar un rol.
     */
    public function actualizar(Rol $rol, array $datos): Rol
    {
        return $this->roleRepository->actualizar($rol, $datos);
    }

    /**
     * Actualizar el estado de un rol.
     */
    public function actualizarEstado(Rol $rol, bool $activo): Rol
    {
        return $this->roleRepository->actualizar($rol, [
            'estado' => $activo
                ? EstadoRol::ACTIVO->value
                : EstadoRol::INACTIVO->value,
        ]);
    }
}