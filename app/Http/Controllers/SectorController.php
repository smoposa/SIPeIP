<?php

namespace App\Http\Controllers;

use App\Http\Requests\ClasificacionInversion\StoreSectorRequest;
use App\Http\Requests\ClasificacionInversion\UpdateClasificacionStatusRequest;
use App\Http\Requests\ClasificacionInversion\UpdateSectorRequest;
use App\Http\Requests\ClasificacionInversion\GuardarSectorPanelRequest;
use App\Models\Sector;
use App\Models\Macrosector;
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
            'clasificacion-inversion.sectores.create',
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
            'clasificacion-inversion.sectores.edit',
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

    /**
     * Listado de sectores de un macrosector (HTML).
     * La consulta porMacrosector() continúa entregando JSON.
     */
    public function index(int $macrosector): View
    {
        $this->autorizar('clasificacion_inversion');

        return view(
            'clasificacion-inversion.sectores.index',
            $this->service->datosListadoSectores($macrosector)
        );
    }

    /**
     * Registrar desde el panel lateral.
     */
    public function storePanel(
        GuardarSectorPanelRequest $request,
        Macrosector $macrosector
    ): RedirectResponse {
        $this->autorizar('clasificacion_inversion', 'crear');

        $registro = $this->service->registrarSectorPanel(
            $macrosector,
            $request->validated()
        );

        return redirect()
            ->route('clasificacion-inversion.sectores.index', ['macrosector' => $registro->macrosector_id])
            ->with('success', 'Sector registrado correctamente.');
    }

    /**
     * El Request distingue los permisos de información y estado.
     */
    public function updatePanel(
        GuardarSectorPanelRequest $request,
        Sector $sector
    ): RedirectResponse {
        $this->autorizar('clasificacion_inversion');

        $registro = $this->service->guardarSectorPanel(
            $sector,
            $request->validated()
        );

        return redirect()
            ->route('clasificacion-inversion.sectores.index', ['macrosector' => $registro->macrosector_id])
            ->with('success', 'Sector actualizado correctamente.');
    }
}
