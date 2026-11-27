<?php

namespace Database\Seeders;

use App\Models\Permiso;
use App\Models\Rol;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use RuntimeException;

class RolPermisoSeeder extends Seeder
{
    /**
     * Trasladar las asignaciones existentes de permisos a la base de datos.
     */
    public function run(): void
    {
        DB::transaction(function () {
            if (DB::table('rol_permiso')->exists()) {
                throw new RuntimeException('Ya existen asignaciones de permisos. No se realizará una nueva carga.');
            }

            $roles = Rol::whereNotNull('codigo')->get()->keyBy('codigo');
            $modulos = config('permisos.modulos', []);
            $acciones = config('permisos.acciones', []);

            foreach ($modulos as $modulo => $codigos) {
                $this->asignarPermiso($roles, $modulo, 'ver', $codigos);
            }

            foreach ($acciones as $modulo => $permisos) {
                foreach ($permisos as $accion => $codigos) {
                    $this->asignarPermiso($roles, $modulo, $accion, $codigos);
                }
            }
        });
    }

    /**
     * Asignar un permiso a los roles definidos en la configuración actual.
     */
    private function asignarPermiso($roles, string $modulo, string $accion, array $codigos): void
    {
        $permiso = Permiso::where('modulo', $modulo)
            ->where('accion', $accion)
            ->firstOrFail();

        foreach ($codigos as $codigo) {
            $rol = $roles->get($codigo);

            if (!$rol) {
                throw new RuntimeException('No se encontró el rol: ' . $codigo);
            }

            $rol->permisos()->syncWithoutDetaching([$permiso->id]);
        }
    }
}
