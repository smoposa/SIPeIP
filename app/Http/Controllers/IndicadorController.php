<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Indicador;
use App\Models\Meta;

class IndicadorController extends Controller
{
    /**
     * Listado de indicadores de una meta.
     */
    public function index($meta)
    {
        $meta = Meta::findOrFail($meta);

        $indicadores = Indicador::where('meta_id', $meta->id)
            ->orderBy('codigo')
            ->get();

        return view('indicadores.index', compact(
            'meta',
            'indicadores'
        ));
    }

    /**
     * Formulario de nuevo indicador.
     */
    public function create($meta)
    {
        $meta = Meta::findOrFail($meta);

        return view('indicadores.create', compact('meta'));
    }

    /**
     * Guardar indicador.
     */
    public function store(Request $request, $meta)
    {
        $request->validate([

            'codigo' => 'required|max:30|unique:indicadores,codigo',

            'nombre' => 'required|max:255',

            'descripcion' => 'nullable',

            'formula' => 'nullable|max:255',

            'linea_base' => 'nullable|numeric',

            'meta' => 'nullable|numeric',

            'valor_actual' => 'nullable|numeric',

            'unidad_medida' => 'nullable|max:100',

            'frecuencia' => 'nullable|max:50',

            'estado' => 'required|in:Activo,Inactivo',

        ]);

        Indicador::create([

            'meta_id' => $meta,

            'codigo' => $request->codigo,

            'nombre' => $request->nombre,

            'descripcion' => $request->descripcion,

            'formula' => $request->formula,

            'linea_base' => $request->linea_base,

            'meta' => $request->meta,

            'valor_actual' => $request->valor_actual,

            'unidad_medida' => $request->unidad_medida,

            'frecuencia' => $request->frecuencia,

            'estado' => $request->estado,

        ]);

        return redirect()
            ->route('indicadores.index', $meta)
            ->with('success', 'Indicador registrado correctamente.');
    }

    /**
     * Detalle del indicador.
     */
    public function detalle($id)
    {
        $indicador = Indicador::with('meta')->findOrFail($id);

        return view('indicadores.detalle', compact('indicador'));
    }

    /**
     * Editar indicador.
     */
    public function edit($id)
    {
        $indicador = Indicador::findOrFail($id);

        return view('indicadores.editar', compact('indicador'));
    }


    // Actualizar indicador.
    public function update(Request $request, $id)
    {
        $indicador = Indicador::findOrFail($id);

        $request->validate([

            'codigo' => 'required|max:30|unique:indicadores,codigo,' . $indicador->id,

            'nombre' => 'required|max:255',

            'descripcion' => 'nullable',

            'formula' => 'nullable|max:255',

            'linea_base' => 'nullable|numeric',

            'meta' => 'nullable|numeric',

            'valor_actual' => 'nullable|numeric',

            'unidad_medida' => 'nullable|max:100',

            'frecuencia' => 'nullable|max:50',

            'estado' => 'required|in:Activo,Inactivo',

        ]);

        $indicador->update([

            'codigo' => $request->codigo,

            'nombre' => $request->nombre,

            'descripcion' => $request->descripcion,

            'formula' => $request->formula,

            'linea_base' => $request->linea_base,

            'meta' => $request->meta,

            'valor_actual' => $request->valor_actual,

            'unidad_medida' => $request->unidad_medida,

            'frecuencia' => $request->frecuencia,

            'estado' => $request->estado,

        ]);

        return redirect()
            ->route('indicadores.detalle', $indicador->id)
            ->with('success', 'Indicador actualizado correctamente.');
    }
}