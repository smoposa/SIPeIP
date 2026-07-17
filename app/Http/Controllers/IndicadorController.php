<?php

namespace App\Http\Controllers;

use App\Models\Indicador;
use App\Models\Meta;
use App\Models\User;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;


class IndicadorController extends Controller
{
    /**
     * Página principal del módulo.
     */
    public function index()
    {
        //
    }

    /**
     * Listado de indicadores.
     */
public function listar()
{
    $indicadores = Indicador::with([
            'meta.objetivo.plan.entidad',
            'responsable'
        ])
        ->orderBy('codigo')
        ->paginate(10);

    return view('indicadores.listar', compact('indicadores'));
}

    // Formulario de creación.
    public function create()
    {
        // Generar código automático
        $ultimo = Indicador::latest('id')->first();

        $numero = $ultimo
            ? ((int) substr($ultimo->codigo, 4)) + 1
            : 1;

        $codigo = 'IND-' . str_pad($numero, 2, '0', STR_PAD_LEFT);

        // Contexto del asistente
        $planSeleccionado = null;
        $objetivoSeleccionado = null;
        $metaSeleccionada = null;

        if (session()->has('meta_id')) {

            $metaSeleccionada = Meta::with([
                    'objetivo.plan'
                ])
                ->find(session('meta_id'));

            if ($metaSeleccionada) {

                $objetivoSeleccionado = $metaSeleccionada->objetivo;

                $planSeleccionado = $objetivoSeleccionado?->plan;

            }

        }

        // Metas disponibles (cuando se ingresa desde el menú)
        $metas = Meta::with([
                'objetivo.plan.entidad'
            ])
            ->where('estado', 'Activo')
            ->orderBy('codigo')
            ->get();

        // Responsables
        $responsables = User::where('estado', 'Activo')
            ->where('entidad_id', auth()->user()->entidad_id)
            ->orderBy('nombres')
            ->get();

        return view('indicadores.create', compact(
            'codigo',
            'metas',
            'responsables',
            'planSeleccionado',
            'objetivoSeleccionado',
            'metaSeleccionada'
        ));
    }

    // Guardar indicador.
    public function store(Request $request)
    {
        $request->validate([
            'meta_id'         => 'required|exists:metas,id',
            'nombre'          => 'required|string|max:255',
            'tipo'            => 'required|string|max:50',
            'formula'         => 'required|string',
            'unidad_medida'   => 'required|string|max:50',
            'frecuencia'      => 'required|string|max:50',
            'responsable_id'  => 'required|exists:users,id',
            'estado'          => 'required|in:Activo,Inactivo',
        ]);

        DB::beginTransaction();

        try {

            // Generar código automático
            $ultimo = (Indicador::max('id') ?? 0) + 1;

            $codigo = 'IND-' . str_pad($ultimo, 2, '0', STR_PAD_LEFT);

            // Registrar indicador
            $indicador = Indicador::create([

                'meta_id'        => $request->meta_id,
                'codigo'         => $codigo,
                'nombre'         => $request->nombre,
                'tipo'           => $request->tipo,
                'formula'        => $request->formula,
                'unidad_medida'  => $request->unidad_medida,
                'frecuencia'     => $request->frecuencia,
                'responsable_id' => $request->responsable_id,
                'estado'         => $request->estado,
                'usuario_id'     => Auth::id(),

            ]);

            DB::commit();

            // Guardar contexto del asistente
            session([
                'indicador_id' => $indicador->id,
            ]);

            // Finalizar asistente
            return redirect()
                ->route('planes.finalizado');

        } catch (\Exception $e) {

            DB::rollBack();

            return back()
                ->withInput()
                ->withErrors([
                    'error' => $e->getMessage()
                ]);

        }
    }

    /**
     * Ver detalle.
     */
public function detalle($id)
{
    $indicador = Indicador::with([
            'meta.objetivo.plan.entidad',
            'responsable',
            'usuario'
        ])
        ->findOrFail($id);

    return view('indicadores.detalle', compact('indicador'));
}

    /**
     * Formulario de edición.
     */
public function editar($id)
{
    $indicador = Indicador::findOrFail($id);

    $metas = Meta::with([
            'objetivo.plan.entidad'
        ])
        ->where('estado', 'Activo')
        ->orderBy('codigo')
        ->get();

$responsables = User::where('estado', 'Activo')
    ->where('entidad_id', auth()->user()->entidad_id)
    ->orderBy('nombres')
    ->get();

    return view('indicadores.edit', compact(
        'indicador',
        'metas',
        'responsables'
    ));
}

    /**
     * Actualizar indicador.
     */
public function update(Request $request, $id)
{
    $indicador = Indicador::findOrFail($id);

    $request->validate([
        'meta_id' => 'required|exists:metas,id',
        'codigo' => 'required|string|max:30|unique:indicadores,codigo,' . $indicador->id,
        'nombre' => 'required|string|max:255',
        'tipo' => 'required|string|max:50',
        'formula' => 'required|string',
        'unidad_medida' => 'required|string|max:50',
        'frecuencia' => 'required|string|max:50',
        'responsable_id' => 'required|exists:users,id',
        'estado' => 'required|in:Activo,Inactivo',
    ]);

    $indicador->update([

        'meta_id' => $request->meta_id,

        'codigo' => strtoupper($request->codigo),

        'nombre' => $request->nombre,

        'tipo' => $request->tipo,

        'formula' => $request->formula,

        'unidad_medida' => $request->unidad_medida,

        'frecuencia' => $request->frecuencia,

        'responsable_id' => $request->responsable_id,

        'estado' => $request->estado,

    ]);


    return redirect()
        ->route('indicadores.detalle', $indicador->id)
        ->with('success', 'Indicador actualizado correctamente.');
}

    /**
     * Activar / Desactivar.
     */
 public function cambiarEstado($id)
{
    $indicador = Indicador::findOrFail($id);

    $indicador->estado = $indicador->estado === 'Activo'
        ? 'Inactivo'
        : 'Activo';

    $indicador->save();


    return redirect()
        ->back()
        ->with(
            'success',
            'Estado del indicador actualizado correctamente.'
        );
}
}