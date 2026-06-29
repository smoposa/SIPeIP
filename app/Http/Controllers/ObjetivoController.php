<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Objetivo;

class ObjetivoController extends Controller
{

    // Página principal del módulo.
    public function index()
    {
        $totalODS = Objetivo::where('tipo', 'ODS')->count();

        $totalPND = Objetivo::where('tipo', 'PND')->count();

        $totalOEI = Objetivo::where('tipo', 'OEI')->count();

        return view('objetivos.index', compact(
            'totalODS',
            'totalPND',
            'totalOEI'
        ));
    }


    // Catálogo de Objetivos de Desarrollo Sostenible (ODS).
    public function ods()
    {
        $objetivos = Objetivo::where('tipo', 'ODS')
            ->orderBy('codigo')
            ->get();

        return view('objetivos.ods', compact('objetivos'));
    }

    // Catálogo del Plan Nacional de Desarrollo (PND).
    public function pnd()
    {
        $objetivos = Objetivo::where('tipo', 'PND')
            ->orderBy('codigo')
            ->get();

        return view('objetivos.pnd', compact('objetivos'));
    }

    // Gestión de Objetivos Estratégicos Institucionales (OEI).
    public function oei()
    {
        $objetivos = Objetivo::where('tipo', 'OEI')
            ->orderBy('codigo')
            ->get();

        return view('objetivos.oei', compact('objetivos'));
    }

    public function createODS()
    {
        return view('objetivos.createODS');
    }

    public function createPND()
    {
        return view('objetivos.createPND');
    }

    public function createOEI()
    {
        return view('objetivos.createOEI');
    }

    public function store(Request $request)
    {
        $request->validate([

            'tipo' => 'required|in:ODS,PND,OEI',

            'codigo' => 'required|max:30|unique:objetivos,codigo',

            'nombre' => 'required|max:255',

            'descripcion' => 'nullable',

            'fecha_inicio' => 'nullable|date',

            'fecha_fin' => 'nullable|date',

            'estado' => 'required|in:Activo,Inactivo',

        ]);

        Objetivo::create([

            'tipo' => $request->tipo,

            'codigo' => $request->codigo,

            'nombre' => $request->nombre,

            'descripcion' => $request->descripcion,

            'fecha_inicio' => $request->fecha_inicio,

            'fecha_fin' => $request->fecha_fin,

            'estado' => $request->estado,

        ]);

        return redirect()
            ->route('objetivos.ods')
            ->with('success', 'Objetivo registrado correctamente.');
    }

    // Detalle de un Objetivo Estratégico Institucional.
    public function detalle($id)
    {
        $objetivo = Objetivo::findOrFail($id);

        return view('objetivos.detalle', compact('objetivo'));
    }
}