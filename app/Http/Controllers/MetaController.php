<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Meta;
use App\Models\Objetivo;

class MetaController extends Controller
{
    // Listado de metas de un objetivo.
    public function index($objetivo)
    {
        $objetivo = Objetivo::findOrFail($objetivo);

        $metas = Meta::where('objetivo_id', $objetivo->id)
            ->orderBy('codigo')
            ->get();

        return view('metas.index', compact(
            'objetivo',
            'metas'
        ));
    }

    // Formulario de nueva meta.
    public function create($objetivo)
    {
        $objetivo = Objetivo::findOrFail($objetivo);

        return view('metas.create', compact('objetivo'));
    }

    // Guardar meta.
    public function store(Request $request, $objetivo)
    {
        $request->validate([

            'codigo' => 'required|max:30|unique:metas,codigo',

            'nombre' => 'required|max:255',

            'descripcion' => 'nullable',

            'valor_meta' => 'nullable|numeric',

            'unidad_medida' => 'nullable|max:100',

            'fecha_inicio' => 'nullable|date',

            'fecha_fin' => 'nullable|date|after_or_equal:fecha_inicio',

            'estado' => 'required|in:Activo,Inactivo',

        ]);

        Meta::create([

            'objetivo_id' => $objetivo,

            'codigo' => $request->codigo,

            'nombre' => $request->nombre,

            'descripcion' => $request->descripcion,

            'valor_meta' => $request->valor_meta,

            'unidad_medida' => $request->unidad_medida,

            'fecha_inicio' => $request->fecha_inicio,

            'fecha_fin' => $request->fecha_fin,

            'estado' => $request->estado,

        ]);

        return redirect()
            ->route('metas.index', $objetivo)
            ->with('success', 'Meta registrada correctamente.');
    }

    // Detalle de la meta.
    public function detalle($id)
    {
        $meta = Meta::with('objetivo')->findOrFail($id);

        return view('metas.detalle', compact('meta'));
    }

    // Editar meta.
    public function edit($id)
    {
        $meta = Meta::findOrFail($id);

        return view('metas.editar', compact('meta'));
    }

    // Actualizar meta.
    public function update(Request $request, $id)
    {
        $meta = Meta::findOrFail($id);

        $request->validate([

            'codigo' => 'required|max:30|unique:metas,codigo,' . $meta->id,

            'nombre' => 'required|max:255',

            'descripcion' => 'nullable',

            'valor_meta' => 'nullable|numeric',

            'unidad_medida' => 'nullable|max:100',

            'fecha_inicio' => 'nullable|date',

            'fecha_fin' => 'nullable|date|after_or_equal:fecha_inicio',

            'estado' => 'required|in:Activo,Inactivo',

        ]);

        $meta->update([

            'codigo' => $request->codigo,

            'nombre' => $request->nombre,

            'descripcion' => $request->descripcion,

            'valor_meta' => $request->valor_meta,

            'unidad_medida' => $request->unidad_medida,

            'fecha_inicio' => $request->fecha_inicio,

            'fecha_fin' => $request->fecha_fin,

            'estado' => $request->estado,

        ]);

        return redirect()
            ->route('metas.detalle', $meta->id)
            ->with('success', 'Meta actualizada correctamente.');
    }
}