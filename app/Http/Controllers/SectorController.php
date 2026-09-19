<?php

namespace App\Http\Controllers;

use App\Http\Requests\ClasificacionInversion\StoreSectorRequest;
use App\Http\Requests\ClasificacionInversion\UpdateClasificacionStatusRequest;
use App\Http\Requests\ClasificacionInversion\UpdateSectorRequest;
use App\Services\ClasificacionInversionService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;

class SectorController extends Controller
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
            'catalogos.inversion.sectores.create',
            [
                'macrosectores' => $this->service
                    ->obtenerMacrosectoresActivos(),
            ]
        );
    }

    /**
     * Registrar un sector.
     */
    public function store(
        StoreSectorRequest $request
    ): RedirectResponse {
        $this->autorizar(
            'clasificacion_inversion',
            'crear'
        );

        $this->service->crearSector(
            $request->validated()
        );

        return redirect()
            ->route('clasificacion-inversion.index')
            ->with(
                'success',
                'Sector registrado correctamente.'
            );
    }

    /**
     * Mostrar el formulario de edición.
     */
    public function edit(
        int $sector
    ): View {
        $this->autorizar(
            'clasificacion_inversion',
            'editar'
        );

        return view(
            'catalogos.inversion.sectores.edit',
            [
                'sector' => $this->service
                    ->obtenerSectorPorId($sector),

                'macrosectores' => $this->service
                    ->obtenerMacrosectoresActivos(),
            ]
        );
    }

    /**
     * Actualizar un sector.
     */
    public function update(
        UpdateSectorRequest $request,
        int $sector
    ): RedirectResponse {
        $this->autorizar(
            'clasificacion_inversion',
            'editar'
        );

        $registro = $this->service
            ->obtenerSectorPorId($sector);

        $this->service->actualizarSector(
            $registro,
            $request->validated()
        );

        return redirect()
            ->route('clasificacion-inversion.index')
            ->with(
                'success',
                'Sector actualizado correctamente.'
            );
    }

    /**
     * Activar o inactivar un sector.
     */
    public function actualizarEstado(
        UpdateClasificacionStatusRequest $request,
        int $sector
    ): RedirectResponse {
        $this->autorizar(
            'clasificacion_inversion',
            'estado'
        );

        $registro = $this->service
            ->obtenerSectorPorId($sector);

        $this->service->actualizarEstadoSector(
            $registro,
            $request->boolean('estado')
        );

        return redirect()
            ->route('clasificacion-inversion.index')
            ->with(
                'success',
                'Estado del sector actualizado correctamente.'
            );
    }

    /**
     * Obtener los sectores activos de un macrosector.
     */
    public function porMacrosector(
        int $macrosector
    ): JsonResponse {
        $this->autorizar('clasificacion_inversion');

        return response()->json(
            $this->service
                ->obtenerSectoresActivosPorMacrosector(
                    $macrosector
                )
        );
    }
}