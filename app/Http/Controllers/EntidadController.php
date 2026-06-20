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

    public function store(Request $request)
    {
        $request->validate([
            'codigoInstitucional' => 'required|max:50',
            'ruc'                 => 'required|max:13',
            'nombre'              => 'required|max:255',
            'tipoEntidad'         => 'required',
            'nivelGobierno'       => 'required',
            'provincia'           => 'nullable|max:100',
            'canton'              => 'nullable|max:100',
            'parroquia'           => 'nullable|max:100',
            'direccion'           => 'nullable|max:255',
            'telefono'            => 'nullable|max:20',
        ]);

        Entidad::create([
            'codigoInstitucional' => $request->codigoInstitucional,
            'ruc'                 => $request->ruc,
            'nombre'              => $request->nombre,
            'tipoEntidad'         => $request->tipoEntidad,
            'nivelGobierno'       => $request->nivelGobierno,
            'provincia'           => $request->provincia,
            'canton'              => $request->canton,
            'parroquia'           => $request->parroquia,
            'direccion'           => $request->direccion,
            'telefono'            => $request->telefono,
            'estado'              => 'Activo'
        ]);

        return redirect()
            ->route('entidades.create')
            ->with('success', 'Entidad registrada correctamente.');
    }

    public function edit($id)
    {
        $entidad = Entidad::findOrFail($id);

        return view('entidades.editar', compact('entidad'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'codigoInstitucional' => 'required|max:50',
            'ruc'                 => 'required|max:13',
            'nombre'              => 'required|max:255',
            'tipoEntidad'         => 'required',
            'nivelGobierno'       => 'required',
            'provincia'           => 'nullable|max:100',
            'canton'              => 'nullable|max:100',
            'parroquia'           => 'nullable|max:100',
            'direccion'           => 'nullable|max:255',
            'telefono'            => 'nullable|max:20',
        ]);

        $entidad = Entidad::findOrFail($id);

        $entidad->update([
            'codigoInstitucional' => $request->codigoInstitucional,
            'ruc'                 => $request->ruc,
            'nombre'              => $request->nombre,
            'tipoEntidad'         => $request->tipoEntidad,
            'nivelGobierno'       => $request->nivelGobierno,
            'provincia'           => $request->provincia,
            'canton'              => $request->canton,
            'parroquia'           => $request->parroquia,
            'direccion'           => $request->direccion,
            'telefono'            => $request->telefono,
        ]);

        return redirect()
            ->route('entidades.detalle', $entidad->id)
            ->with('success', 'Entidad actualizada correctamente.');
    }

    public function desactivadas()
    {
        return view('entidades.desactivadas');
    }
}