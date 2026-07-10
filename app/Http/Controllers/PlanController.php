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
        $entidad = auth()->user()->entidad;

        // Buscar el último plan de la entidad
        $ultimoPlan = Plan::where('entidad_id', $entidad->id)
            ->orderByDesc('id')
            ->first();

        if ($ultimoPlan) {

            $partes = explode('-', $ultimoPlan->codigo);

            $ultimoNumero = (int) end($partes);

            $nuevoNumero = str_pad($ultimoNumero + 1, 3, '0', STR_PAD_LEFT);

        } else {

            $nuevoNumero = '001';

        }

        $codigo = 'PEI-' . $entidad->siglas . '-' . $nuevoNumero;

        return view('planes.create', compact('codigo'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'nombre' => 'required|max:255',
            'periodo_inicio' => 'required|integer',
            'periodo_fin' => 'required|integer|gte:periodo_inicio',
            'descripcion' => 'nullable|max:1000',
        ]);

        // Entidad del usuario autenticado
        $entidad = auth()->user()->entidad;

        // Buscar el último plan de la entidad
        $ultimoPlan = Plan::where('entidad_id', $entidad->id)
            ->orderByDesc('id')
            ->first();

        if ($ultimoPlan) {

            $partes = explode('-', $ultimoPlan->codigo);

            $ultimoNumero = (int) end($partes);

            $nuevoNumero = str_pad($ultimoNumero + 1, 3, '0', STR_PAD_LEFT);

        } else {

            $nuevoNumero = '001';

        }

        // Código automático
        $codigo = 'PEI-' . $entidad->siglas . '-' . $nuevoNumero;

        Plan::create([

            'codigo' => $codigo,

            'nombre' => $request->nombre,

            'entidad_id' => $entidad->id,

            'tipo' => 'Plan Estratégico Institucional',

            'periodo_inicio' => $request->periodo_inicio,

            'periodo_fin' => $request->periodo_fin,

            'descripcion' => $request->descripcion,

            'estado' => 'Activo',

            'usuario_id' => auth()->id(),

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