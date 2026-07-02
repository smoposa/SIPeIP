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
            'nombre'          => 'required|max:255',
            'descripcion'     => 'nullable',
            'periodo_inicio'  => 'required|integer',
            'periodo_fin'     => 'required|integer|gte:periodo_inicio',
            'fecha_inicio'    => 'required|date',
            'fecha_fin'       => 'required|date|after_or_equal:fecha_inicio',
        ]);

        // Generar código automático
        $anio = $request->periodo_inicio;

        $ultimoPlan = Plan::where('periodo_inicio', $anio)
            ->where('codigo', 'like', "PEI-{$anio}-%")
            ->orderByDesc('codigo')
            ->first();
            
        if ($ultimoPlan) {

            $ultimoNumero = (int) substr($ultimoPlan->codigo, -3);

            $nuevoNumero = str_pad($ultimoNumero + 1, 3, '0', STR_PAD_LEFT);

        } else {

            $nuevoNumero = '001';

        }

        $codigo = "PEI-{$anio}-{$nuevoNumero}";

        Plan::create([

            'codigo'          => $codigo,

            'nombre'          => $request->nombre,

            'descripcion'     => $request->descripcion,

            'periodo_inicio'  => $request->periodo_inicio,

            'periodo_fin'     => $request->periodo_fin,

            'fecha_inicio'    => $request->fecha_inicio,

            'fecha_fin'       => $request->fecha_fin,

            'estado'          => 'Activo',

            // Cuando implementemos entidades:
            // 'entidad_id' => auth()->user()->entidad_id,

        ]);

        return redirect()
            ->route('planes.listar')
            ->with('success', 'Plan registrado correctamente.');
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

            'nombre' => 'required|max:255',

            'descripcion' => 'nullable',

            'periodo_inicio' => 'required|integer',

            'periodo_fin' => 'required|integer|gte:periodo_inicio',

            'fecha_inicio' => 'required|date',

            'fecha_fin' => 'required|date|after_or_equal:fecha_inicio',

        ]);

        $plan->update([

            'codigo' => $request->codigo,

            'nombre' => $request->nombre,

            'descripcion' => $request->descripcion,

            'periodo_inicio' => $request->periodo_inicio,

            'periodo_fin' => $request->periodo_fin,

            'fecha_inicio' => $request->fecha_inicio,

            'fecha_fin' => $request->fecha_fin,

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

        public function editarEstado($id)
    {
        $plan = Plan::findOrFail($id);

        return view('planes.editarestado', compact('plan'));
    }

    public function actualizarEstado(Request $request, $id)
    {
        $plan = Plan::findOrFail($id);

        $plan->estado = $request->has('estado')
                        ? 'Activo'
                        : 'Inactivo';

        $plan->save();

        return redirect()
                ->route('planes.detalle', $plan->id)
                ->with('success', 'Estado del plan actualizado correctamente.');
    }

}