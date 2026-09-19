<?php

namespace App\Http\Controllers;

use App\Http\Requests\ClasificacionInversion\StoreSubsectorRequest;
use App\Http\Requests\ClasificacionInversion\UpdateClasificacionStatusRequest;
use App\Http\Requests\ClasificacionInversion\UpdateSubsectorRequest;
use App\Services\ClasificacionInversionService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;

class SubsectorController extends Controller
{
    public function __construct(
        private readonly ClasificacionInversionService $service
    ) {
    }

    /**
     * Mostrar el formulario de creación.
     */
    public function create(): View
    {
        $this->autorizar(
            'clasificacion_inversion',
            'crear'
        );

        return view(
            'catalogos.inversion.subsectores.create',
            [
                'macrosectores' => $this->service
                    ->obtenerMacrosectoresActivos(),
            ]
        );
    }

    /**
     * Registrar un subsector.
     */
    public function store(
        StoreSubsectorRequest $request
    ): RedirectResponse {
        $this->autorizar(
            'clasificacion_inversion',
            'crear'
        );

        $this->service->crearSubsector(
            $request->validated()
        );

        return redirect()
            ->route('clasificacion-inversion.index')
            ->with(
                'success',
                'Subsector registrado correctamente.'
            );
    }

    /**
     * Mostrar el formulario de edición.
     */
    public function edit(
        int $subsector
    ): View {
        $this->autorizar(
            'clasificacion_inversion',
            'editar'
        );

        return view(
            'catalogos.inversion.subsectores.edit',
            [
                'subsector' => $this->service
                    ->obtenerSubsectorPorId($subsector),

                'macrosectores' => $this->service
                    ->obtenerMacrosectoresActivos(),
            ]
        );
    }

    /**
     * Actualizar un subsector.
     */
    public function update(
        UpdateSubsectorRequest $request,
        int $subsector
    ): RedirectResponse {
        $this->autorizar(
            'clasificacion_inversion',
            'editar'
        );

        $registro = $this->service
            ->obtenerSubsectorPorId($subsector);

        $this->service->actualizarSubsector(
            $registro,
            $request->validated()
        );

        return redirect()
            ->route('clasificacion-inversion.index')
            ->with(
                'success',
                'Subsector actualizado correctamente.'
            );
    }

    /**
     * Activar o inactivar un subsector.
     */
    public function actualizarEstado(
        UpdateClasificacionStatusRequest $request,
        int $subsector
    ): RedirectResponse {
        $this->autorizar(
            'clasificacion_inversion',
            'estado'
        );

        $registro = $this->service
            ->obtenerSubsectorPorId($subsector);

        $this->service->actualizarEstadoSubsector(
            $registro,
            $request->boolean('estado')
        );

        return redirect()
            ->route('clasificacion-inversion.index')
            ->with(
                'success',
                'Estado del subsector actualizado correctamente.'
            );
    }

    /**
     * Obtener los subsectores activos de un sector.
     */
    public function porSector(
        int $sector
    ): JsonResponse {
        $this->autorizar('clasificacion_inversion');

        return response()->json(
            $this->service
                ->obtenerSubsectoresActivosPorSector(
                    $sector
                )
        );
    }
}