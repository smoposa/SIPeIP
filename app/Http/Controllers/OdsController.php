<?php

namespace App\Http\Controllers;

use App\Models\Ods;
use App\Services\OdsService;
use Illuminate\View\View;

class OdsController extends Controller
{
    public function __construct(
        private readonly OdsService $odsService
    ) {
    }

    /**
     * Mostrar catálogo ODS.
     */
    public function index(): View
    {
        $agendas = $this->odsService->listarAgendas();

        return view('ods.index', compact('agendas'));
    }

    public function agenda(int $agenda): View
    {
        return view('ods.objetivos', $this->odsService->datosAgenda($agenda));
    }

    /**
     * Mostrar detalle de un ODS
     * con sus metas asociadas.
     */
    public function detalle(Ods $ods): View
    {
        $ods = $this->odsService->obtenerConMetas($ods);

        return view('ods.detalle', compact('ods'));
    }
}