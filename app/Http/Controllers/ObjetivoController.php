<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Objetivo;
use App\Models\Plan;
use App\Models\Pnd;
use App\Models\Ods;

class ObjetivoController extends Controller
{
    /**
     * Página principal del módulo.
     */
    public function index()
    {
        $totalObjetivos = Objetivo::count();

        $objetivosActivos = Objetivo::where('estado', 'Activo')->count();

        $objetivosInactivos = Objetivo::where('estado', 'Inactivo')->count();

        return view('objetivos.index', compact(
            'totalObjetivos',
            'objetivosActivos',
            'objetivosInactivos'
        ));
    }

    /**
     * Listado de objetivos.
     */
    public function listar()
    {
        $objetivos = Objetivo::with([
                'plan',
                'pnd',
                'ods'
            ])
            ->orderBy('id', 'desc')
            ->paginate(10);

        return view('objetivos.listar', compact('objetivos'));
    }

    /**
     * Formulario para crear un objetivo.
     */
    public function create()
    {
        return view('objetivos.create', [

            'planes' => Plan::where('estado', 'Activo')
                ->orderBy('nombre')
                ->get(),

            'pnd' => Pnd::where('estado', 'Activo')
                ->orderBy('codigo')
                ->get(),

            'ods' => Ods::where('estado', 'Activo')
                ->orderBy('codigo')
                ->get(),

        ]);
    }

    /**
     * Guardar objetivo.
     */
    public function store(Request $request)
    {
        $request->validate([

            'plan_id' => 'required|exists:planes,id',

            'pnd_id' => 'required|exists:pnd,id',

            'ods_id' => 'required|exists:ods,id',

            'codigo' => 'required|max:30|unique:objetivos,codigo',

            'nombre' => 'required|max:255',

            'descripcion' => 'nullable',

        ]);

        Objetivo::create([

            'plan_id' => $request->plan_id,

            'pnd_id' => $request->pnd_id,

            'ods_id' => $request->ods_id,

            'codigo' => $request->codigo,

            'nombre' => $request->nombre,

            'descripcion' => $request->descripcion,

            'estado' => 'Activo',

            'usuario_id' => auth()->id(),

        ]);

        return redirect()
            ->route('objetivos.listar')
            ->with('success', 'Objetivo registrado correctamente.');
    }

    /**
     * Detalle del objetivo.
     */
    public function detalle($id)
    {
        $objetivo = Objetivo::with([
                'plan',
                'pnd',
                'ods',
                'usuario'
            ])
            ->findOrFail($id);

        return view('objetivos.detalle', compact('objetivo'));
    }

    /**
     * Formulario para editar.
     */
    public function edit($id)
    {
        $objetivo = Objetivo::findOrFail($id);

        return view('objetivos.edit', [

            'objetivo' => $objetivo,

            'planes' => Plan::where('estado', 'Activo')
                ->orderBy('nombre')
                ->get(),

            'pnd' => Pnd::where('estado', 'Activo')
                ->orderBy('codigo')
                ->get(),

            'ods' => Ods::where('estado', 'Activo')
                ->orderBy('codigo')
                ->get(),

        ]);
    }

    /**
     * Actualizar objetivo.
     */
    public function update(Request $request, $id)
    {
        $objetivo = Objetivo::findOrFail($id);

        $request->validate([

            'plan_id' => 'required|exists:planes,id',

            'pnd_id' => 'required|exists:pnd,id',

            'ods_id' => 'required|exists:ods,id',

            'codigo' => 'required|max:30|unique:objetivos,codigo,' . $objetivo->id,

            'nombre' => 'required|max:255',

            'descripcion' => 'nullable',

        ]);

        $objetivo->update([

            'plan_id' => $request->plan_id,

            'pnd_id' => $request->pnd_id,

            'ods_id' => $request->ods_id,

            'codigo' => $request->codigo,

            'nombre' => $request->nombre,

            'descripcion' => $request->descripcion,

        ]);

        return redirect()
            ->route('objetivos.detalle', $objetivo->id)
            ->with('success', 'Objetivo actualizado correctamente.');
    }

    /**
     * Formulario para editar estado.
     */
    public function editarEstado($id)
    {
        $objetivo = Objetivo::findOrFail($id);

        return view('objetivos.editarestado', compact('objetivo'));
    }

    /**
     * Actualizar estado.
     */
    public function actualizarEstado(Request $request, $id)
    {
        $objetivo = Objetivo::findOrFail($id);

        $objetivo->estado = $request->has('estado')
            ? 'Activo'
            : 'Inactivo';

        $objetivo->save();

        return redirect()
            ->route('objetivos.detalle', $objetivo->id)
            ->with('success', 'Estado del objetivo actualizado correctamente.');
    }
}