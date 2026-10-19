<?php

namespace App\Http\Controllers;

use App\Http\Requests\Pnd\GuardarMetaPndRequest;
use App\Models\PndMeta;
use App\Models\PndObjetivo;
use App\Services\PndService;
use Illuminate\Http\RedirectResponse;

class PndMetaController extends Controller
{
    public function __construct(
        private readonly PndService $pndService
    ) {
    }

    public function store(
        GuardarMetaPndRequest $request,
        PndObjetivo $objetivo
    ): RedirectResponse {
        $this->autorizar('pnd', 'crear');

        $registro = $this->pndService->crearMeta(
            $objetivo,
            $request->validated()
        );

        return redirect()
            ->to(route('pnd.objetivo', ['id' => $objetivo->id]) . '#' . ('metas'))
            ->with('success', 'Meta registrada correctamente.');
    }

    public function update(
        GuardarMetaPndRequest $request,
        PndObjetivo $objetivo,
        PndMeta $meta
    ): RedirectResponse {
        $this->autorizar('pnd');

        $registro = $this->pndService->actualizarMeta(
            $objetivo,
            $meta,
            $request->validated()
        );

        return redirect()
            ->to(route('pnd.objetivo', ['id' => $objetivo->id]) . '#' . ('metas'))
            ->with('success', 'Meta actualizada correctamente.');
    }
}
