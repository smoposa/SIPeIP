<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class RoleMiddleware
{
    /**
     * Handle an incoming request.
     */
    public function handle(Request $request, Closure $next, string $modulo): Response
    {
        // Verificar que exista un usuario autenticado
        if (!auth()->check()) {
            return redirect()->route('login');
        }

        // Obtener el código técnico del rol del usuario
        $rol = auth()->user()->rol?->codigo;

        if (!$rol) {
            abort(403, 'El usuario no tiene un rol válido asignado.');
        }

        // Obtener los roles permitidos para el módulo
        $rolesPermitidos = config("permisos.modulos.$modulo", []);

        // Verificar autorización
        if (!in_array($rol, $rolesPermitidos, true)) {
            abort(403, 'No tiene permisos para acceder a este módulo.');
        }

        return $next($request);
    }
}