<?php

namespace App\Http\Controllers;

use App\Http\Requests\Planes\StorePlanRequest;
use App\Http\Requests\Planes\UpdatePlanRequest;
use App\Models\Indicador;
use App\Services\PlanService;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class PlanController extends Controller
{
    public function __construct(
        private readonly PlanService $planService
    ) {
    }

    /**
     * Panel principal de planes.
     */
    public function index(): View
    {
        $entidadId = auth()->user()->entidad_id;

        $resumen = $this->planService
            ->obtenerResumenPorEntidad($entidadId);

        return view('planes.index', $resumen);
    }

    /**
     * Formulario para crear un plan institucional.
     */
    public function create(): View
    {
        $entidad = auth()->user()->entidad;

        $codigo = $this->planService->generarCodigo(
            $entidad->id,
            $entidad->siglas
        );

        return view('planes.create', compact('codigo'));
    }

    /**
     * Registrar un nuevo plan institucional.
     */
    public function store(
        StorePlanRequest $request
    ): RedirectResponse {
        $usuario = auth()->user();
        $entidad = $usuario->entidad;

        $plan = $this->planService->crear(
            $request->validated(),
            $entidad->id,
            $usuario->id,
            $entidad->siglas
        );

        session([
            'plan_id' => $plan->id,
        ]);

        return redirect()
            ->route('planes.create')
            ->with('plan_registrado', true);
    }

    /**
     * Listar planes de la entidad del usuario autenticado.
     */
    public function listar(): View
    {
        $entidadId = auth()->user()->entidad_id;

        $planes = $this->planService
            ->listarPorEntidad($entidadId);

        return view(
            'planes.listar',
            compact('planes')
        );
    }

    /**
     * Mostrar detalle del plan.
     */
    public function detalle(int $id): View
    {
        $entidadId = auth()->user()->entidad_id;

        $plan = $this->planService->obtenerPorEntidad(
            $id,
            $entidadId
        );

        return view(
            'planes.detalle',
            compact('plan')
        );
    }

    /**
     * Formulario para editar un plan.
     */
    public function edit(int $id): View
    {
        $entidadId = auth()->user()->entidad_id;

        $plan = $this->planService->obtenerPorEntidad(
            $id,
            $entidadId
        );

        return view(
            'planes.edit',
            compact('plan')
        );
    }

    /**
     * Actualizar información del plan.
     */
    public function update(
        UpdatePlanRequest $request,
        int $id
    ): RedirectResponse {
        $entidadId = auth()->user()->entidad_id;

        $plan = $this->planService->obtenerPorEntidad(
            $id,
            $entidadId
        );

        $plan = $this->planService->actualizar(
            $plan,
            $request->validated()
        );

        return redirect()
            ->route('planes.detalle', $plan->id)
            ->with(
                'success',
                'Plan actualizado correctamente.'
            );
    }

    /**
     * Eliminar plan.
     */
    public function destroy(int $id): RedirectResponse
    {
        $entidadId = auth()->user()->entidad_id;

        $plan = $this->planService->obtenerPorEntidad(
            $id,
            $entidadId
        );

        $this->planService->eliminar($plan);

        return redirect()
            ->route('planes.listar')
            ->with(
                'success',
                'Plan eliminado correctamente.'
            );
    }

    /**
     * Formulario para cambiar estado administrativo.
     */
    public function editarEstado(int $id): View
    {
        $entidadId = auth()->user()->entidad_id;

        $plan = $this->planService->obtenerPorEntidad(
            $id,
            $entidadId
        );

        return view(
            'planes.editarestado',
            compact('plan')
        );
    }

    /**
     * Actualizar estado Activo / Inactivo.
     */
    public function actualizarEstado(
        Request $request,
        int $id
    ): RedirectResponse {
        $entidadId = auth()->user()->entidad_id;

        $plan = $this->planService->obtenerPorEntidad(
            $id,
            $entidadId
        );

        $this->planService->cambiarEstadoAdministrativo(
            $plan,
            $request->has('estado')
        );

        return redirect()
            ->route('planes.detalle', $plan->id)
            ->with(
                'success',
                'Estado del plan actualizado correctamente.'
            );
    }

    /**
     * Pantalla final del asistente actual.
     *
     * Se mantiene temporalmente hasta reestructurar
     * Objetivos, Metas e Indicadores.
     */
    public function finalizado(): View
    {
        $indicadorId = session('indicador_id');

        abort_if(!$indicadorId, 404);

        $indicador = Indicador::with([
            'responsable',
            'meta.responsable',
            'meta.objetivo.plan.entidad',
        ])->findOrFail($indicadorId);

        $meta = $indicador->meta;
        $objetivo = $meta->objetivo;
        $plan = $objetivo->plan;

        abort_if(
            $plan->entidad_id !== auth()->user()->entidad_id,
            403
        );

        return view(
            'planes.finalizado',
            compact(
                'plan',
                'objetivo',
                'meta',
                'indicador'
            )
        );
    }
}