<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Entidad;

class EntidadController extends Controller
{
    public function index()
    {
        $totalEntidades = Entidad::count();

        $entidadesActivas = Entidad::where('estado', 'Activo')->count();

        $entidadesInactivas = Entidad::where('estado', 'Inactivo')->count();

        return view('entidades.index', compact(
            'totalEntidades',
            'entidadesActivas',
            'entidadesInactivas'
        ));
    }

    public function listar()
    {
        $entidades = Entidad::orderBy('nombre', 'asc')->get();

        return view('entidades.listar', compact('entidades'));
    }

    public function detalle($id)
    {
        $entidad = Entidad::findOrFail($id);

        return view('entidades.detalle', compact('entidad'));
    }

    public function create()
    {
        return view('entidades.create');
    }

    public function desactivadas()
    {
        return view('entidades.desactivadas');
    }
}