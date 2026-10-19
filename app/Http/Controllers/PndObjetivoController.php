<?php

namespace App\Http\Controllers;

use App\Http\Requests\Pnd\GuardarObjetivoPndRequest;
use App\Models\PndEje;
use App\Models\PndObjetivo;
use App\Services\PndService;
use Illuminate\Http\RedirectResponse;

class PndObjetivoController extends Controller
{
    public function __construct(
        private readonly PndService $pndService
    ) {
    }

    /**
     * Registrar un objetivo desde el panel lateral.
     */
    public function store(
        GuardarObjetivoPndRequest $request,
        PndEje $eje
    ): RedirectResponse {
        $this->autorizar('pnd', 'crear');

        $objetivo = $this->pndService->crearObjetivo(
            $eje,
            $request->validated()
        );

        return redirect()
            ->route('pnd.objetivos.index', [
                'eje' => $objetivo->pnd_eje_id,
            ])
            ->with('success', 'Objetivo nacional registrado correctamente.');
    }

    /**
     * Actualizar información y estado del objetivo.
     */
    public function update(
        GuardarObjetivoPndRequest $request,
        PndObjetivo $objetivo
    ): RedirectResponse {
        $this->autorizar('pnd');

        $objetivo = $this->pndService->actualizarObjetivo(
            $objetivo,
            $request->validated()
        );

        return redirect()
            ->route('pnd.objetivos.index', [
                'eje' => $objetivo->pnd_eje_id,
            ])
            ->with('success', 'Objetivo nacional actualizado correctamente.');
    }
}