<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Rol;
use App\Models\Entidad;

use App\Services\UserService;

use App\Http\Requests\Usuarios\StoreUserRequest;
use App\Http\Requests\Usuarios\UpdateUserRequest;
use App\Http\Requests\Usuarios\UpdateUserStatusRequest;
use App\Http\Requests\Usuarios\UpdateUserRoleRequest;
use App\Http\Requests\Usuarios\UpdateUserEntidadRequest;
use App\Http\Requests\Usuarios\UpdateUserPasswordRequest;

class UserController extends Controller
{
    /**
     * Servicio de usuarios.
     */
    public function __construct(
        protected UserService $userService
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
        $roles = Rol::where('estado', 'Activo')
            ->orderBy('nombre')
            ->get();

        $entidades = Entidad::where('estado', 'Activo')
            ->orderBy('nombre')
            ->get();

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

        $this->userService->crear($datos);

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
            $usuario->id
        );

        return view('usuarios.detalle', compact('usuario'));
    }


    /**
     * Mostrar formulario de edición.
     */
    public function editar(User $usuario)
    {
        $usuario = $this->userService->buscarPorId(
            $usuario->id
        );

        $roles = Rol::where('estado', 'Activo')
            ->orderBy('nombre')
            ->get();

        $entidades = Entidad::where('estado', 'Activo')
            ->orderBy('nombre')
            ->get();

        return view('usuarios.editar', compact(
            'usuario',
            'roles',
            'entidades'
        ));
    }


    /**
     * Actualizar usuario.
     */
    public function update(
        UpdateUserRequest $request,
        User $usuario
    ) {
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
        return view('usuarios.estado', compact('usuario'));
    }


    /**
     * Actualizar estado del usuario.
     */
    public function actualizarEstado(
        UpdateUserStatusRequest $request,
        User $usuario
    ) {
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
        $usuario = $this->userService->buscarPorId($id);

        $roles = Rol::where('estado', 'Activo')
            ->orderBy('nombre')
            ->get();

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
        $usuario = $this->userService->buscarPorId($id);

        $this->userService->cambiarRol(
            $usuario,
            (int) $request->validated('rol_id')
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
        $usuario = $this->userService->buscarPorId($id);

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
        $usuario = $this->userService->buscarPorId($id);

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
        $usuario = $this->userService->buscarPorId($id);

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
        $usuario = $this->userService->buscarPorId($id);

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