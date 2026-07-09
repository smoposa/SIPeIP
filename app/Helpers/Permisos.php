<?php

if (!function_exists('tienePermiso')) {

    function tienePermiso(string $modulo, string $accion = 'ver'): bool
    {
        if (!auth()->check()) {
            return false;
        }

        $rol = auth()->user()->rol?->nombre;

        if (!$rol) {
            return false;
        }

        // Permisos para visualizar módulos
        if ($accion === 'ver') {
            $rolesPermitidos = config("permisos.modulos.$modulo", []);
        } else {
            // Permisos para acciones (crear, editar, etc.)
            $rolesPermitidos = config("permisos.acciones.$modulo.$accion", []);
        }

        return in_array($rol, $rolesPermitidos);
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