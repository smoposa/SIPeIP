<?php

namespace App\Http\Controllers;

use App\Http\Requests\Ods\GuardarMetaOdsRequest;
use App\Models\Ods;
use App\Models\OdsMeta;
use App\Services\OdsService;
use Illuminate\Http\RedirectResponse;

class OdsMetaController extends Controller
{
    public function __construct(
        private readonly OdsService $odsService
    ) {
    }


    /**
     * Registrar una meta desde el panel lateral.
     */
    public function store(
        GuardarMetaOdsRequest $request,
        Ods $ods
    ): RedirectResponse {
        $this->autorizar('ods', 'crear');

        $this->odsService->crearMeta(
            $ods,
            $request->validated()
        );

        return redirect()
            ->route('ods.metas.index', ['ods' => $ods->id])
            ->with('success', 'Meta registrada correctamente.');
    }


    /**
     * Actualizar información y estado de la meta.
     */
    public function update(
        GuardarMetaOdsRequest $request,
        Ods $ods,
        OdsMeta $meta
    ): RedirectResponse {
        $this->autorizar('ods');

        // El Request controla los permisos de información y estado.
        // El servicio comprueba que la meta pertenezca al objetivo.
        $this->odsService->actualizarMeta(
            $ods,
            $meta,
            $request->validated()
        );

        return redirect()
            ->route('ods.metas.index', ['ods' => $ods->id])
            ->with('success', 'Meta actualizada correctamente.');
    }
}