<?php

namespace App\Http\Controllers;

use App\Http\Requests\Roles\StoreRoleRequest;
use App\Http\Requests\Roles\UpdateRoleRequest;
use App\Http\Requests\Roles\UpdateRoleStatusRequest;
use App\Http\Requests\Roles\UpdateRoleAssignmentRequest;
use App\Services\RoleService;

class RoleController extends Controller
{
    public function __construct(
        private readonly RoleService $roleService
    ) {
    }

    // Mostrar el listado de roles.
    public function index()
    {
        $this->autorizar('roles');

        $resumen = $this->roleService->obtenerResumen();

        return view('roles.index', $resumen);
    }

    // Mostrar los roles permitidos para administradores institucionales.
    public function asignacion()
    {
        $this->autorizar('roles');

        $roles = $this->roleService->obtenerResumen()['roles'];

        return view('roles.asignacion', compact('roles'));
    }

    // Actualizar la asignación institucional de roles.
    public function actualizarAsignacion(
        UpdateRoleAssignmentRequest $request
    ) {
        $this->autorizar('roles', 'editar');

        $rolesSeleccionados = $request->validated('roles') ?? [];

        $this->roleService->actualizarAsignacionInstitucional(
            $rolesSeleccionados
        );

        return redirect()
            ->route('roles.asignacion')
            ->with(
                'success',
                'Asignación de roles actualizada correctamente.'
            );
    }

    // Mostrar el formulario de creación.
    public function create()
    {
        $this->autorizar('roles', 'crear');

        return view('roles.create');
    }

    // Registrar un rol.
    public function store(StoreRoleRequest $request)
    {
        $this->autorizar('roles', 'crear');

        $this->roleService->crear(
            $request->validated()
        );

        return redirect()
            ->route('roles.index')
            ->with('success', 'Rol registrado correctamente.');
    }

    // Mostrar el detalle del rol.
    public function detalle(int $id)
    {
        $this->autorizar('roles');

        $rol = $this->roleService->obtenerPorId($id);

        return view('roles.detalle', compact('rol'));
    }

    // Abrir el panel de información desde la ruta de edición.
    public function edit(int $id)
    {
        $this->autorizar('roles', 'editar');

        $rol = $this->roleService->obtenerPorId($id);

        return redirect()
            ->route('roles.detalle', $rol->id)
            ->with('abrir_panel_rol', 'informacion');
    }

    // Actualizar la información del rol.
    public function update(
        UpdateRoleRequest $request,
        int $id
    ) {
        $this->autorizar('roles', 'editar');

        $rol = $this->roleService->obtenerPorId($id);

        $this->roleService->actualizar(
            $rol,
            $request->validated()
        );

        return redirect()
            ->route('roles.detalle', $rol->id)
            ->with('success', 'Rol actualizado correctamente.');
    }

    // Abrir el panel de estado desde la ruta existente.
    public function editarEstado(int $id)
    {
        $this->autorizar('roles', 'estado');

        $rol = $this->roleService->obtenerPorId($id);

        $origen = request('origen') === 'asignacion'
            ? 'asignacion'
            : null;

        return redirect()
            ->route('roles.detalle', $rol->id)
            ->with('abrir_panel_rol', 'estado')
            ->with('origen_panel_rol', $origen);
    }

    // Actualizar el estado del rol.
    public function actualizarEstado(
        UpdateRoleStatusRequest $request,
        int $id
    ) {
        $this->autorizar('roles', 'estado');

        $rol = $this->roleService->obtenerPorId($id);

        $this->roleService->actualizarEstado(
            $rol,
            $request->boolean('estado')
        );

        // Conservar el regreso a la pantalla de asignación.
        if ($request->input('origen') === 'asignacion') {
            return redirect()
                ->route('roles.asignacion')
                ->with(
                    'success',
                    'Estado del rol actualizado correctamente.'
                );
        }

        return redirect()
            ->route('roles.detalle', $rol->id)
            ->with(
                'success',
                'Estado del rol actualizado correctamente.'
            );
    }
}