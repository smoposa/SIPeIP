<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProgramaRequest;
use App\Models\Programa;
use App\Models\Objetivo;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class ProgramaController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Dashboard
    |--------------------------------------------------------------------------
    */

    /*
    |--------------------------------------------------------------------------
    | Listado
    |--------------------------------------------------------------------------
    */

    // Listado de programas.
    public function listar()
    {
        $programas = Programa::with([
                'responsable',
                'usuario',
                'objetivos'
            ])
            ->orderBy('id', 'desc')
            ->paginate(10);

        return view('programas.listar', compact('programas'));
    }
    
    /*
    |--------------------------------------------------------------------------
    | Crear Programa
    |--------------------------------------------------------------------------
    */

    // Formulario para crear un programa.
    public function create()
    {
        // Generar código automático
        $ultimoPrograma = Programa::orderByDesc('id')->first();

        if ($ultimoPrograma) {

            $partes = explode('-', $ultimoPrograma->codigo);

            $ultimoNumero = (int) end($partes);

            $nuevoNumero = str_pad($ultimoNumero + 1, 2, '0', STR_PAD_LEFT);

        } else {

            $nuevoNumero = '01';

        }

        $codigo = 'PROG-' . $nuevoNumero;

        // Responsables (Directores de Inversión Pública)
        $responsables = User::where('estado', 'Activo')
            ->whereHas('rol', function ($query) {
                $query->where('nombre', 'Director de Inversión Pública');
            })
            ->orderBy('nombres')
            ->get();

        // Objetivos disponibles
        $objetivos = Objetivo::where('estado', 'Activo')
            ->orderBy('codigo')
            ->get();

        return view('programas.create', compact(
            'codigo',
            'responsables',
            'objetivos'
        ));
    }

    /*
    |--------------------------------------------------------------------------
    | Guardar Programa
    |--------------------------------------------------------------------------
    */


    // Registrar programa.
    public function store(ProgramaRequest $request)
    {
        DB::beginTransaction();

        try {

            // Generar código automático
            $ultimoPrograma = Programa::orderByDesc('id')->first();

            if ($ultimoPrograma) {

                $partes = explode('-', $ultimoPrograma->codigo);

                $ultimoNumero = (int) end($partes);

                $nuevoNumero = str_pad($ultimoNumero + 1, 2, '0', STR_PAD_LEFT);

            } else {

                $nuevoNumero = '01';

            }

            $codigo = 'PROG-' . $nuevoNumero;

            // Crear programa
            $programa = Programa::create([

                'codigo'           => $codigo,

                'nombre'           => $request->nombre,

                'descripcion'      => $request->descripcion,

                'periodo_inicio'   => $request->periodo_inicio,

                'periodo_fin'      => $request->periodo_fin,

                'responsable_id'   => $request->responsable_id,

                'estado'           => $request->estado,

                'usuario_id'       => Auth::id(),

            ]);

            // Asociar Objetivos Estratégicos
            $programa->objetivos()->sync(
                $request->objetivos
            );

            DB::commit();

            return redirect()
                ->route('programas.create')
                ->with('programa_registrado', $programa->id);

        } catch (\Exception $e) {

            DB::rollBack();

            return back()
                ->withInput()
                ->withErrors([
                    'error' => $e->getMessage()
                ]);

        }
    }
        /*
    |--------------------------------------------------------------------------
    | Detalle
    |--------------------------------------------------------------------------
    */

    // Mostrar detalle del programa.
    public function detalle($id)
    {
        $programa = Programa::with([
            'responsable',
            'usuario',
            'objetivos.metas.indicadores'
        ])->findOrFail($id);

        return view('programas.detalle', compact('programa'));
    }

    /*
    |--------------------------------------------------------------------------
    | Editar
    |--------------------------------------------------------------------------
    */

    // Formulario de edición.
    public function edit($id)
    {
        $programa = Programa::with('objetivos')
            ->findOrFail($id);

        $responsables = User::where('estado', 'Activo')
            ->whereHas('rol', function ($query) {
                $query->where('nombre', 'Director de Inversión Pública');
            })
            ->orderBy('nombres')
            ->get();

        $objetivos = Objetivo::where('estado', 'Activo')
            ->orderBy('codigo')
            ->get();

        return view('programas.edit', compact(
            'programa',
            'responsables',
            'objetivos'
        ));
    }

    /*
    |--------------------------------------------------------------------------
    | Actualizar
    |--------------------------------------------------------------------------
    */

    // Actualizar programa.
    public function update(ProgramaRequest $request, $id)
    {
        DB::beginTransaction();

        try {

            $programa = Programa::findOrFail($id);

            $programa->update([

                'nombre'          => $request->nombre,

                'descripcion'     => $request->descripcion,

                'periodo_inicio'  => $request->periodo_inicio,

                'periodo_fin'     => $request->periodo_fin,

                'responsable_id'  => $request->responsable_id,

                'estado'          => $request->estado,

            ]);

            // Actualizar objetivos asociados
            $programa->objetivos()->sync(
                $request->objetivos
            );

            DB::commit();

            return redirect()
                ->route('programas.listar')
                ->with('success', 'Programa actualizado correctamente.');

        } catch (\Exception $e) {

            DB::rollBack();

            return back()
                ->withInput()
                ->withErrors([
                    'error' => $e->getMessage()
                ]);

        }
    }

        /*
    |--------------------------------------------------------------------------
    | Estado
    |--------------------------------------------------------------------------
    */

    // Cambiar estado del programa.
    public function editarEstado($id)
    {
        $programa = Programa::findOrFail($id);

        $programa->estado = $programa->estado === 'Activo'
            ? 'Inactivo'
            : 'Activo';

        $programa->save();

        return redirect()
            ->route('programas.listar')
            ->with(
                'success',
                'Estado del programa actualizado correctamente.'
            );
    }
}

