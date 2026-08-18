<?php

namespace App\Services;

use App\Enums\EstadoUsuario;
use App\Models\User;
use App\Repositories\Contracts\UserRepositoryInterface;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Support\Facades\Hash;

class UserService
{
    public function __construct(
        protected UserRepositoryInterface $userRepository
    ) {
    }


    /**
     * Obtener usuarios según el ámbito institucional.
     */
    public function obtenerUsuarios(User $usuarioAutenticado): Collection
    {
        if ($this->esAdministradorGlobal($usuarioAutenticado)) {
            return $this->userRepository->obtenerTodos();
        }

        return $this->userRepository->obtenerPorEntidad(
            $usuarioAutenticado->entidad_id
        );
    }


    /**
     * Obtener resumen de usuarios según el ámbito institucional.
     */
    public function obtenerResumen(User $usuarioAutenticado): array
    {
        $entidadId = $this->esAdministradorGlobal($usuarioAutenticado)
            ? null
            : $usuarioAutenticado->entidad_id;

        $total = $entidadId === null
            ? $this->userRepository->contarTodos()
            : $this->userRepository->contarPorEntidad($entidadId);

        return [
            'totalUsuarios' => $total,

            'usuariosActivos' => $this->userRepository->contarPorEstado(
                EstadoUsuario::ACTIVO->value,
                $entidadId
            ),

            'usuariosInactivos' => $this->userRepository->contarPorEstado(
                EstadoUsuario::INACTIVO->value,
                $entidadId
            ),
        ];
    }


    /**
     * Buscar usuario.
     */
    public function buscarPorId(int $id): User
    {
        return $this->userRepository->buscarPorId($id);
    }


    /**
     * Crear usuario.
     */
    public function crear(array $datos): User
    {
        $datos['name'] = trim(
            ($datos['nombres'] ?? '') . ' ' . ($datos['apellidos'] ?? '')
        );

        $datos['estado'] = EstadoUsuario::ACTIVO->value;

        if (isset($datos['password'])) {
            $datos['password'] = Hash::make($datos['password']);
        }

        return $this->userRepository->crear($datos);
    }


    /**
     * Actualizar usuario.
     */
    public function actualizar(User $usuario, array $datos): bool
    {
        if (isset($datos['nombres']) || isset($datos['apellidos'])) {

            $nombres = $datos['nombres'] ?? $usuario->nombres;
            $apellidos = $datos['apellidos'] ?? $usuario->apellidos;

            $datos['name'] = trim($nombres . ' ' . $apellidos);
        }

        return $this->userRepository->actualizar($usuario, $datos);
    }


    /**
     * Cambiar estado del usuario.
     */
    public function cambiarEstado(User $usuario, string $estado): bool
    {
        return $this->userRepository->actualizar($usuario, [
            'estado' => $estado,
        ]);
    }


    /**
     * Cambiar rol del usuario.
     */
    public function cambiarRol(User $usuario, int $rolId): bool
    {
        return $this->userRepository->actualizar($usuario, [
            'rol_id' => $rolId,
        ]);
    }


    /**
     * Cambiar entidad del usuario.
     */
    public function cambiarEntidad(User $usuario, ?int $entidadId): bool
    {
        return $this->userRepository->actualizar($usuario, [
            'entidad_id' => $entidadId,
        ]);
    }


    /**
     * Cambiar contraseña.
     */
    public function cambiarPassword(User $usuario, string $password): bool
    {
        return $this->userRepository->actualizar($usuario, [
            'password' => Hash::make($password),
        ]);
    }


    /**
     * Determinar si el usuario es Administrador Global.
     */
    private function esAdministradorGlobal(User $usuario): bool
    {
        return $usuario->rol?->codigo === 'ADMIN_GLOBAL';
    }
}