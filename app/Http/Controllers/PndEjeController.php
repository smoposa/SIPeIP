<?php

namespace App\Http\Controllers;

use App\Http\Requests\Pnd\GuardarEjePndRequest;
use App\Models\PndEje;
use App\Services\PndService;
use Illuminate\Http\RedirectResponse;

class PndEjeController extends Controller
{
    public function __construct(
        private readonly PndService $pndService
    ) {
    }

    /**
     * Registrar un eje desde el panel lateral.
     */
    public function store(
        GuardarEjePndRequest $request,
        int $pnd
    ): RedirectResponse {
        $this->autorizar('pnd', 'crear');

        $eje = $this->pndService->crearEje(
            $pnd,
            $request->validated()
        );

        return redirect()
            ->route('pnd.ejes.index', ['pnd' => $eje->pnd_id])
            ->with('success', 'Eje registrado correctamente.');
    }

    /**
     * Actualizar la información y el estado del eje.
     */
    public function update(
        GuardarEjePndRequest $request,
        PndEje $eje
    ): RedirectResponse {
        $this->autorizar('pnd');

        $eje = $this->pndService->actualizarEje(
            $eje,
            $request->validated()
        );

        return redirect()
            ->route('pnd.ejes.index', ['pnd' => $eje->pnd_id])
            ->with('success', 'Eje actualizado correctamente.');
    }
}