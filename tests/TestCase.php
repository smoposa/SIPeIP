<?php

namespace Tests;

use App\Models\Rol;
use Database\Seeders\PermisosSeeder;
use Illuminate\Foundation\Testing\TestCase as BaseTestCase;

abstract class TestCase extends BaseTestCase
{
    use CreatesApplication;

    /**
     * Asignar los permisos correspondientes a un rol de prueba.
     */
    protected function asignarPermisosRol(Rol $rol): void
    {
        $this->seed(PermisosSeeder::class);

        $permisos = \App\Models\Permiso::all()
            ->filter(function ($permiso) use ($rol) {
                $roles = $permiso->accion === 'ver'
                    ? config("permisos.modulos.{$permiso->modulo}", [])
                    : config("permisos.acciones.{$permiso->modulo}.{$permiso->accion}", []);

                return in_array($rol->codigo, $roles, true);
            });

        $rol->permisos()->sync(
            $permisos->pluck('id')->all()
        );
    }
}