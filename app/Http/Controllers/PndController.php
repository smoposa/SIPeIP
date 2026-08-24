<?php

namespace App\Http\Controllers;

use App\Services\PndService;
use Illuminate\View\View;

class PndController extends Controller
{
    public function __construct(
        private readonly PndService $pndService
    ) {
    }

    /**
     * Mostrar la pantalla principal del
     * Plan Nacional de Desarrollo.
     */
    public function index(): View
    {
        $datos = $this->pndService->obtenerDatosIndex();

        return view('pnd.index', $datos);
    }

    /**
     * Mostrar el detalle de un Objetivo Nacional
     * con sus políticas, estrategias y metas.
     */
    public function objetivo(int $id): View
    {
        $objetivo = $this->pndService->obtenerObjetivoConDetalle($id);

        abort_if(
            !$objetivo,
            404,
            'El Objetivo Nacional solicitado no existe.'
        );

        return view('pnd.objetivo', [
            'objetivo' => $objetivo,
        ]);
    }
}