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

    /**
     * Mostrar detalle de un ODS
     * con sus metas asociadas.
     */
    public function detalle(Ods $ods)
    {
        $ods->load([
            'metas' => function ($query) {
                $query->orderBy('codigo');
            }
        ]);

        return view('ods.detalle', compact('ods'));
    }
}