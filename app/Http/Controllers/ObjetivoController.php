<?php

namespace App\Http\Controllers;

use App\Http\Requests\Objetivos\StoreObjetivoRequest;
use App\Http\Requests\Objetivos\UpdateObjetivoRequest;
use App\Http\Requests\Objetivos\UpdateObjetivoStatusRequest;
use App\Services\ObjetivoService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;

class ObjetivoController extends Controller
{
    public function __construct(
        private readonly ObjetivoService $objetivoService
    ) {
    }

    /**
     * Listar objetivos de la entidad.
     */
    public function listar(): View
    {
        $this->autorizar('objetivos');

        $objetivos = $this->objetivoService->listar(
            auth()->user()
        );

        return view(
            'objetivos.listar',
            compact('objetivos')
        );
    }

    /**
     * Mostrar formulario de creación.
     */
    public function create(): View
    {
        $this->autorizar('objetivos');

        $datos = $this->objetivoService
            ->obtenerDatosCreacion(
                auth()->user(),
                session('plan_id')
            );

        return view(
            'objetivos.create',
            $datos
        );
    }

    /**
     * Obtener políticas activas de un objetivo PND.
     */
    public function obtenerPoliticas(
        int $pnd
    ): JsonResponse {
        $this->autorizar('objetivos');

        return response()->json(
            $this->objetivoService
                ->obtenerPoliticas($pnd)
        );
    }

    /**
     * Obtener metas activas de un ODS.
     */
    public function obtenerMetasOds(
        int $ods
    ): JsonResponse {
        $this->autorizar('objetivos');

        return response()->json(
            $this->objetivoService
                ->obtenerMetasOds($ods)
        );
    }

    /**
     * Registrar un objetivo.
     */
    public function store(
        StoreObjetivoRequest $request
    ): RedirectResponse {
        $this->autorizar('objetivos');

        $objetivo = $this->objetivoService->crear(
            $request->validated(),
            auth()->user()
        );

        session([
            'plan_id' => $objetivo->plan_id,
            'objetivo_id' => $objetivo->id,
        ]);

        return redirect()
            ->route('objetivos.create')
            ->with(
                'objetivo_registrado',
                true
            );
    }

    /**
     * Mostrar detalle del objetivo.
     */
    public function detalle(
        int $id
    ): View {
        $this->autorizar('objetivos');

        $objetivo = $this->objetivoService
            ->obtenerAccesible(
                $id,
                auth()->user()
            );

        return view(
            'objetivos.detalle',
            compact('objetivo')
        );
    }

    /**
     * Mostrar formulario de edición.
     */
    public function edit(
        int $id
    ): View {
        $this->autorizar('objetivos');

        return view(
            'objetivos.edit',
            $this->objetivoService
                ->obtenerDatosEdicion(
                    $id,
                    auth()->user()
                )
        );
    }

    /**
     * Actualizar el objetivo.
     */
    public function update(
        UpdateObjetivoRequest $request,
        int $id
    ): RedirectResponse {
        $this->autorizar('objetivos');

        $objetivo = $this->objetivoService
            ->actualizar(
                $id,
                $request->validated(),
                auth()->user()
            );

        return redirect()
            ->route(
                'objetivos.detalle',
                $objetivo->id
            )
            ->with(
                'success',
                'Objetivo actualizado correctamente.'
            );
    }

    /**
     * Mostrar formulario para cambiar estado.
     */
    public function editarEstado(
        int $id
    ): View {
        $this->autorizar('objetivos');

        $objetivo = $this->objetivoService
            ->obtenerAccesible(
                $id,
                auth()->user()
            );

        return view(
            'objetivos.editarestado',
            compact('objetivo')
        );
    }

    /**
     * Actualizar el estado del objetivo.
     */
    public function actualizarEstado(
        UpdateObjetivoStatusRequest $request,
        int $id
    ): RedirectResponse {
        $this->autorizar('objetivos');

        $objetivo = $this->objetivoService
            ->cambiarEstado(
                $id,
                $request->boolean('estado'),
                auth()->user()
            );

        return redirect()
            ->route(
                'objetivos.detalle',
                $objetivo->id
            )
            ->with(
                'success',
                'Estado del objetivo actualizado correctamente.'
            );
    }
}