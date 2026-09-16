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

    /**
     * Panel principal de planes.
     */
    public function index(): View
    {
        $this->autorizar('planes');

        try {
            $resumen = $this->planService->obtenerResumen(
                auth()->user()
            );

            return view(
                'planes.index',
                $resumen
            );

        } catch (DomainException $e) {

            return view('planes.index', [
                'totalPlanes' => 0,
                'planesActivos' => 0,
                'planesInactivos' => 0,
                'errorContexto' => $e->getMessage(),
            ]);
        }
    }

    /**
     * Formulario para crear un plan institucional.
     */
    public function create(): View|RedirectResponse
    {
        $this->autorizar('planes', 'crear');

        try {
            $codigo = $this->planService->generarCodigo(
                auth()->user()
            );

            return view(
                'planes.create',
                compact('codigo')
            );

        } catch (DomainException $e) {

            return $this->redirigirPorContextoInvalido(
                $e
            );
        }
    }

    /**
     * Registrar un nuevo plan institucional.
     */
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

            return $this->redirigirPorContextoInvalido(
                $e
            );
        }
    }

    /**
     * Listar planes pertenecientes
     * a la entidad del usuario autenticado.
     */
    public function listar(): View|RedirectResponse
    {
        $this->autorizar('planes');

        try {
            $usuario = auth()->user();

            $planes = $this->planService->listar(
                $usuario
            );

            $resumen = $this->planService->obtenerResumen(
                $usuario
            );

            return view('planes.listar', [
                'planes' => $planes,
                'totalPlanes' => $resumen['totalPlanes'],
                'planesActivos' => $resumen['planesActivos'],
                'planesInactivos' => $resumen['planesInactivos'],
            ]);

        } catch (DomainException $e) {

            return $this->redirigirPorContextoInvalido(
                $e
            );
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
            $plan = $this->planService->obtenerAccesible(
                $id,
                auth()->user()
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

    /**
     * Formulario para editar un plan.
     */
    public function edit(
        int $id
    ): View|RedirectResponse {
        $this->autorizar('planes', 'editar');

        try {
            $plan = $this->planService->obtenerAccesible(
                $id,
                auth()->user()
            );

            return view(
                'planes.edit',
                compact('plan')
            );

        } catch (DomainException $e) {

            return $this->redirigirPorContextoInvalido(
                $e
            );
        }
    }

    /**
     * Actualizar información del plan.
     */
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
                ->route(
                    'planes.detalle',
                    $plan->id
                )
                ->with(
                    'success',
                    'Plan actualizado correctamente.'
                );

        } catch (DomainException $e) {

            return $this->redirigirPorContextoInvalido(
                $e
            );
        }
    }

    /**
     * Formulario para cambiar
     * el estado administrativo.
     */
    public function editarEstado(
        int $id
    ): View|RedirectResponse {
        $this->autorizar('planes', 'estado');

        try {
            $plan = $this->planService->obtenerAccesible(
                $id,
                auth()->user()
            );

            return view(
                'planes.editarestado',
                compact('plan')
            );

        } catch (DomainException $e) {

            return $this->redirigirPorContextoInvalido(
                $e
            );
        }
    }

    /**
     * Actualizar estado administrativo:
     * Activo / Inactivo.
     */
    public function actualizarEstado(
        UpdatePlanStatusRequest $request,
        int $id
    ): RedirectResponse {
        $this->autorizar('planes', 'estado');

        try {
            $plan = $this->planService
                ->cambiarEstadoAdministrativo(
                    $id,
                    $request->boolean('estado'),
                    auth()->user()
                );

            return redirect()
                ->route(
                    'planes.detalle',
                    $plan->id
                )
                ->with(
                    'success',
                    'Estado del plan actualizado correctamente.'
                );

        } catch (DomainException $e) {

            return $this->redirigirPorContextoInvalido(
                $e
            );
        }
    }

    /**
     * Redirigir al inicio de Planes cuando
     * el contexto institucional no sea válido.
     */
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
