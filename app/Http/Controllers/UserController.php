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
        return view('usuarios.listar');
    }

    public function crear()
    {
        return view('usuarios.crear');
    }

    public function detalle(User $usuario)
    {
        return view('usuarios.detalle', compact('usuario'));
    }

    public function editar(User $usuario)
    {
        return view('usuarios.editar', compact('usuario'));
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