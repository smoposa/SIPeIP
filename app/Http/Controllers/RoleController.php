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
        return view('roles.create');
    }

    public function desactivados()
    {
        return view('roles.desactivados');
    }

    public function store(Request $request)
    {
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
            ->route('roles.create')
            ->with('success', 'Rol registrado correctamente.');
    }

    public function edit($id)
    {
        $rol = Rol::findOrFail($id);

        return view('roles.editar', compact('rol'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'nombre' => 'required|max:100',
            'descripcion' => 'nullable|max:255',
            'estado' => 'required|in:Activo,Inactivo',
        ]);

        $rol = Rol::findOrFail($id);

        $rol->update([
            'nombre' => $request->nombre,
            'descripcion' => $request->descripcion,
            'estado' => $request->estado,
        ]);

        return redirect()
            ->route('roles.listar')
            ->with('success', 'Rol actualizado correctamente.');
    }

    
}