<?php

namespace App\Services;

use App\Enums\EstadoUsuario;
use App\Models\User;
use App\Repositories\Contracts\UserRepositoryInterface;
use App\Repositories\Contracts\RoleRepositoryInterface;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Support\Facades\Hash;

class UserService
{
    public function __construct(
        protected UserRepositoryInterface $userRepository,
        protected RoleRepositoryInterface $roleRepository
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
     * Buscar usuario según el ámbito institucional.
     */
    public function buscarPorId(
        int $id,
        User $usuarioAutenticado
    ): User {

        $usuario = $this->userRepository->buscarPorId($id);

        // El Administrador Global puede acceder a cualquier usuario.
        if ($this->esAdministradorGlobal($usuarioAutenticado)) {
            return $usuario;
        }

        // Los demás usuarios solo pueden acceder a usuarios
        // pertenecientes a su misma entidad.
        if ($usuario->entidad_id !== $usuarioAutenticado->entidad_id) {
            abort(
                403,
                'No tiene autorización para acceder a este usuario.'
            );
        }

        return $usuario;
    }


    /**
     * Crear usuario según el ámbito institucional.
     */
    public function crear(
        array $datos,
        User $usuarioAutenticado
    ): User {

        /*
         * Validar que el rol solicitado pueda ser asignado
         * por el usuario autenticado.
         */
        $this->validarRolAsignable(
            (int) $datos['rol_id'],
            $usuarioAutenticado
        );

        /*
         * Si no es Administrador Global,
         * la entidad se asigna automáticamente
         * desde el usuario autenticado.
         */
        if (!$this->esAdministradorGlobal($usuarioAutenticado)) {
            $datos['entidad_id'] = $usuarioAutenticado->entidad_id;
        }

        // Construir nombre completo.
        $datos['name'] = trim(
            ($datos['nombres'] ?? '') . ' ' . ($datos['apellidos'] ?? '')
        );

        // Todo usuario nuevo inicia activo.
        $datos['estado'] = EstadoUsuario::ACTIVO->value;

        // Encriptar contraseña.
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

        return $this->userRepository->actualizar(
            $usuario,
            $datos
        );
    }


    /**
     * Cambiar estado del usuario.
     */
    public function cambiarEstado(
        User $usuario,
        string $estado,
        User $usuarioAutenticado
    ): bool {

        /*
        * Impedir que un usuario
        * se desactive a sí mismo.
        */
        if (
            $usuario->id === $usuarioAutenticado->id &&
            $estado === EstadoUsuario::INACTIVO->value
        ) {
            throw new \DomainException(
                'No puede desactivar su propio usuario.'
            );
        }

        /*
        * Proteger al último Administrador Global activo.
        */
        if (
            $usuario->rol?->codigo === 'ADMIN_GLOBAL' &&
            $usuario->estado === EstadoUsuario::ACTIVO->value &&
            $estado === EstadoUsuario::INACTIVO->value
        ) {
            $totalAdministradoresGlobalesActivos =
                $this->userRepository
                    ->contarAdministradoresGlobalesActivos();

            if ($totalAdministradoresGlobalesActivos <= 1) {
                throw new \DomainException(
                    'No puede desactivar al último Administrador Global activo del sistema.'
                );
            }
        }

        return $this->userRepository->actualizar(
            $usuario,
            [
                'estado' => $estado,
            ]
        );
    }


    /**
     * Cambiar rol del usuario.
     */
    public function cambiarRol(
        User $usuario,
        int $rolId,
        User $usuarioAutenticado
    ): bool {

        /*
         * Validar que el nuevo rol pueda ser asignado
         * por el usuario autenticado.
         */
        $this->validarRolAsignable(
            $rolId,
            $usuarioAutenticado
        );

        return $this->userRepository->actualizar($usuario, [
            'rol_id' => $rolId,
        ]);
    }


    /**
     * Cambiar entidad del usuario.
     */
    public function cambiarEntidad(
        User $usuario,
        ?int $entidadId
    ): bool {

        return $this->userRepository->actualizar($usuario, [
            'entidad_id' => $entidadId,
        ]);
    }


    /**
     * Cambiar contraseña.
     */
    public function cambiarPassword(
        User $usuario,
        string $password
    ): bool {

        return $this->userRepository->actualizar($usuario, [
            'password' => Hash::make($password),
        ]);
    }


    /**
     * Validar que un rol pueda ser asignado
     * por el usuario autenticado.
     */
    private function validarRolAsignable(
        int $rolId,
        User $usuarioAutenticado
    ): void {

        $rol = $this->roleRepository->obtenerPorId($rolId);

        /*
         * Ningún usuario puede asignar
         * un rol que se encuentre inactivo.
         */
        if ($rol->estado !== 'Activo') {
            abort(
                403,
                'No puede asignar un rol que se encuentra inactivo.'
            );
        }

        /*
         * El Administrador Global puede asignar
         * cualquier rol activo.
         */
        if ($this->esAdministradorGlobal($usuarioAutenticado)) {
            return;
        }

        /*
         * Los administradores institucionales
         * solamente pueden asignar roles habilitados
         * para instituciones.
         */
        if (!$rol->asignable_institucion) {
            abort(
                403,
                'No tiene autorización para asignar este rol.'
            );
        }
    }


    /**
     * Determinar si el usuario es Administrador Global.
     */
    private function esAdministradorGlobal(User $usuario): bool
    {
        return $usuario->rol?->codigo === 'ADMIN_GLOBAL';
    }
}