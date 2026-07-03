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

            'eje' => 'nullable|max:100',

            'entidad_id' => 'nullable|exists:entidades,id',

            'plan_id' => 'nullable|exists:planes,id',

            'codigo' => 'required|max:30|unique:objetivos,codigo',

            'nombre' => 'required|max:255',

            'descripcion' => 'nullable',

            'fecha_inicio' => 'nullable|date',

            'fecha_fin' => 'nullable|date|after_or_equal:fecha_inicio',

            'estado' => 'required|in:Activo,Inactivo',

        ]);

        

$objetivo = Objetivo::create([

    'tipo' => $request->tipo,

    'eje' => $request->eje,

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

        switch ($objetivo->tipo) {

            case 'ODS':
                return view('objetivos.detalleODS', compact('objetivo'));

            case 'PND':
                return view('objetivos.detallePND', compact('objetivo'));

            case 'OEI':
                return view('objetivos.detalleOEI', compact('objetivo'));

            default:
                abort(404);

        }
    }

    // Editar ODS
    public function edit($id)
    {
        $objetivo = Objetivo::with(['entidad', 'plan'])
            ->findOrFail($id);

        switch ($objetivo->tipo) {

            case 'ODS':
                return view('objetivos.editarODS', compact('objetivo'));

            case 'PND':
                return view('objetivos.editarPND', compact('objetivo'));

            case 'OEI':

                return view('objetivos.editarOEI', [

                    'objetivo'   => $objetivo,

                    'entidades' => Entidad::where('estado', 'Activo')
                        ->orderBy('nombre')
                        ->get(),

                    'planes' => Plan::where('estado', 'Activo')
                        ->orderBy('nombre')
                        ->get(),

                ]);

            default:
                abort(404);

        }
    }

    // Actualizar objetivo
    public function update(Request $request, $id)
    {
        $objetivo = Objetivo::findOrFail($id);

        $request->validate([

            'tipo' => 'required|in:ODS,PND,OEI',
            'codigo' => 'required|max:30|unique:objetivos,codigo,' . $objetivo->id,
            'eje' => 'nullable|max:100',
            'nombre' => 'required|max:255',
            'descripcion' => 'nullable',
            'entidad_id' => 'nullable|exists:entidades,id',
            'plan_id' => 'nullable|exists:planes,id',
            'fecha_inicio' => 'nullable|date',
            'fecha_fin' => 'nullable|date|after_or_equal:fecha_inicio',

        ]);

        $objetivo->update([

            'tipo' => $request->tipo,

            'eje' => $request->eje,

            'codigo' => $request->codigo,

            'nombre' => $request->nombre,

            'descripcion' => $request->descripcion,

            'entidad_id' => $request->input('entidad_id'),

            'plan_id' => $request->input('plan_id'),

            'fecha_inicio' => $request->input('fecha_inicio'),

            'fecha_fin' => $request->input('fecha_fin'),

        ]);

        return redirect()
            ->route('objetivos.detalle', $objetivo->id)
            ->with('success', 'Objetivo actualizado correctamente.');
    }

    // Formulario para editar estado
    public function editarEstado($id)
    {
        $objetivo = Objetivo::findOrFail($id);

        switch ($objetivo->tipo) {

            case 'ODS':
                return view('objetivos.editarEstadoODS', compact('objetivo'));

            case 'PND':
                return view('objetivos.editarEstadoPND', compact('objetivo'));

            case 'OEI':
                return view('objetivos.editarEstadoOEI', compact('objetivo'));

            default:
                abort(404);

        }
    }

    // Actualizar estado
    public function actualizarEstado(Request $request, $id)
    {
        $objetivo = Objetivo::findOrFail($id);

        $objetivo->estado = $request->has('estado')
            ? 'Activo'
            : 'Inactivo';

        $objetivo->save();

        return redirect()
            ->route('objetivos.detalle', $objetivo->id)
            ->with('success', 'Estado actualizado correctamente.');
    }

}