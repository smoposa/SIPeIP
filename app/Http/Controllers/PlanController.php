<?php

namespace App\Http\Controllers;

use App\Http\Requests\PlanRequest;
use App\Models\Entidad;
use App\Models\Plan;
use Illuminate\Http\Request;

class PlanController extends Controller
{
    /** Página principal del módulo.*/
    public function index()
    {
        return view('plan.index', [
            'totalPlanes' => Plan::count(),
            'planesActivos' => Plan::where('estado', 'Activo')->count(),
            'planesFinalizados' => Plan::where('estado', 'Finalizado')->count(),
        ]);
    }

    /** Formulario para crear un plan.*/
    public function create()
    {
        $entidades = Entidad::where('estado', 'Activo')
            ->orderBy('nombre')
            ->get();

        $anios = range(date('Y'), date('Y') + 10);

        return view('plan.create', compact('entidades', 'anios'));
    }

    /** Guarda un nuevo plan. */
    public function store(PlanRequest $request)
    {
        $datos = $request->validated();

        $datos['codigo'] = $this->generarCodigo();

        Plan::create($datos);

        return redirect()
            ->route('planes.listar')
            ->with('success', 'Plan registrado correctamente.');
    }

    /** Lista todos los planes. */
    public function listar()
    {
        $planes = Plan::with('entidad')
            ->orderByDesc('id')
            ->get();

        return view('plan.listar', compact('planes'));
    }

    /** Formulario para editar un plan. */
     public function editar(Plan $plan)
    {
        $entidades = Entidad::where('estado', 'Activo')
            ->orderBy('nombre')
            ->get();

        $anios = range(date('Y'), date('Y') + 10);

        return view('plan.editar', compact(
            'plan',
            'entidades',
            'anios'
        ));
    }

    /** Actualiza un plan. */
    public function update(PlanRequest $request, Plan $plan)
    {
        $plan->update($request->validated());

        return redirect()
            ->route('planes.listar')
            ->with('success', 'Plan actualizado correctamente.');
    }

    /** Detalle.*/
    public function detalle(Plan $plan)
    {
        return view('plan.detalle', compact('plan'));
    }
    
    
    /** Elimina un plan.*/
    public function destroy(Plan $plan)
    {
        //
    }

    /** Genera el código automático del PEI.*/
    private function generarCodigo(): string
    {
        $anio = date('Y');

        $ultimo = Plan::where('codigo', 'like', "PEI-$anio-%")->count() + 1;

        return sprintf('PEI-%s-%03d', $anio, $ultimo);
    }
}