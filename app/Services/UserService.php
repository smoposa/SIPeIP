<?php

namespace App\Services;

use App\Enums\EstadoUsuario;
use App\Models\User;
use App\Repositories\Contracts\UserRepositoryInterface;
use App\Repositories\Contracts\RoleRepositoryInterface;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Illuminate\Support\Facades\Hash;

class UserService
{
    public function __construct(
        protected UserRepositoryInterface $userRepository,
        protected RoleRepositoryInterface $roleRepository
    ) {}

    public function obtenerUsuarios(User $usuarioAutenticado): Collection
    {
        if ($this->esAdministradorGlobal($usuarioAutenticado)) {
            return $this->userRepository->obtenerTodos();
        }
        return $this->userRepository->obtenerPorEntidad($usuarioAutenticado->entidad_id);
    }

    /** Aplicar el ámbito institucional antes de consultar usuarios paginados. */
    public function obtenerUsuariosPaginados(User $usuarioAutenticado, string $buscar = '', string $estado = '', int $porPagina = 7, ?int $entidadId = null, bool $sinEntidad = false): LengthAwarePaginator
    {
        if (!$this->esAdministradorGlobal($usuarioAutenticado)) {
            abort_if($usuarioAutenticado->entidad_id === null, 403, 'No tiene una entidad asignada.');
            $entidadId = $usuarioAutenticado->entidad_id;
            $sinEntidad = false;
        }
        $porPagina = in_array($porPagina, [7, 10, 15], true) ? $porPagina : 7;
        $estado = in_array($estado, ['Activo', 'Inactivo'], true) ? $estado : '';
        return $this->userRepository->obtenerPaginados($entidadId, trim($buscar), $estado, $porPagina, $sinEntidad);
    }

    public function obtenerResumen(User $usuarioAutenticado): array
    {
        $global = $this->esAdministradorGlobal($usuarioAutenticado);
        abort_if(!$global && $usuarioAutenticado->entidad_id === null, 403, 'No tiene una entidad asignada.');
        $entidadId = $global ? null : $usuarioAutenticado->entidad_id;
        $total = $entidadId === null ? $this->userRepository->contarTodos() : $this->userRepository->contarPorEntidad($entidadId);
        return [
            'totalUsuarios' => $total,
            'usuariosActivos' => $this->userRepository->contarPorEstado(EstadoUsuario::ACTIVO->value, $entidadId),
            'usuariosInactivos' => $this->userRepository->contarPorEstado(EstadoUsuario::INACTIVO->value, $entidadId),
        ];
    }

    public function buscarPorId(int $id, User $usuarioAutenticado): User
    {
        $usuario = $this->userRepository->buscarPorId($id);
        if ($this->esAdministradorGlobal($usuarioAutenticado)) { return $usuario; }
        if ($usuario->entidad_id !== $usuarioAutenticado->entidad_id) {
            abort(403, 'No tiene autorización para acceder a este usuario.');
        }
        return $usuario;
    }

    public function crear(array $datos, User $usuarioAutenticado): User
    {
        $this->validarRolAsignable((int) $datos['rol_id'], $usuarioAutenticado);
        if (!$this->esAdministradorGlobal($usuarioAutenticado)) {
            $datos['entidad_id'] = $usuarioAutenticado->entidad_id;
        }
        $datos['name'] = trim(($datos['nombres'] ?? '') . ' ' . ($datos['apellidos'] ?? ''));
        $datos['estado'] = EstadoUsuario::ACTIVO->value;
        if (isset($datos['password'])) { $datos['password'] = Hash::make($datos['password']); }
        return $this->userRepository->crear($datos);
    }

    public function actualizar(User $usuario, array $datos): bool
    {
        if (isset($datos['nombres']) || isset($datos['apellidos'])) {
            $nombres = $datos['nombres'] ?? $usuario->nombres;
            $apellidos = $datos['apellidos'] ?? $usuario->apellidos;
            $datos['name'] = trim($nombres . ' ' . $apellidos);
        }
        return $this->userRepository->actualizar($usuario, $datos);
    }

    public function cambiarEstado(User $usuario, string $estado, User $usuarioAutenticado): bool
    {
        if ($usuario->id === $usuarioAutenticado->id && $estado === EstadoUsuario::INACTIVO->value) {
            throw new \DomainException('No puede desactivar su propio usuario.');
        }
        if ($usuario->rol?->codigo === 'ADMIN_GLOBAL' && $usuario->estado === EstadoUsuario::ACTIVO->value && $estado === EstadoUsuario::INACTIVO->value) {
            if ($this->userRepository->contarAdministradoresGlobalesActivos() <= 1) {
                throw new \DomainException('No puede desactivar al último Administrador Global activo del sistema.');
            }
        }
        return $this->userRepository->actualizar($usuario, ['estado' => $estado]);
    }

    public function cambiarRol(User $usuario, int $rolId, User $usuarioAutenticado): bool
    {
        $this->validarRolAsignable($rolId, $usuarioAutenticado);
        return $this->userRepository->actualizar($usuario, ['rol_id' => $rolId]);
    }

    public function cambiarEntidad(User $usuario, ?int $entidadId): bool
    {
        return $this->userRepository->actualizar($usuario, ['entidad_id' => $entidadId]);
    }

    public function cambiarPassword(User $usuario, string $password): bool
    {
        return $this->userRepository->actualizar($usuario, ['password' => Hash::make($password)]);
    }

    private function validarRolAsignable(int $rolId, User $usuarioAutenticado): void
    {
        $rol = $this->roleRepository->obtenerPorId($rolId);
        if ($rol->estado !== 'Activo') { abort(403, 'No puede asignar un rol que se encuentra inactivo.'); }
        if ($this->esAdministradorGlobal($usuarioAutenticado)) { return; }
        if (!$rol->asignable_institucion) { abort(403, 'No tiene autorización para asignar este rol.'); }
    }

    private function esAdministradorGlobal(User $usuario): bool
    {
        return $usuario->rol?->codigo === 'ADMIN_GLOBAL';
    }
}
