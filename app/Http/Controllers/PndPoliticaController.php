<?php

namespace App\Http\Controllers;

use App\Http\Requests\Pnd\GuardarPoliticaPndRequest;
use App\Models\PndObjetivo;
use App\Models\PndPolitica;
use App\Services\PndService;
use Illuminate\Http\RedirectResponse;

class PndPoliticaController extends Controller
{
    public function __construct(
        private readonly PndService $pndService
    ) {
    }

    public function store(
        GuardarPoliticaPndRequest $request,
        PndObjetivo $objetivo
    ): RedirectResponse {
        $this->autorizar('pnd', 'crear');

        $registro = $this->pndService->crearPolitica(
            $objetivo,
            $request->validated()
        );

        return redirect()
            ->to(route('pnd.objetivo', ['id' => $objetivo->id]) . '#' . ('politica-' . $registro->id))
            ->with('success', 'Politica registrada correctamente.');
    }

    public function update(
        GuardarPoliticaPndRequest $request,
        PndObjetivo $objetivo,
        PndPolitica $politica
    ): RedirectResponse {
        $this->autorizar('pnd');

        $registro = $this->pndService->actualizarPolitica(
            $objetivo,
            $politica,
            $request->validated()
        );

        return redirect()
            ->to(route('pnd.objetivo', ['id' => $objetivo->id]) . '#' . ('politica-' . $registro->id))
            ->with('success', 'Politica actualizada correctamente.');
    }
}
