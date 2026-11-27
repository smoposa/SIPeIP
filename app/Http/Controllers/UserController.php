<?php
namespace App\Http\Controllers;
use App\Models\User;
use App\Models\Entidad;
use App\Services\UserService;
use App\Services\RoleService;
use Illuminate\Http\Request;
use App\Http\Requests\Usuarios\StoreUserRequest;
use App\Http\Requests\Usuarios\UpdateUserRequest;
use App\Http\Requests\Usuarios\UpdateUserStatusRequest;
use App\Http\Requests\Usuarios\UpdateUserRoleRequest;
use App\Http\Requests\Usuarios\UpdateUserEntidadRequest;
use App\Http\Requests\Usuarios\UpdateUserPasswordRequest;

class UserController extends Controller
{
    public function __construct(protected UserService $userService, protected RoleService $roleService) {}

    public function index(Request $request)
    {
        $this->autorizar('usuarios');
        $usuarioAutenticado = auth()->user();
        $esGlobal = $usuarioAutenticado->rol?->codigo === 'ADMIN_GLOBAL';
        $buscar = trim($request->string('buscar')->toString());
        $estado = $request->string('estado')->toString();
        if (!in_array($estado, ['Activo', 'Inactivo'], true)) $estado = '';
        $filtroEntidad = $esGlobal ? $request->string('entidad')->toString() : '';
        $entidadesFiltro = $esGlobal ? Entidad::orderBy('nombre')->get() : collect();
        if ($filtroEntidad !== 'sin_entidad' && !$entidadesFiltro->contains(fn ($e) => (string) $e->id === $filtroEntidad)) $filtroEntidad = '';
        $usuarios = $this->userService->obtenerUsuariosPaginados($usuarioAutenticado, $buscar, $estado, $request->integer('per_page', 7), ctype_digit($filtroEntidad) ? (int) $filtroEntidad : null, $filtroEntidad === 'sin_entidad');
        $resumen = $this->userService->obtenerResumen($usuarioAutenticado);
        $roles = collect();
        $entidades = collect();
        if (puedeHacer('usuarios', 'crear')) {
            $roles = $this->roleService->obtenerRolesAsignables($usuarioAutenticado);
            $entidades = $esGlobal ? Entidad::where('estado', 'Activo')->orderBy('nombre')->get() : Entidad::where('id', $usuarioAutenticado->entidad_id)->get();
        }
        return view('usuarios.index', [...$resumen, ...compact('usuarios', 'roles', 'entidades', 'entidadesFiltro', 'esGlobal', 'buscar', 'estado', 'filtroEntidad')]);
    }
    public function store(StoreUserRequest $request)
    {
        $this->autorizar('usuarios', 'crear');
        $datos = $request->validated();
        $datos['password'] = '12345678';
        $this->userService->crear($datos, auth()->user());
        return redirect()->route('usuarios.index')->with('success', 'Usuario registrado correctamente.');
    }
    public function detalle(User $usuario)
    {
        $this->autorizar('usuarios');
        $usuarioAutenticado = auth()->user();
        $usuario = $this->userService->buscarPorId($usuario->id, $usuarioAutenticado);
        $roles = puedeHacer('usuarios', 'editarRol') ? $this->roleService->obtenerRolesAsignables($usuarioAutenticado) : collect();
        $entidades = puedeHacer('usuarios', 'editarEntidad') ? Entidad::where('estado', 'Activo')->orderBy('nombre')->get() : collect();
        return view('usuarios.detalle', compact('usuario', 'roles', 'entidades'));
    }
    public function editar(User $usuario) { return $this->abrirPanel($usuario->id, 'editar', 'informacion'); }
    public function update(UpdateUserRequest $request, User $usuario)
    {
        $this->autorizar('usuarios', 'editar');
        $usuario = $this->userService->buscarPorId($usuario->id, auth()->user());
        $this->userService->actualizar($usuario, $request->validated());
        return redirect()->route('usuarios.show', $usuario->id)->with('success', 'Usuario actualizado correctamente.');
    }
    public function editarEstado(User $usuario) { return $this->abrirPanel($usuario->id, 'estado', 'estado'); }
    public function actualizarEstado(UpdateUserStatusRequest $request, User $usuario)
    {
        $this->autorizar('usuarios', 'estado');
        $usuario = $this->userService->buscarPorId($usuario->id, auth()->user());
        try { $this->userService->cambiarEstado($usuario, $request->validated('estado'), auth()->user()); }
        catch (\DomainException $e) {
            return redirect()->route('usuarios.show', $usuario->id)->with('abrir_panel_usuario', 'estado')->with('error', $e->getMessage())->withInput(['_usuario_estado_form' => $usuario->id, 'estado' => $request->input('estado')]);
        }
        return redirect()->route('usuarios.show', $usuario->id)->with('success', 'Estado del usuario actualizado correctamente.');
    }
    public function desactivados() { $this->autorizar('usuarios'); return view('usuarios.desactivados'); }
    public function editRoles(int $id) { return $this->abrirPanel($id, 'editarRol', 'rol'); }
    public function updateRoles(UpdateUserRoleRequest $request, int $id)
    {
        $this->autorizar('usuarios', 'editarRol');
        $usuarioAutenticado = auth()->user();
        $usuario = $this->userService->buscarPorId($id, $usuarioAutenticado);
        $this->userService->cambiarRol($usuario, (int) $request->validated('rol_id'), $usuarioAutenticado);
        return redirect()->route('usuarios.show', $usuario->id)->with('success', 'Rol asignado correctamente.');
    }
    public function editEntidad(int $id) { return $this->abrirPanel($id, 'editarEntidad', 'entidad'); }
    public function updateEntidad(UpdateUserEntidadRequest $request, int $id)
    {
        $this->autorizar('usuarios', 'editarEntidad');
        $usuario = $this->userService->buscarPorId($id, auth()->user());
        $this->userService->cambiarEntidad($usuario, (int) $request->validated('entidad_id'));
        return redirect()->route('usuarios.show', $usuario->id)->with('success', 'Entidad asignada correctamente.');
    }
    public function editPassword(int $id) { return $this->abrirPanel($id, 'editarPassword', 'password'); }
    public function updatePassword(UpdateUserPasswordRequest $request, int $id)
    {
        $this->autorizar('usuarios', 'editarPassword');
        $usuario = $this->userService->buscarPorId($id, auth()->user());
        $this->userService->cambiarPassword($usuario, $request->validated('password'));
        return redirect()->route('usuarios.show', $usuario->id)->with('success', 'Contraseña restablecida correctamente.');
    }
    private function abrirPanel(int $id, string $accion, string $panel)
    {
        $this->autorizar('usuarios', $accion);
        $usuario = $this->userService->buscarPorId($id, auth()->user());
        return redirect()->route('usuarios.show', $usuario->id)->with('abrir_panel_usuario', $panel);
    }
}
