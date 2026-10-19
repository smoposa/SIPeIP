<?php

namespace App\Http\Controllers;

use App\Http\Requests\Pnd\GuardarEstrategiaPndRequest;
use App\Models\PndEstrategia;
use App\Models\PndObjetivo;
use App\Models\PndPolitica;
use App\Services\PndService;
use Illuminate\Http\RedirectResponse;

class PndEstrategiaController extends Controller
{
    public function __construct(
        private readonly PndService $pndService
    ) {
    }

    public function store(
        GuardarEstrategiaPndRequest $request,
        PndObjetivo $objetivo,
        PndPolitica $politica
    ): RedirectResponse {
        $this->autorizar('pnd', 'crear');

        $registro = $this->pndService->crearEstrategia(
            $objetivo,
            $politica,
            $request->validated()
        );

        return redirect()
            ->to(route('pnd.objetivo', ['id' => $objetivo->id]) . '#' . ('politica-' . $politica->id))
            ->with('success', 'Estrategia registrada correctamente.');
    }

    public function update(
        GuardarEstrategiaPndRequest $request,
        PndObjetivo $objetivo,
        PndPolitica $politica,
        PndEstrategia $estrategia
    ): RedirectResponse {
        $this->autorizar('pnd');

        $registro = $this->pndService->actualizarEstrategia(
            $objetivo,
            $politica,
            $estrategia,
            $request->validated()
        );

        return redirect()
            ->to(route('pnd.objetivo', ['id' => $objetivo->id]) . '#' . ('politica-' . $politica->id))
            ->with('success', 'Estrategia actualizada correctamente.');
    }
}
