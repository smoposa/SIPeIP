<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProyectoRequest;
use App\Models\Programa;
use App\Models\Proyecto;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class ProyectoController extends Controller
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

    // Listado de proyectos.
    public function listar()
    {
        $proyectos = Proyecto::with([
                'programa',
                'responsable',
                'usuario'
            ])
            ->orderBy('id', 'desc')
            ->paginate(10);

        return view('proyectos.listar', compact('proyectos'));
    }

    /*
    |--------------------------------------------------------------------------
    | Crear Proyecto
    |--------------------------------------------------------------------------
    */

    // Formulario para crear un proyecto.
    public function create()
    {
        // Generar código automático
        $ultimoProyecto = Proyecto::orderByDesc('id')->first();

        if ($ultimoProyecto) {

            $partes = explode('-', $ultimoProyecto->codigo);

            $ultimoNumero = (int) end($partes);

            $nuevoNumero = str_pad($ultimoNumero + 1, 2, '0', STR_PAD_LEFT);

        } else {

            $nuevoNumero = '01';

        }

        $codigo = 'PRY-' . $nuevoNumero;

        // Programas disponibles
        $programas = Programa::where('estado', 'Activo')
            ->orderBy('codigo')
            ->get();

        // Responsables (Directores de Inversión Pública)
        $responsables = User::where('estado', 'Activo')
            ->whereHas('rol', function ($query) {

                $query->where(
                    'nombre',
                    'Director de Inversión Pública'
                );

            })
            ->orderBy('nombres')
            ->get();

        return view('proyectos.create', compact(
            'codigo',
            'programas',
            'responsables'
        ));
    }

    /*
    |--------------------------------------------------------------------------
    | Guardar Proyecto
    |--------------------------------------------------------------------------
    */
        // Registrar proyecto.
    public function store(ProyectoRequest $request)
    {
        DB::beginTransaction();

        try {

            // Generar código automático
            $ultimoProyecto = Proyecto::orderByDesc('id')->first();

            if ($ultimoProyecto) {

                $partes = explode('-', $ultimoProyecto->codigo);

                $ultimoNumero = (int) end($partes);

                $nuevoNumero = str_pad($ultimoNumero + 1, 2, '0', STR_PAD_LEFT);

            } else {

                $nuevoNumero = '01';

            }

            $codigo = 'PRY-' . $nuevoNumero;

            // Crear proyecto
            $proyecto = Proyecto::create([

                'programa_id'            => $request->programa_id,

                'codigo'                 => $codigo,

                'nombre'                 => $request->nombre,

                'descripcion'            => $request->descripcion,

                'fecha_inicio'           => $request->fecha_inicio,

                'fecha_fin'              => $request->fecha_fin,

                'presupuesto_aprobado'   => $request->presupuesto_aprobado,

                'responsable_id'         => $request->responsable_id,

                'estado'                 => $request->estado,

                'usuario_id'             => Auth::id(),

            ]);

            DB::commit();

            return redirect()
                ->route('proyectos.create')
                ->with('proyecto_registrado', $proyecto->id);

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
        // Mostrar detalle del proyecto.
    public function detalle($id)
    {
        $proyecto = Proyecto::with([
            'programa',
            'responsable',
            'usuario'
        ])->findOrFail($id);

        return view('proyectos.detalle', compact('proyecto'));
    }

    /*
    |--------------------------------------------------------------------------
    | Editar
    |--------------------------------------------------------------------------
    */

    // Formulario de edición.
    public function edit($id)
    {
        $proyecto = Proyecto::findOrFail($id);

        // Programas disponibles
        $programas = Programa::where('estado', 'Activo')
            ->orderBy('codigo')
            ->get();

        // Responsables
        $responsables = User::where('estado', 'Activo')
            ->whereHas('rol', function ($query) {

                $query->where(
                    'nombre',
                    'Director de Inversión Pública'
                );

            })
            ->orderBy('nombres')
            ->get();

        return view('proyectos.edit', compact(
            'proyecto',
            'programas',
            'responsables'
        ));
    }

    /*
    |--------------------------------------------------------------------------
    | Actualizar
    |--------------------------------------------------------------------------
    */

    // Actualizar proyecto.
    public function update(ProyectoRequest $request, $id)
    {
        DB::beginTransaction();

        try {

            $proyecto = Proyecto::findOrFail($id);

            $proyecto->update([

                'programa_id'            => $request->programa_id,

                'nombre'                 => $request->nombre,

                'descripcion'            => $request->descripcion,

                'fecha_inicio'           => $request->fecha_inicio,

                'fecha_fin'              => $request->fecha_fin,

                'presupuesto_aprobado'   => $request->presupuesto_aprobado,

                'responsable_id'         => $request->responsable_id,

                'estado'                 => $request->estado,

            ]);

            DB::commit();

            return redirect()
                ->route('proyectos.listar')
                ->with(
                    'success',
                    'Proyecto actualizado correctamente.'
                );

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

    // Cambiar estado del proyecto.
    public function editarEstado($id)
    {
        $proyecto = Proyecto::findOrFail($id);

        switch ($proyecto->estado) {

            case 'Planificado':
                $proyecto->estado = 'En ejecución';
                break;

            case 'En ejecución':
                $proyecto->estado = 'Finalizado';
                break;

            case 'Finalizado':
                $proyecto->estado = 'Suspendido';
                break;

            default:
                $proyecto->estado = 'Planificado';
                break;

        }

        $proyecto->save();

        return redirect()
            ->route('proyectos.listar')
            ->with(
                'success',
                'Estado del proyecto actualizado correctamente.'
            );
    }
}