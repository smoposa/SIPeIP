<?php

namespace App\Http\Controllers;

use App\Models\Objetivo;
use Illuminate\Http\Request;

class ObjetivoController extends Controller
{
    public function index()
    {
        return view('objetivos.index');
    }

    public function listar()
    {
        $objetivos = Objetivo::orderBy('codigo')->paginate(10);

        return view('objetivos.listar', compact('objetivos'));
    }

    public function create()
    {
        $objetivosPadre = Objetivo::orderBy('codigo')->get();

        $ultimoODS = Objetivo::where('tipo', 'ODS')
            ->orderByDesc('id')
            ->first();

        $numero = $ultimoODS
            ? (int) substr($ultimoODS->codigo, 4) + 1
            : 1;

        $codigo = 'ODS-' . str_pad($numero, 2, '0', STR_PAD_LEFT);

        return view(
            'objetivos.create',
            compact('objetivosPadre', 'codigo')
        );
    }

    public function store(Request $request)
    {
        $request->validate([

            'tipo' => 'required|in:ODS,PND,OEI',

            'codigo' => 'nullable',

            'nombre' => 'required|max:255',

            'descripcion' => 'nullable',

            'color' => 'nullable|max:20',

            'icono' => 'nullable|max:100',

            'numero_metas' => 'nullable|integer|min:0',

            'documento' => 'nullable|file|mimes:pdf|max:10240',

            'estado' => 'required|in:Activo,Inactivo',

            'objetivo_padre_id' => 'nullable|exists:objetivos,id',

        ]);

        $datos = $request->all();

        // Generar código automáticamente
        $ultimoODS = Objetivo::where('tipo', 'ODS')
            ->orderByDesc('id')
            ->first();

        $numero = $ultimoODS
            ? (int) substr($ultimoODS->codigo, 4) + 1
            : 1;

        $datos['codigo'] = 'ODS-' . str_pad($numero, 2, '0', STR_PAD_LEFT);

        if ($request->hasFile('documento')) {

            $datos['documento'] = $request
                ->file('documento')
                ->store('objetivos', 'public');

        }

        Objetivo::create($datos);

        return redirect()
            ->route('objetivos.listar')
            ->with('success', 'Objetivo registrado correctamente.');
    }

    public function detalle($id)
    {
        $objetivo = Objetivo::findOrFail($id);

        return view('objetivos.detalle', compact('objetivo'));
    }

    public function edit($id)
    {
        $objetivo = Objetivo::findOrFail($id);

        $objetivosPadre = Objetivo::where('id', '!=', $id)
            ->orderBy('codigo')
            ->get();

        return view(
            'objetivos.editar',
            compact('objetivo', 'objetivosPadre')
        );
    }

    public function update(Request $request, $id)
    {
        $objetivo = Objetivo::findOrFail($id);

        $request->validate([

            'tipo' => 'required|in:ODS,PND,OEI',

            'codigo' => 'required|max:20|unique:objetivos,codigo,' . $id,

            'nombre' => 'required|max:255',

            'descripcion' => 'nullable',

            'color' => 'nullable|max:20',

            'icono' => 'nullable|max:100',

            'numero_metas' => 'nullable|integer|min:0',

            'documento' => 'nullable|file|mimes:pdf|max:10240',

            'estado' => 'required|in:Activo,Inactivo',

            'objetivo_padre_id' => 'nullable|exists:objetivos,id',

        ]);

        $datos = $request->all();

        if ($request->hasFile('documento')) {

            $datos['documento'] = $request
                ->file('documento')
                ->store('objetivos', 'public');

        }

        $objetivo->update($datos);

        return redirect()
            ->route('objetivos.detalle', $objetivo->id)
            ->with('success', 'Objetivo actualizado correctamente.');
    }
}