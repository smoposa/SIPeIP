<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Objetivo;
use App\Models\Entidad;
use App\Models\Plan;

class ObjetivoController extends Controller
{
    /**
     * Página principal del módulo.
     */
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
        $objetivos = Objetivo::with(['entidad', 'plan'])
            ->where('tipo', 'OEI')
            ->orderBy('codigo')
            ->get();

        return view('objetivos.oei', compact('objetivos'));
    }

    //Formulario para crear ODS.
    public function createODS()
    {
        return view('objetivos.createODS');
    }

    // Formulario para crear PND.
    public function createPND()
    {
        return view('objetivos.createPND');
    }

    // Formulario para crear OEI.
    public function createOEI()
    {
        return view('objetivos.createOEI', [

            'entidades' => Entidad::where('estado', 'Activo')
                ->orderBy('nombre')
                ->get(),

            'planes' => Plan::where('estado', 'Activo')
                ->orderBy('nombre')
                ->get(),

        ]);
    }

    // Guardar objetivo.
    public function store(Request $request)
    {
        $request->validate([

            'tipo' => 'required|in:ODS,PND,OEI',

            'entidad_id' => 'nullable|exists:entidades,id',

            'plan_id' => 'nullable|exists:planes,id',

            'codigo' => 'required|max:30|unique:objetivos,codigo',

            'nombre' => 'required|max:255',

            'descripcion' => 'nullable',

            'fecha_inicio' => 'nullable|date',

            'fecha_fin' => 'nullable|date|after_or_equal:fecha_inicio',

            'estado' => 'required|in:Activo,Inactivo',

        ]);

        Objetivo::create([

            'tipo' => $request->tipo,

            'entidad_id' => $request->entidad_id,

            'plan_id' => $request->plan_id,

            'codigo' => $request->codigo,

            'nombre' => $request->nombre,

            'descripcion' => $request->descripcion,

            'fecha_inicio' => $request->fecha_inicio,

            'fecha_fin' => $request->fecha_fin,

            'estado' => $request->estado,

        ]);

        return redirect()
            ->route('objetivos.' . strtolower($request->tipo))
            ->with('success', 'Objetivo registrado correctamente.');
    }

    // Detalle del objetivo.
    public function detalle($id)
    {
        $objetivo = Objetivo::with(['entidad', 'plan'])
            ->findOrFail($id);

        return view('objetivos.detalle', compact('objetivo'));
    }

    public function edit($id)
    {
        $objetivo = Objetivo::findOrFail($id);

        return view('objetivos.editar', compact('objetivo'));
    }

    public function update(Request $request, $id)
    {
        // Lo implementaremos enseguida
    }
}