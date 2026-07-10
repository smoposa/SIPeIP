<?php

namespace App\Http\Controllers;

use App\Models\Pnd;

class PndController extends Controller
{
    /**
     * Mostrar catálogo PND.
     */
    public function index()
    {
        $pnd = Pnd::orderBy('codigo')->get();

        return view('pnd.index', compact('pnd'));
    }
}