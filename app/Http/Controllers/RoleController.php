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

    /**
     * Panel principal del módulo de roles.
     */
    public function index()
    {
        $this->autorizar('roles');

        $resumen = $this->roleService->obtenerResumen();

        return view('roles.index', $resumen);
    }

    /**
     * Mostrar configuración de roles permitidos
     * para administradores institucionales.
     */
    public function asignacion()
    {
        $this->autorizar('roles');

        $roles = $this->roleService->obtenerResumen()['roles'];

        return view('roles.asignacion', compact('roles'));
    }

    /**
     * Actualizar los roles permitidos
     * para administradores institucionales.
     */
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

    /**
     * Mostrar formulario para crear un rol.
     */
    public function create()
    {
        $this->autorizar('roles', 'crear');

        return view('roles.create');
    }

    /**
     * Registrar un nuevo rol.
     */
    public function store(StoreRoleRequest $request)
    {
        $this->autorizar('roles', 'crear');

        $this->roleService->crear($request->validated());

        return redirect()
            ->route('roles.index')
            ->with('success', 'Rol registrado correctamente.');
    }

    /**
     * Mostrar detalle de un rol.
     */
    public function detalle(int $id)
    {
        $this->autorizar('roles');

        $rol = $this->roleService->obtenerPorId($id);

        return view('roles.detalle', compact('rol'));
    }

    /**
     * Mostrar formulario para editar un rol.
     */
    public function edit(int $id)
    {
        $this->autorizar('roles', 'editar');

        $rol = $this->roleService->obtenerPorId($id);

        return view('roles.editar', compact('rol'));
    }

    /**
     * Actualizar un rol.
     */
    public function update(UpdateRoleRequest $request, int $id)
    {
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

    /**
     * Mostrar formulario para modificar el estado.
     */
    public function editarEstado(int $id)
    {
        $this->autorizar('roles', 'estado');

        $rol = $this->roleService->obtenerPorId($id);

        return view('roles.editarestado', compact('rol'));
    }

    /**
     * Actualizar estado del rol.
     */
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

        return redirect()
            ->route('roles.detalle', $rol->id)
            ->with(
                'success',
                'Estado del rol actualizado correctamente.'
            );
    }
}