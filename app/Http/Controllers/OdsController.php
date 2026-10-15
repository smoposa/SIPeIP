<?php

namespace App\Http\Controllers;

use App\Http\Requests\Ods\StoreAgendaOdsRequest;
use App\Http\Requests\Ods\StoreObjetivoOdsRequest;
use App\Http\Requests\Ods\UpdateAgendaOdsRequest;
use App\Http\Requests\Ods\UpdateObjetivoOdsRequest;
use App\Models\Ods;
use App\Services\OdsService;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;

class OdsController extends Controller
{
    public function __construct(
        private readonly OdsService $odsService
    ) {
    }


    /**
     * Mostrar el listado de agendas y su panel lateral.
     */
    public function index(): View
    {
        $this->autorizar('ods');

        $agendas = $this->odsService->listarAgendas();

        return view('ods.agendas.index', compact('agendas'));
    }


    /**
     * Registrar una agenda desde el panel lateral.
     */
    public function store(StoreAgendaOdsRequest $request): RedirectResponse
    {
        $this->autorizar('ods', 'crear');

        $this->odsService->crearAgenda(
            $request->validated()
        );

        return redirect()
            ->route('ods.agendas.index')
            ->with('success', 'Agenda ODS registrada correctamente.');
    }


    /**
     * Actualizar información y estado de la agenda.
     */
    public function update(
        UpdateAgendaOdsRequest $request,
        int $agenda
    ): RedirectResponse {
        $this->autorizar('ods');

        // El Request controla los permisos de información y estado.
        $this->odsService->actualizarAgenda(
            $agenda,
            $request->validated()
        );

        return redirect()
            ->route('ods.agendas.index')
            ->with('success', 'Agenda ODS actualizada correctamente.');
    }


    /**
     * Mostrar los objetivos de una agenda y su panel lateral.
     */
    public function listarObjetivos(int $agenda): View
    {
        $this->autorizar('ods');

        $datos = $this->odsService->datosAgenda($agenda);

        $datos['codigoSugerido'] = puedeHacer('ods', 'crear')
            ? $this->odsService->siguienteCodigoObjetivo($agenda)
            : null;

        return view('ods.objetivos.index', $datos);
    }


    /**
     * Registrar un objetivo dentro de la agenda seleccionada.
     */
    public function guardarObjetivo(
        StoreObjetivoOdsRequest $request,
        int $agenda
    ): RedirectResponse {
        $this->autorizar('ods', 'crear');

        $objetivo = $this->odsService->crearObjetivo(
            $agenda,
            $request->validated()
        );

        return redirect()
            ->route('ods.objetivos.index', [
                'agenda' => $objetivo->agenda_id,
            ])
            ->with('success', 'Objetivo ODS registrado correctamente.');
    }


    /**
     * Actualizar información y estado del objetivo.
     */
    public function actualizarObjetivo(
        UpdateObjetivoOdsRequest $request,
        Ods $ods
    ): RedirectResponse {
        $this->autorizar('ods');

        // El Request controla los permisos de información y estado.
        $ods = $this->odsService->actualizarObjetivo(
            $ods,
            $request->validated()
        );

        return redirect()
            ->route('ods.objetivos.index', [
                'agenda' => $ods->agenda_id,
            ])
            ->with('success', 'Objetivo ODS actualizado correctamente.');
    }


    /**
     * Mostrar las metas del objetivo y su panel lateral.
     */
    public function listarMetas(Ods $ods): View
    {
        $this->autorizar('ods');

        $ods = $this->odsService->obtenerConMetas($ods);

        return view('ods.metas.index', compact('ods'));
    }
}