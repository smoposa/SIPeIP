<?php

namespace App\Http\Controllers;

use App\Http\Requests\Planes\StorePlanRequest;
use App\Http\Requests\Planes\UpdatePlanRequest;
use App\Http\Requests\Planes\UpdatePlanStatusRequest;
use App\Services\PlanService;
use DomainException;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;

class PlanController extends Controller
{
    public function __construct(
        private readonly PlanService $planService
    ) {
    }

    // Mostrar el panel principal de planes.
    public function index(): View
    {
        $this->autorizar('planes');

        try {

            $resumen = $this->planService->obtenerResumen(
                auth()->user()
            );

            return view('planes.index', $resumen);

        } catch (DomainException $e) {

            return view('planes.index', [
                'totalPlanes' => 0,
                'planesActivos' => 0,
                'planesInactivos' => 0,
                'errorContexto' => $e->getMessage(),
            ]);

        }
    }

    // Mostrar el formulario de creación.
    public function create(): View|RedirectResponse
    {
        $this->autorizar('planes', 'crear');

        try {

            $codigo = $this->planService->generarCodigo(
                auth()->user()
            );

            return view('planes.create', compact('codigo'));

        } catch (DomainException $e) {

            return $this->redirigirPorContextoInvalido($e);

        }
    }

    // Registrar un plan institucional.
    public function store(
        StorePlanRequest $request
    ): RedirectResponse {
        $this->autorizar('planes', 'crear');

        try {

            $plan = $this->planService->crear(
                $request->validated(),
                auth()->user()
            );

            session([
                'plan_id' => $plan->id,
            ]);

            return redirect()
                ->route('planes.create')
                ->with([
                    'plan_registrado' => true,
                    'plan_codigo' => $plan->codigo,
                    'plan_estado_proceso' => $plan->estado_proceso,
                    'plan_version' => $plan->version,
                ]);

        } catch (DomainException $e) {

            return $this->redirigirPorContextoInvalido($e);

        }
    }

    // Listar los planes accesibles para el usuario.
    public function listar(): View|RedirectResponse
    {
        $this->autorizar('planes');

        try {

            $usuario = auth()->user();

            $planes = $this->planService->listar($usuario);

            $resumen = $this->planService->obtenerResumen($usuario);

            return view('planes.listar', [
                'planes' => $planes,
                'totalPlanes' => $resumen['totalPlanes'],
                'planesActivos' => $resumen['planesActivos'],
                'planesInactivos' => $resumen['planesInactivos'],
            ]);

        } catch (DomainException $e) {

            return $this->redirigirPorContextoInvalido($e);

        }
    }

    /**
     * Mostrar detalle de un plan.
     */
    public function detalle(
        int $id
    ): View|RedirectResponse {
        $this->autorizar('planes');

        try {
            $plan = $this->planService->obtenerDetalle(
                $id,
                auth()->user(),
                puedeVer('objetivos')
            );

            return view(
                'planes.detalle',
                compact('plan')
            );

        } catch (DomainException $e) {

            return $this->redirigirPorContextoInvalido(
                $e
            );
        }
    }

    // Abrir el panel de información desde la ruta de edición.
    public function edit(int $id): RedirectResponse
    {
        $this->autorizar('planes', 'editar');

        try {

            $plan = $this->planService->obtenerAccesible(
                $id,
                auth()->user()
            );

            return redirect()
                ->route('planes.detalle', $plan->id)
                ->with('abrir_panel_plan', 'informacion');

        } catch (DomainException $e) {

            return $this->redirigirPorContextoInvalido($e);

        }
    }

    // Actualizar la información del plan.
    public function update(
        UpdatePlanRequest $request,
        int $id
    ): RedirectResponse {
        $this->autorizar('planes', 'editar');

        try {

            $plan = $this->planService->actualizar(
                $id,
                $request->validated(),
                auth()->user()
            );

            return redirect()
                ->route('planes.detalle', $plan->id)
                ->with(
                    'success',
                    'Plan actualizado correctamente.'
                );

        } catch (DomainException $e) {

            return $this->redirigirPorContextoInvalido($e);

        }
    }

    // Abrir el panel de estado desde la ruta existente.
    public function editarEstado(int $id): RedirectResponse
    {
        $this->autorizar('planes', 'estado');

        try {

            $plan = $this->planService->obtenerAccesible(
                $id,
                auth()->user()
            );

            return redirect()
                ->route('planes.detalle', $plan->id)
                ->with('abrir_panel_plan', 'estado');

        } catch (DomainException $e) {

            return $this->redirigirPorContextoInvalido($e);

        }
    }

    // Actualizar únicamente el estado administrativo.
    public function actualizarEstado(
        UpdatePlanStatusRequest $request,
        int $id
    ): RedirectResponse {
        $this->autorizar('planes', 'estado');

        try {

            $plan = $this->planService->cambiarEstadoAdministrativo(
                $id,
                $request->boolean('estado'),
                auth()->user()
            );

            return redirect()
                ->route('planes.detalle', $plan->id)
                ->with(
                    'success',
                    'Estado del plan actualizado correctamente.'
                );

        } catch (DomainException $e) {

            return $this->redirigirPorContextoInvalido($e);

        }
    }

    // Redirigir cuando el contexto institucional no sea válido.
    private function redirigirPorContextoInvalido(
        DomainException $exception
    ): RedirectResponse {
        return redirect()
            ->route('planes.index')
            ->with(
                'errorContexto',
                $exception->getMessage()
            );
    }
}