<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class RoleController extends Controller
{
    public function index()
    {
        return view('roles.index');
    }

    public function listar()
    {
        return view('roles.listar');
    }

    public function create()
    {
        return view('roles.create');
    }

    public function desactivados()
    {
        return view('roles.desactivados');
    }
}