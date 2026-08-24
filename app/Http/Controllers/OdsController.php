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
        $ods = $this->odsService->obtenerTodos();

        return view('ods.index', compact('ods'));
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