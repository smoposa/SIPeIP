<?php

namespace App\Http\Controllers;

use App\Services\ClasificacionInversionService;
use Illuminate\View\View;

class ClasificacionInversionController extends Controller
{
    public function __construct(
        private readonly ClasificacionInversionService $service
    ) {
    }

    /**
     * Mostrar el catálogo jerárquico de clasificación
     * de la inversión pública.
     */
    public function index(): View
    {
        $this->autorizar('clasificacion_inversion');

        return view(
            'clasificacion-inversion.index',
            $this->service->obtenerResumen()
        );
    }
}