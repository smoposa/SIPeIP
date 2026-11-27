<?php

namespace App\Services;

use App\Enums\EstadoRol;
use App\Models\Rol;
use App\Models\User;
use App\Repositories\Contracts\RoleRepositoryInterface;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Support\Facades\DB;

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
            'totalRoles' => $this->roleRepository->contarTodos(),

            'rolesActivos' => $this->roleRepository->contarPorEstado(
                EstadoRol::ACTIVO->value
            ),

            'rolesInactivos' => $this->roleRepository->contarPorEstado(
                EstadoRol::INACTIVO->value
            ),

            'roles' => $this->roleRepository->obtenerTodosOrdenados(),
        ];
    }

    
    /**
     * Obtener los roles disponibles para asignar
     * según el ámbito del usuario autenticado.
     */
    public function obtenerRolesAsignables(
        User $usuarioAutenticado
    ): Collection {

        // El Administrador Global puede asignar
        // cualquier rol que se encuentre activo.
        if ($usuarioAutenticado->rol?->codigo === 'ADMIN_GLOBAL') {
            return $this->roleRepository
                ->obtenerTodosOrdenados()
                ->where('estado', EstadoRol::ACTIVO->value)
                ->values();
        }

        // Los administradores institucionales solamente
        // pueden asignar los roles habilitados para instituciones.
        return $this->roleRepository->obtenerAsignablesInstitucion();
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
        $permisosSeleccionados = $datos['permisos'] ?? [];
        unset($datos['permisos']);

        $datos['estado'] = EstadoRol::ACTIVO->value;

        $datos['asignable_institucion'] =
            (bool) ($datos['asignable_institucion'] ?? false);

        // Registrar el rol y sus permisos en una sola transacción.
        return DB::transaction(function () use ($datos, $permisosSeleccionados) {
            $rol = $this->roleRepository->crear($datos);

            $rol->permisos()->sync($permisosSeleccionados);

            return $rol;
        });
    }

    /**
     * Actualizar un rol.
     */
    public function actualizar(Rol $rol, array $datos): Rol
    {
        $datos['asignable_institucion'] =
            (bool) ($datos['asignable_institucion'] ?? false);

        return $this->roleRepository->actualizar(
            $rol,
            $datos
        );
    }

    /**
     * Actualizar los permisos asignados a un rol.
     */
    public function actualizarPermisos(
        Rol $rol,
        array $permisosSeleccionados
    ): void {
        DB::transaction(function () use ($rol, $permisosSeleccionados) {
            $rol->permisos()->sync($permisosSeleccionados);

            $rol->touch();
        });
    }

    /**
     * Actualizar los roles permitidos
     * para administradores institucionales.
     */
    public function actualizarAsignacionInstitucional(
        array $rolesSeleccionados
    ): void {
        $this->roleRepository->actualizarAsignacionInstitucional(
            $rolesSeleccionados
        );
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
