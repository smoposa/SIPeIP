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

    $totalSecretarias = Entidad::where('tipoEntidad', 'Secretaría')->count();

    $totalMinisterios = Entidad::where('tipoEntidad', 'Ministerio')->count();

    $totalGadProvinciales = Entidad::where('tipoEntidad', 'GAD Provincial')->count();

    $totalGadMunicipales = Entidad::where('tipoEntidad', 'GAD Municipal')->count();

    $totalGadParroquiales = Entidad::where('tipoEntidad', 'GAD Parroquial')->count();

    return view('entidades.index', compact(
        'totalEntidades',
        'entidadesActivas',
        'entidadesInactivas',
        'totalSecretarias',
        'totalMinisterios',
        'totalGadProvinciales',
        'totalGadMunicipales',
        'totalGadParroquiales'
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
            'siglas'              => 'nullable|max:50',
            'tipoEntidad'         => 'required',
            'nivelGobierno'       => 'required',
            'provincia'           => 'nullable|max:100',
            'canton'              => 'nullable|max:100',
            'parroquia'           => 'nullable|max:100',
            'telefono'            => 'nullable|max:20',
            'correoInstitucional' => 'nullable|email|max:150',
            'direccion'           => 'nullable|max:255',
        ]);

        Entidad::create([
            'codigoInstitucional' => $request->codigoInstitucional,
            'ruc'                 => $request->ruc,
            'nombre'              => $request->nombre,
            'siglas'              => $request->siglas,
            'tipoEntidad'         => $request->tipoEntidad,
            'nivelGobierno'       => $request->nivelGobierno,
            'provincia'           => $request->provincia,
            'canton'              => $request->canton,
            'parroquia'           => $request->parroquia,
            'telefono'            => $request->telefono,
            'correoInstitucional' => $request->correoInstitucional,
            'direccion'           => $request->direccion,
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
            'siglas'              => 'nullable|max:50',
            'tipoEntidad'         => 'required',
            'nivelGobierno'       => 'required',
            'provincia'           => 'nullable|max:100',
            'canton'              => 'nullable|max:100',
            'parroquia'           => 'nullable|max:100',
            'telefono'            => 'nullable|max:20',
            'correoInstitucional' => 'nullable|email|max:150',
            'direccion'           => 'nullable|max:255',
            
        ]);

        $entidad = Entidad::findOrFail($id);

        $entidad->update([
            'codigoInstitucional' => $request->codigoInstitucional,
            'ruc'                 => $request->ruc,
            'nombre'              => $request->nombre,
            'siglas'              => $request->siglas,
            'tipoEntidad'         => $request->tipoEntidad,
            'nivelGobierno'       => $request->nivelGobierno,
            'provincia'           => $request->provincia,
            'canton'              => $request->canton,
            'parroquia'           => $request->parroquia,
            'telefono'            => $request->telefono,
            'correoInstitucional' => $request->correoInstitucional,
            'direccion'           => $request->direccion,
        ]);

        return redirect()
            ->route('entidades.detalle', $entidad->id)
            ->with('success', 'Entidad actualizada correctamente.');
    }

    public function editarEstado($id)
    {
        $entidad = Entidad::findOrFail($id);

        return view('entidades.editarestado', compact('entidad'));
    }

    public function actualizarEstado(Request $request, $id)
    {
        $entidad = Entidad::findOrFail($id);

        $entidad->estado = $request->has('estado')
            ? 'Activo'
            : 'Inactivo';

        $entidad->save();

        return redirect()
            ->route('entidades.detalle', $entidad->id)
            ->with('success', 'Estado actualizado correctamente.');
    }
    
    public function desactivadas()
    {
        return view('entidades.desactivadas');
    }
}