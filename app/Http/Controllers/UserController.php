<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Entidad;

use App\Services\UserService;
use App\Services\RoleService;

use App\Http\Requests\Usuarios\StoreUserRequest;
use App\Http\Requests\Usuarios\UpdateUserRequest;
use App\Http\Requests\Usuarios\UpdateUserStatusRequest;
use App\Http\Requests\Usuarios\UpdateUserRoleRequest;
use App\Http\Requests\Usuarios\UpdateUserEntidadRequest;
use App\Http\Requests\Usuarios\UpdateUserPasswordRequest;

class UserController extends Controller
{
    /**
     * Servicios de usuarios y roles.
     */
    public function __construct(
        protected UserService $userService,
        protected RoleService $roleService
    ) {
    }


    /**
     * Mostrar listado general de usuarios.
     */
    public function index()
    {
        $usuarioAutenticado = auth()->user();

        $usuarios = $this->userService->obtenerUsuarios(
            $usuarioAutenticado
        );

        $resumen = $this->userService->obtenerResumen(
            $usuarioAutenticado
        );

        return view('usuarios.index', [
            'usuarios' => $usuarios,
            'totalUsuarios' => $resumen['totalUsuarios'],
            'usuariosActivos' => $resumen['usuariosActivos'],
            'usuariosInactivos' => $resumen['usuariosInactivos'],
        ]);
    }


    /**
     * Mostrar formulario para crear usuario.
     */
    public function crear()
    {
        $usuarioAutenticado = auth()->user();

        /*
         * Obtener roles disponibles según
         * el ámbito del usuario autenticado.
         */
        $roles = $this->roleService->obtenerRolesAsignables(
            $usuarioAutenticado
        );

        /*
         * Administrador Global:
         * puede seleccionar cualquier entidad activa.
         *
         * Administrador Institucional:
         * solamente puede utilizar su propia entidad.
         */
        if ($usuarioAutenticado->rol?->codigo === 'ADMIN_GLOBAL') {

            $entidades = Entidad::where('estado', 'Activo')
                ->orderBy('nombre')
                ->get();

        } else {

            $entidades = Entidad::where(
                'id',
                $usuarioAutenticado->entidad_id
            )->get();
        }

        return view('usuarios.crear', compact(
            'roles',
            'entidades'
        ));
    }


    /**
     * Registrar usuario.
     */
    public function store(StoreUserRequest $request)
    {
        $datos = $request->validated();

        // Contraseña temporal inicial.
        $datos['password'] = '12345678';

        $this->userService->crear(
            $datos,
            auth()->user()
        );

        return redirect()
            ->route('usuarios.index')
            ->with(
                'success',
                'Usuario registrado correctamente.'
            );
    }


    /**
     * Mostrar detalle del usuario.
     */
    public function detalle(User $usuario)
    {
        $usuario = $this->userService->buscarPorId(
            $usuario->id,
            auth()->user()
        );

        return view('usuarios.detalle', compact('usuario'));
    }


    /**
     * Mostrar formulario de edición
     * de los datos generales del usuario.
     */
    public function editar(User $usuario)
    {
        $usuario = $this->userService->buscarPorId(
            $usuario->id,
            auth()->user()
        );

        return view('usuarios.editar', compact(
            'usuario'
        ));
    }


    /**
     * Actualizar usuario.
     */
    public function update(
        UpdateUserRequest $request,
        User $usuario
    ) {
        $usuario = $this->userService->buscarPorId(
            $usuario->id,
            auth()->user()
        );

        $this->userService->actualizar(
            $usuario,
            $request->validated()
        );

        return redirect()
            ->route('usuarios.show', $usuario->id)
            ->with(
                'success',
                'Usuario actualizado correctamente.'
            );
    }


    /**
     * Mostrar formulario para modificar estado.
     */
    public function editarEstado(User $usuario)
    {
        $usuario = $this->userService->buscarPorId(
            $usuario->id,
            auth()->user()
        );

        return view('usuarios.estado', compact('usuario'));
    }


    /**
     * Actualizar estado del usuario.
     */
    public function actualizarEstado(
        UpdateUserStatusRequest $request,
        User $usuario
    ) {
        $usuario = $this->userService->buscarPorId(
            $usuario->id,
            auth()->user()
        );

        $this->userService->cambiarEstado(
            $usuario,
            $request->validated('estado')
        );

        return redirect()
            ->route('usuarios.show', $usuario->id)
            ->with(
                'success',
                'Estado del usuario actualizado correctamente.'
            );
    }


    /**
     * Mostrar usuarios desactivados.
     */
    public function desactivados()
    {
        return view('usuarios.desactivados');
    }


    /**
     * Mostrar formulario para modificar rol.
     */
    public function editRoles(int $id)
    {
        $usuarioAutenticado = auth()->user();

        $usuario = $this->userService->buscarPorId(
            $id,
            $usuarioAutenticado
        );

        /*
         * Obtener roles disponibles según
         * el ámbito del usuario autenticado.
         */
        $roles = $this->roleService->obtenerRolesAsignables(
            $usuarioAutenticado
        );

        return view('usuarios.editroles', compact(
            'usuario',
            'roles'
        ));
    }


    /**
     * Actualizar rol.
     */
    public function updateRoles(
        UpdateUserRoleRequest $request,
        int $id
    ) {
        $usuarioAutenticado = auth()->user();

        $usuario = $this->userService->buscarPorId(
            $id,
            $usuarioAutenticado
        );

        $this->userService->cambiarRol(
            $usuario,
            (int) $request->validated('rol_id'),
            $usuarioAutenticado
        );

        return redirect()
            ->route('usuarios.show', $usuario->id)
            ->with(
                'success',
                'Rol asignado correctamente.'
            );
    }


    /**
     * Mostrar formulario para modificar entidad.
     */
    public function editEntidad(int $id)
    {
        $usuario = $this->userService->buscarPorId(
            $id,
            auth()->user()
        );

        $entidades = Entidad::where('estado', 'Activo')
            ->orderBy('nombre')
            ->get();

        return view('usuarios.editentidad', compact(
            'usuario',
            'entidades'
        ));
    }


    /**
     * Actualizar entidad.
     */
    public function updateEntidad(
        UpdateUserEntidadRequest $request,
        int $id
    ) {
        $usuario = $this->userService->buscarPorId(
            $id,
            auth()->user()
        );

        $this->userService->cambiarEntidad(
            $usuario,
            (int) $request->validated('entidad_id')
        );

        return redirect()
            ->route('usuarios.show', $usuario->id)
            ->with(
                'success',
                'Entidad asignada correctamente.'
            );
    }


    /**
     * Mostrar formulario para restablecer contraseña.
     */
    public function editPassword(int $id)
    {
        $usuario = $this->userService->buscarPorId(
            $id,
            auth()->user()
        );

        return view('usuarios.editpassword', compact(
            'usuario'
        ));
    }


    /**
     * Restablecer contraseña.
     */
    public function updatePassword(
        UpdateUserPasswordRequest $request,
        int $id
    ) {
        $usuario = $this->userService->buscarPorId(
            $id,
            auth()->user()
        );

        $this->userService->cambiarPassword(
            $usuario,
            $request->validated('password')
        );

        return redirect()
            ->route('usuarios.show', $usuario->id)
            ->with(
                'success',
                'Contraseña restablecida correctamente.'
            );
    }
}