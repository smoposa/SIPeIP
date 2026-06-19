<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class RoleController extends Controller
{
    public function informacion()
    {
        return view('roles.informacion');
    }

    public function index()
    {
        return view('roles.index');
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