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
    public function __construct(
        protected UserService $userService,
        protected RoleService $roleService
    ) {
    }

    // Mostrar el listado de usuarios.
    public function index()
    {
        $this->autorizar('usuarios');

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

    // Mostrar el formulario de creación.
    public function crear()
    {
        $this->autorizar('usuarios', 'crear');

        $usuarioAutenticado = auth()->user();

        $roles = $this->roleService->obtenerRolesAsignables(
            $usuarioAutenticado
        );

        // Conservar el ámbito institucional utilizado actualmente.
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

    // Registrar un usuario.
    public function store(StoreUserRequest $request)
    {
        $this->autorizar('usuarios', 'crear');

        $datos = $request->validated();

        // Conservar la contraseña temporal inicial existente.
        $datos['password'] = '12345678';

        $this->userService->crear(
            $datos,
            auth()->user()
        );

        return redirect()
            ->route('usuarios.index')
            ->with('success', 'Usuario registrado correctamente.');
    }

    // Mostrar el detalle con los datos necesarios para los paneles.
    public function detalle(User $usuario)
    {
        $this->autorizar('usuarios');

        $usuarioAutenticado = auth()->user();

        $usuario = $this->userService->buscarPorId(
            $usuario->id,
            $usuarioAutenticado
        );

        $roles = puedeHacer('usuarios', 'editarRol')
            ? $this->roleService->obtenerRolesAsignables(
                $usuarioAutenticado
            )
            : collect();

        $entidades = puedeHacer('usuarios', 'editarEntidad')
            ? Entidad::where('estado', 'Activo')
                ->orderBy('nombre')
                ->get()
            : collect();

        return view('usuarios.detalle', compact(
            'usuario',
            'roles',
            'entidades'
        ));
    }

    // Abrir el panel de información.
    public function editar(User $usuario)
    {
        return $this->abrirPanel(
            $usuario->id,
            'editar',
            'informacion'
        );
    }

    // Actualizar los datos generales.
    public function update(
        UpdateUserRequest $request,
        User $usuario
    ) {
        $this->autorizar('usuarios', 'editar');

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
            ->with('success', 'Usuario actualizado correctamente.');
    }

    // Abrir el panel de estado.
    public function editarEstado(User $usuario)
    {
        return $this->abrirPanel(
            $usuario->id,
            'estado',
            'estado'
        );
    }

    // Actualizar el estado conservando las restricciones del servicio.
    public function actualizarEstado(
        UpdateUserStatusRequest $request,
        User $usuario
    ) {
        $this->autorizar('usuarios', 'estado');

        $usuario = $this->userService->buscarPorId(
            $usuario->id,
            auth()->user()
        );

        try {

            $this->userService->cambiarEstado(
                $usuario,
                $request->validated('estado'),
                auth()->user()
            );

        } catch (\DomainException $e) {

            return redirect()
                ->route('usuarios.show', $usuario->id)
                ->with('abrir_panel_usuario', 'estado')
                ->with('error', $e->getMessage())
                ->withInput([
                    '_usuario_estado_form' => $usuario->id,
                    'estado' => $request->input('estado'),
                ]);

        }

        return redirect()
            ->route('usuarios.show', $usuario->id)
            ->with(
                'success',
                'Estado del usuario actualizado correctamente.'
            );
    }

    // Mostrar la pantalla existente de usuarios desactivados.
    public function desactivados()
    {
        $this->autorizar('usuarios');

        return view('usuarios.desactivados');
    }

    // Abrir el panel de rol.
    public function editRoles(int $id)
    {
        return $this->abrirPanel(
            $id,
            'editarRol',
            'rol'
        );
    }

    // Actualizar el rol según las reglas de asignación existentes.
    public function updateRoles(
        UpdateUserRoleRequest $request,
        int $id
    ) {
        $this->autorizar('usuarios', 'editarRol');

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
            ->with('success', 'Rol asignado correctamente.');
    }

    // Abrir el panel de entidad.
    public function editEntidad(int $id)
    {
        return $this->abrirPanel(
            $id,
            'editarEntidad',
            'entidad'
        );
    }

    // Actualizar la entidad asignada.
    public function updateEntidad(
        UpdateUserEntidadRequest $request,
        int $id
    ) {
        $this->autorizar('usuarios', 'editarEntidad');

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
            ->with('success', 'Entidad asignada correctamente.');
    }

    // Abrir el panel de contraseña.
    public function editPassword(int $id)
    {
        return $this->abrirPanel(
            $id,
            'editarPassword',
            'password'
        );
    }

    // Restablecer la contraseña.
    public function updatePassword(
        UpdateUserPasswordRequest $request,
        int $id
    ) {
        $this->autorizar('usuarios', 'editarPassword');

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
            ->with('success', 'Contraseña restablecida correctamente.');
    }

    // Validar el permiso y el ámbito antes de abrir un panel.
    private function abrirPanel(
        int $id,
        string $accion,
        string $panel
    ) {
        $this->autorizar('usuarios', $accion);

        $usuario = $this->userService->buscarPorId(
            $id,
            auth()->user()
        );

        return redirect()
            ->route('usuarios.show', $usuario->id)
            ->with('abrir_panel_usuario', $panel);
    }
}