<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Rol;

class RoleController extends Controller
{
    public function index()
    {
        $totalRoles = Rol::count();

        $rolesActivos = Rol::where('estado', 'Activo')->count();

        $rolesInactivos = Rol::where('estado', 'Inactivo')->count();

        return view('roles.index', compact(
            'totalRoles',
            'rolesActivos',
            'rolesInactivos'
        ));
    }

    public function listar()
    {
        $roles = Rol::orderBy('nombre', 'asc')->get();
        return view('roles.listar', compact('roles'));
    }

    public function create()
    {
        $this->autorizar('roles', 'crear');

        return view('roles.create');
    }

    public function desactivados()
    {
        return view('roles.desactivados');
    }

    public function store(Request $request)
    {
        $this->autorizar('roles', 'crear');
        
        $request->validate([
            'nombre' => 'required|max:100',
            'descripcion' => 'nullable|max:255',
        ]);

        Rol::create([
            'nombre'      => $request->nombre,
            'descripcion' => $request->descripcion,
            'estado'      => 'Activo'
        ]);

        return redirect()
            ->route('roles.listar')
            ->with('success', 'Rol registrado correctamente.');
    }

    public function edit($id)
    {
        $this->autorizar('roles', 'editar');

        $rol = Rol::findOrFail($id);

        return view('roles.editar', compact('rol'));
    }

    public function update(Request $request, $id)
    {
        $this->autorizar('roles', 'editar');

        $request->validate([
            'nombre' => 'required|max:100',
            'descripcion' => 'nullable|max:255',
        ]);

        $rol = Rol::findOrFail($id);

        $rol->update([
            'nombre' => $request->nombre,
            'descripcion' => $request->descripcion,
        ]);

        return redirect()
            ->route('roles.detalle', $rol->id)
            ->with('success', 'Información del rol actualizada correctamente.');
    }

    public function detalle($id)
    {
        $rol = Rol::findOrFail($id);

        return view('roles.detalle', compact('rol'));
    }
    
    public function editarEstado($id)
    {
        $this->autorizar('roles', 'estado');

        $rol = Rol::findOrFail($id);

        return view('roles.editarestado', compact('rol'));
    }

    public function actualizarEstado(Request $request, $id)
    {
        $this->autorizar('roles', 'estado');
        
        $rol = Rol::findOrFail($id);

        $rol->estado = $request->has('estado')
            ? 'Activo'
            : 'Inactivo';

        $rol->save();

        return redirect()
            ->route('roles.detalle', $rol->id)
            ->with('success', 'Estado del rol actualizado correctamente.');
    }

}