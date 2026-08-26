<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class ValidarSesionActiva
{
    /**
     * Validar que la sesión siga siendo válida.
     */
    public function handle(Request $request, Closure $next): Response
    {
        if (!Auth::check()) {
            return $next($request);
        }

        $usuario = Auth::user()->loadMissing([
            'rol',
            'entidad',
        ]);

        /*
         * Usuario deshabilitado.
         */
        if ($usuario->estado !== 'Activo') {
            return $this->cerrarSesion(
                $request,
                'Su usuario se encuentra deshabilitado. Comuníquese con el administrador del sistema.'
            );
        }

        /*
         * Rol inválido o deshabilitado.
         */
        if (
            !$usuario->rol ||
            $usuario->rol->estado !== 'Activo'
        ) {
            return $this->cerrarSesion(
                $request,
                'El rol asignado a su usuario se encuentra deshabilitado. Comuníquese con el administrador del sistema.'
            );
        }

        /*
         * Administrador Global y Administrador del Sistema
         * no dependen del estado de la entidad.
         */
        $esAdministradorGlobal = in_array(
            $usuario->rol->codigo,
            [
                'ADMIN_GLOBAL',
                'ADMIN_SISTEMA',
            ],
            true
        );

        /*
         * Los usuarios institucionales necesitan
         * una entidad activa.
         */
        if (
            !$esAdministradorGlobal &&
            (
                !$usuario->entidad ||
                $usuario->entidad->estado !== 'Activo'
            )
        ) {
            return $this->cerrarSesion(
                $request,
                'La institución asociada a su usuario se encuentra deshabilitada. Comuníquese con el administrador del sistema.'
            );
        }

        return $next($request);
    }

    /**
     * Cerrar la sesión actual y redirigir al login.
     */
    private function cerrarSesion(
        Request $request,
        string $mensaje
    ): Response {
        Auth::logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return redirect()
            ->route('login')
            ->withErrors([
                'email' => $mensaje,
            ]);
    }
}