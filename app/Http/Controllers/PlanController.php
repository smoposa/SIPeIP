<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Plan;

class PlanController extends Controller
{
    public function index()
    {
        $totalPlanes = Plan::count();

        $planesActivos = Plan::where('estado', 'Activo')->count();

        $planesInactivos = Plan::where('estado', 'Inactivo')->count();

        return view('planes.index', compact(
            'totalPlanes',
            'planesActivos',
            'planesInactivos'
        ));
    }

    public function create()
    {
        return view('planes.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'codigo' => 'required|max:50|unique:planes,codigo',
            'nombre' => 'required|max:200',
            'tipo' => 'required',
            'fecha_inicio' => 'required|date',
            'fecha_fin' => 'required|date|after_or_equal:fecha_inicio',
            'descripcion' => 'nullable',
        ]);

        Plan::create([

            'codigo' => $request->codigo,

            'nombre' => $request->nombre,

            'tipo' => $request->tipo,

            'fecha_inicio' => $request->fecha_inicio,

            'fecha_fin' => $request->fecha_fin,

            'descripcion' => $request->descripcion,

            'estado' => $request->has('estado')
                            ? 'Activo'
                            : 'Inactivo',

        ]);

        return redirect()
                ->route('planes.listar')
                ->with('success','Plan registrado correctamente.');
    }

    public function listar()
    {
        $planes = Plan::orderBy('id','desc')->paginate(10);

        return view('planes.listar', compact('planes'));
    }

    public function detalle($id)
    {
        $plan = Plan::findOrFail($id);

        return view('planes.detalle', compact('plan'));
    }

    public function edit($id)
    {
        $plan = Plan::findOrFail($id);

        return view('planes.edit', compact('plan'));
    }

    public function update(Request $request, $id)
    {
        $plan = Plan::findOrFail($id);

        $request->validate([

            'codigo' => 'required|max:50|unique:planes,codigo,' . $plan->id,

            'nombre' => 'required|max:200',

            'tipo' => 'required',

            'fecha_inicio' => 'required|date',

            'fecha_fin' => 'required|date|after_or_equal:fecha_inicio',

            'descripcion' => 'nullable',

        ]);

        $plan->update([

            'codigo' => $request->codigo,

            'nombre' => $request->nombre,

            'tipo' => $request->tipo,

            'fecha_inicio' => $request->fecha_inicio,

            'fecha_fin' => $request->fecha_fin,

            'descripcion' => $request->descripcion,

            'estado' => $request->has('estado')
                            ? 'Activo'
                            : 'Inactivo',

        ]);

        return redirect()
                ->route('planes.detalle', $plan->id)
                ->with('success', 'Plan actualizado correctamente.');
    }

    public function destroy($id)
    {
        $plan = Plan::findOrFail($id);

        $plan->delete();

        return redirect()
                ->route('planes.listar')
                ->with('success', 'Plan eliminado correctamente.');
    }

}