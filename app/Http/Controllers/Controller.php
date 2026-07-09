<?php

namespace App\Http\Controllers;

abstract class Controller
{
    /**
     * Verifica si el usuario tiene permiso para realizar una acción.
     */
    protected function autorizar(string $modulo, string $accion = 'ver'): void
    {
        if (!puedeHacer($modulo, $accion)) {
            abort(403, 'No tiene permisos para realizar esta acción.');
        }
    }
}