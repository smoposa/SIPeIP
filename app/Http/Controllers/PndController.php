<?php

namespace App\Http\Controllers;

use App\Services\PndService;
use Illuminate\View\View;

class PndController extends Controller
{
    public function __construct(
        protected PndService $pndService
    ) {
    }

    /**
     * Mostrar listado de los Planes Nacionales de Desarrollo.
     */
    public function index(): View
    {
        $pnd = $this->pndService->obtenerTodos();

        return view('pnd.index', compact('pnd'));
    }

    /**
     * Mostrar el PND con toda su estructura.
     */
    public function detalle(int $id): View
    {
        $pnd = $this->pndService->obtenerConEstructura($id);

        abort_if(!$pnd, 404);

        return view('pnd.detalle', compact('pnd'));
    }
}