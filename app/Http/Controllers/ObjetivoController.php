<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Objetivo;
use App\Models\Plan;
use App\Models\Pnd;
use App\Models\Ods;
use App\Models\PndPolitica;
use App\Models\OdsMeta;

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

    // Listado de objetivos.
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

    //Formulario para crear un objetivo.
    public function create()
    {
        // Generar código automático
        $ultimoObjetivo = Objetivo::orderByDesc('id')->first();

        if ($ultimoObjetivo) {

            $partes = explode('-', $ultimoObjetivo->codigo);

            $ultimoNumero = (int) end($partes);

            $nuevoNumero = str_pad($ultimoNumero + 1, 2, '0', STR_PAD_LEFT);

        } else {

            $nuevoNumero = '01';

        }

        $codigo = 'OEI-' . $nuevoNumero;

        // Plan seleccionado desde el asistente (si existe)
        $planSeleccionado = null;

        if (session()->has('plan_id')) {

            $planSeleccionado = Plan::find(session('plan_id'));

        }

        return view('objetivos.create', [

            'codigo' => $codigo,

            'planSeleccionado' => $planSeleccionado,

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

    //obtener politicas ublicas 
    public function obtenerPoliticas($pnd)
    {
        $politicas = PndPolitica::where('pnd_id', $pnd)
            ->where('estado', 'Activo')
            ->orderBy('codigo')
            ->get([
                'id',
                'codigo',
                'nombre'
            ]);

        return response()->json($politicas);
    }

    //obtener metas
    public function obtenerMetasOds($ods)
    {
        $metas = OdsMeta::where('ods_id', $ods)
            ->where('estado', 'Activo')
            ->orderBy('codigo')
            ->get([
                'id',
                'codigo',
                'nombre'
            ]);

        return response()->json($metas);
    }

    // Guardar objetivo.
    public function store(Request $request)
    {
        $request->validate([

            'plan_id' => 'required|exists:planes,id',

            'pnd_id' => 'required|exists:pnd,id',

            'ods_id' => 'required|exists:ods,id',

            'nombre' => 'required|max:255',

            'descripcion' => 'nullable',

        ]);

        // Generar código automático
        $ultimoObjetivo = Objetivo::orderByDesc('id')->first();

        $numero = 1;

        if ($ultimoObjetivo) {

            $numero = (int) substr($ultimoObjetivo->codigo, 4) + 1;

        }

        $codigo = 'OEI-' . str_pad($numero, 2, '0', STR_PAD_LEFT);

        // Registrar objetivo
        $objetivo = Objetivo::create([

            'plan_id' => $request->plan_id,

            'pnd_id' => $request->pnd_id,

            'ods_id' => $request->ods_id,

            'codigo' => $codigo,

            'nombre' => $request->nombre,

            'descripcion' => $request->descripcion,

            'estado' => 'Activo',

            'usuario_id' => auth()->id(),

        ]);

        // Mantener el contexto del asistente
        session([
            'plan_id'     => $objetivo->plan_id,
            'objetivo_id' => $objetivo->id,
        ]);

        // Mostrar el modal para continuar con Metas
        return redirect()
            ->route('objetivos.create')
            ->with('objetivo_registrado', true);

    }


    //Detalle del objetivo.
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

    // Formulario para editar.
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

    //Actualizar objetivo.
    public function update(Request $request, $id)
    {
        $objetivo = Objetivo::findOrFail($id);

        $request->validate([

            'plan_id' => 'required|exists:planes,id',

            'pnd_id' => 'required|exists:pnd,id',

            'ods_id' => 'required|exists:ods,id',

            'nombre' => 'required|max:255',

            'descripcion' => 'nullable',

        ]);

        $objetivo->update([

            'plan_id' => $request->plan_id,

            'pnd_id' => $request->pnd_id,

            'ods_id' => $request->ods_id,

            'nombre' => $request->nombre,

            'descripcion' => $request->descripcion,

        ]);

        return redirect()
            ->route('objetivos.detalle', $objetivo->id)
            ->with('success', 'Objetivo actualizado correctamente.');
    }

    //Formulario para editar estado.
    public function editarEstado($id)
    {
        $objetivo = Objetivo::findOrFail($id);

        return view('objetivos.editarestado', compact('objetivo'));
    }

    //Actualizar estado.
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