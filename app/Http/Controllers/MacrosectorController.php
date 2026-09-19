<?php

namespace App\Http\Controllers;

use App\Http\Requests\ClasificacionInversion\StoreMacrosectorRequest;
use App\Http\Requests\ClasificacionInversion\UpdateClasificacionStatusRequest;
use App\Http\Requests\ClasificacionInversion\UpdateMacrosectorRequest;
use App\Services\ClasificacionInversionService;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;

class MacrosectorController extends Controller
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
            'catalogos.inversion.macrosectores.create'
        );
    }

    /**
     * Registrar un macrosector.
     */
    public function store(
        StoreMacrosectorRequest $request
    ): RedirectResponse {
        $this->autorizar(
            'clasificacion_inversion',
            'crear'
        );

        $this->service->crearMacrosector(
            $request->validated()
        );

        return redirect()
            ->route('clasificacion-inversion.index')
            ->with(
                'success',
                'Macrosector registrado correctamente.'
            );
    }

    /**
     * Mostrar el formulario de edición.
     */
    public function edit(
        int $macrosector
    ): View {
        $this->autorizar(
            'clasificacion_inversion',
            'editar'
        );

        return view(
            'catalogos.inversion.macrosectores.edit',
            [
                'macrosector' => $this->service
                    ->obtenerMacrosectorPorId(
                        $macrosector
                    ),
            ]
        );
    }

    /**
     * Actualizar un macrosector.
     */
    public function update(
        UpdateMacrosectorRequest $request,
        int $macrosector
    ): RedirectResponse {
        $this->autorizar(
            'clasificacion_inversion',
            'editar'
        );

        $registro = $this->service
            ->obtenerMacrosectorPorId(
                $macrosector
            );

        $this->service->actualizarMacrosector(
            $registro,
            $request->validated()
        );

        return redirect()
            ->route('clasificacion-inversion.index')
            ->with(
                'success',
                'Macrosector actualizado correctamente.'
            );
    }

    /**
     * Activar o inactivar un macrosector.
     */
    public function actualizarEstado(
        UpdateClasificacionStatusRequest $request,
        int $macrosector
    ): RedirectResponse {
        $this->autorizar(
            'clasificacion_inversion',
            'estado'
        );

        $registro = $this->service
            ->obtenerMacrosectorPorId(
                $macrosector
            );

        $this->service->actualizarEstadoMacrosector(
            $registro,
            $request->boolean('estado')
        );

        return redirect()
            ->route('clasificacion-inversion.index')
            ->with(
                'success',
                'Estado del macrosector actualizado correctamente.'
            );
    }
}