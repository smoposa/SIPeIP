<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Rol;
use App\Models\Entidad;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function listar()
    {
        $usuarios = User::with(['rol', 'entidad'])->get();

        return view('usuarios.listar', compact('usuarios'));
    }

    public function crear()
    {
        $roles = Rol::where('estado', 'Activo')->get();

        $entidades = Entidad::where('estado', 'Activo')->get();

        return view('usuarios.crear', compact(
            'roles',
            'entidades'
        ));
    }

    public function store(Request $request)
    {
        $request->validate([
            'identificacion' => 'required|max:20',
            'nombres'        => 'required|max:150',
            'apellidos'      => 'required|max:150',
            'email'          => 'required|email|unique:users,email',
            'cargo'          => 'nullable|max:255',
            'rol_id'         => 'required|exists:roles,id',
            'entidad_id'     => 'required|exists:entidades,id',
        ]);

        User::create([
            'identificacion' => $request->identificacion,
            'nombres'        => $request->nombres,
            'apellidos'      => $request->apellidos,
            'name'           => $request->nombres . ' ' . $request->apellidos,
            'email'          => $request->email,
            'cargo'          => $request->cargo,
            'rol_id'         => $request->rol_id,
            'entidad_id'     => $request->entidad_id,
            'estado'         => 'Activo',
            'password'       => bcrypt('12345678'),
        ]);

        return redirect()
            ->route('usuarios.index')
            ->with('success', 'Usuario registrado correctamente.');
    }

    public function detalle(User $usuario)
    {
        $usuario->load(['rol', 'entidad']);

        return view('usuarios.detalle', compact('usuario'));
    }

    public function editar(User $usuario)
    {
        $roles = Rol::where('estado', 'Activo')->get();

        $entidades = Entidad::where('estado', 'Activo')->get();

        return view('usuarios.editar', compact(
            'usuario',
            'roles',
            'entidades'
        ));
    }

    public function actualizarEstado(Request $request, User $usuario)
    {
        $usuario->estado = $request->has('estado')
            ? 'Activo'
            : 'Inactivo';

        $usuario->save();

        return redirect()
            ->route('usuarios.show', $usuario->id)
            ->with('success', 'Estado del usuario actualizado correctamente.');
    }

    public function update(Request $request, User $usuario)
    {
        $request->validate([
            'identificacion' => 'required|max:20',
            'nombres'        => 'required|max:150',
            'apellidos'      => 'required|max:150',
            'email'          => 'required|email|max:255',
            'cargo'          => 'nullable|max:255',
            'rol_id'         => 'required|exists:roles,id',
            'entidad_id'     => 'required|exists:entidades,id',
        ]);

        $usuario->update([
            'identificacion' => $request->identificacion,
            'nombres'        => $request->nombres,
            'apellidos'      => $request->apellidos,
            'email'          => $request->email,
            'cargo'          => $request->cargo,
            'rol_id'         => $request->rol_id,
            'entidad_id'     => $request->entidad_id,
        ]);

        return redirect()
            ->route('usuarios.show', $usuario->id)
            ->with('success', 'Usuario actualizado correctamente.');
    }

    public function editarEstado(User $usuario)
    {
        return view('usuarios.estado', compact('usuario'));
    }

    public function desactivados()
    {
        return view('usuarios.desactivados');
    }
}