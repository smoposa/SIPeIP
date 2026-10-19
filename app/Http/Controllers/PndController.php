<?php

namespace App\Http\Controllers;

use App\Http\Requests\Pnd\StorePndRequest;
use App\Http\Requests\Pnd\UpdatePndRequest;
use App\Services\PndService;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;

class PndController extends Controller
{
    public function __construct(
        private readonly PndService $pndService
    ) {
    }

    /**
     * Mostrar el listado de planes nacionales.
     */
    public function index(): View
    {
        $this->autorizar('pnd');

        $planes = $this->pndService->listarPlanes();

        return view('pnd.planes.index', compact('planes'));
    }

    /**
     * Registrar un plan desde el panel lateral.
     */
    public function store(StorePndRequest $request): RedirectResponse
    {
        $this->autorizar('pnd', 'crear');

        $this->pndService->crearPlan(
            $request->validated()
        );

        return redirect()
            ->route('pnd.index')
            ->with('success', 'Plan nacional registrado correctamente.');
    }

    /**
     * Actualizar la información y el estado del plan.
     */
    public function update(
        UpdatePndRequest $request,
        int $pnd
    ): RedirectResponse {
        $this->autorizar('pnd');

        // El Request controla los permisos de edición y estado.
        $this->pndService->actualizarPlan(
            $pnd,
            $request->validated()
        );

        return redirect()
            ->route('pnd.index')
            ->with('success', 'Plan nacional actualizado correctamente.');
    }

    /**
     * Mostrar los ejes del plan seleccionado.
     */
    public function listarEjes(int $pnd): View
    {
        $this->autorizar('pnd');

        $pnd = $this->pndService->obtenerPlanConEjes($pnd);

        return view('pnd.ejes.index', compact('pnd'));
    }

    /**
     * Mostrar los objetivos del eje seleccionado.
     */
    public function listarObjetivos(int $eje): View
    {
        $this->autorizar('pnd');

        $eje = $this->pndService->obtenerEjeConObjetivos($eje);

        return view('pnd.objetivos.index', compact('eje'));
    }

    /**
     * Mostrar las políticas, estrategias y metas del objetivo.
     */
    public function objetivo(int $id): View
    {
        $this->autorizar('pnd');

        $objetivo = $this->pndService->obtenerObjetivoConDetalle($id);

        abort_if(
            !$objetivo,
            404,
            'El Objetivo Nacional solicitado no existe.'
        );

        return view('pnd.objetivos.objetivo', compact('objetivo'));
    }
}