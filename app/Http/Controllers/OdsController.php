<?php

namespace App\Http\Controllers;

use App\Models\Ods;

class OdsController extends Controller
{
    /**
     * Mostrar catálogo ODS.
     */
    public function index()
    {
        $ods = Ods::orderBy('codigo')->get();

        return view('ods.index', compact('ods'));
    }
}