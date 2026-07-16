<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Meta;
use App\Models\Objetivo;
use App\Models\User;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class MetaController extends Controller
{
    /**
     * Página principal del módulo.
     */
    public function index()
    {
        return view('metas.index');
    }

    // Listado de metas.
    public function listar()
    {
        $metas = Meta::with([
                'objetivo.plan',
                'responsable'
            ])
            ->orderBy('codigo')
            ->paginate(15);

        return view('metas.listar', compact('metas'));
    }

    /**
     * Formulario de creación.
     */
    public function create()
    {
        $objetivos = Objetivo::with('plan')
            ->where('estado', 'Activo')
            ->orderBy('codigo')
            ->get();

        // Solo usuarios activos de la misma entidad
        $responsables = User::where('entidad_id', auth()->user()->entidad_id)
            ->where('estado', 'Activo')
            ->orderBy('nombres')
            ->get();

        // Código automático
        $codigo = 'META-' . str_pad((Meta::max('id') ?? 0) + 1, 2, '0', STR_PAD_LEFT);

        return view('metas.create', compact(
            'objetivos',
            'responsables',
            'codigo'
        ));
    }

    /**
     * Guardar una nueva meta.
     */
    public function store(Request $request)
    {
        $request->validate([
            'objetivo_id'     => 'required|exists:objetivos,id',
            'nombre'          => 'required|string|max:255',
            'descripcion'     => 'nullable|string',
            'linea_base'      => 'required|numeric|min:0',
            'valor_meta'      => 'required|numeric|min:0',
            'unidad_medida'   => 'required|string|max:50',
            'periodo_inicio'  => 'required|digits:4',
            'periodo_fin'     => 'required|digits:4|gte:periodo_inicio',
            'responsable_id'  => 'required|exists:users,id',
            'estado'          => 'required|in:Activo,Inactivo',
        ]);

        DB::beginTransaction();

        try {

            // Generar código automático
            $ultimo = Meta::max('id') + 1;

            $codigo = 'META-' . str_pad($ultimo, 2, '0', STR_PAD_LEFT);

            Meta::create([

                'objetivo_id'    => $request->objetivo_id,
                'codigo'         => $codigo,
                'nombre'         => $request->nombre,
                'descripcion'    => $request->descripcion,
                'linea_base'     => $request->linea_base,
                'valor_meta'     => $request->valor_meta,
                'unidad_medida'  => $request->unidad_medida,
                'periodo_inicio' => $request->periodo_inicio,
                'periodo_fin'    => $request->periodo_fin,
                'responsable_id' => $request->responsable_id,
                'estado'         => $request->estado,
                'usuario_id'     => Auth::id(),

            ]);

            DB::commit();

            return redirect()
                ->route('metas.listar')
                ->with('success', 'La meta fue registrada correctamente.');

        } catch (\Exception $e) {

            DB::rollBack();

            return back()
                ->withInput()
                ->withErrors([
                    'error' => $e->getMessage()
                ]);
        }
    }

    public function edit($id)
    {
        $meta = Meta::with([
            'objetivo.plan',
            'responsable'
        ])->findOrFail($id);

        $objetivos = Objetivo::with('plan')
            ->where('estado', 'Activo')
            ->orderBy('codigo')
            ->get();

        $responsables = User::where('entidad_id', auth()->user()->entidad_id)
            ->where('estado', 'Activo')
            ->orderBy('nombres')
            ->get();

        return view('metas.edit', compact(
            'meta',
            'objetivos',
            'responsables'
        ));
    }


    public function update(Request $request, $id)
    {
        $request->validate([
            'objetivo_id'     => 'required|exists:objetivos,id',
            'nombre'          => 'required|string|max:255',
            'descripcion'     => 'nullable|string',
            'linea_base'      => 'required|numeric|min:0',
            'valor_meta'      => 'required|numeric|min:0',
            'unidad_medida'   => 'required|string|max:50',
            'periodo_inicio'  => 'required|digits:4',
            'periodo_fin'     => 'required|digits:4|gte:periodo_inicio',
            'responsable_id'  => 'required|exists:users,id',
            'estado'          => 'required|in:Activo,Inactivo',
        ]);

        $meta = Meta::findOrFail($id);

        $meta->update([
            'objetivo_id'    => $request->objetivo_id,
            'nombre'         => $request->nombre,
            'descripcion'    => $request->descripcion,
            'linea_base'     => $request->linea_base,
            'valor_meta'     => $request->valor_meta,
            'unidad_medida'  => $request->unidad_medida,
            'periodo_inicio' => $request->periodo_inicio,
            'periodo_fin'    => $request->periodo_fin,
            'responsable_id' => $request->responsable_id,
            'estado'         => $request->estado,
        ]);

        return redirect()
            ->route('metas.detalle', $meta->id)
            ->with('success', 'La meta fue actualizada correctamente.');
    }


    public function cambiarEstado(Request $request, $id)
    {
        $request->validate([
            'estado' => 'required|in:Activo,Inactivo',
        ]);

        $meta = Meta::findOrFail($id);

        $meta->update([
            'estado' => $request->estado,
        ]);

        return back()->with('success', 'Estado actualizado correctamente.');
    }

    /**
     * Detalle de la meta.
     */
    public function detalle($id)
    {
        $meta = Meta::with([
            'objetivo.plan.entidad',
            'responsable',
            'usuario'
        ])->findOrFail($id);

        return view('metas.detalle', compact('meta'));
    }

}