<?php

if (!function_exists('tienePermiso')) {

    function tienePermiso(string $modulo, string $accion = 'ver'): bool
    {
        if (!auth()->check()) {
            return false;
        }

        // Obtener el rol del usuario autenticado
        $rol = auth()->user()->rol;

        if (!$rol || $rol->estado !== 'Activo') {
            return false;
        }

        // Consultar los permisos asignados al rol
        return $rol->permisos->contains(function ($permiso) use ($modulo, $accion) {
            return $permiso->modulo === $modulo && $permiso->accion === $accion;
        });
    }

}


if (!function_exists('puedeVer')) {

    function puedeVer(string $modulo): bool
    {
        return tienePermiso($modulo, 'ver');
    }

}


if (!function_exists('puedeHacer')) {

    function puedeHacer(string $modulo, string $accion): bool
    {
        return tienePermiso($modulo, $accion);
    }

}
