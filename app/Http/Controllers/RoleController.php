<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Rol;

class RoleController extends Controller
{
    public function index()
    {
        return view('roles.index');
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
}