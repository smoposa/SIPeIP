<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class PermisosSeeder extends Seeder
{
    /**
     * Registrar los permisos definidos en la configuración actual.
     */
    public function run(): void
    {
        DB::transaction(function () {
            $modulos = config('permisos.modulos', []);
            $acciones = config('permisos.acciones', []);

            foreach ($modulos as $modulo => $roles) {
                $this->registrarPermiso($modulo, 'ver');
            }

            foreach ($acciones as $modulo => $permisos) {
                foreach ($permisos as $accion => $roles) {
                    $this->registrarPermiso($modulo, $accion);
                }
            }
        });
    }

    /**
     * Registrar un permiso sin duplicar los registros existentes.
     */
    private function registrarPermiso(string $modulo, string $accion): void
    {
        $existe = DB::table('permisos')
            ->where('modulo', $modulo)
            ->where('accion', $accion)
            ->exists();

        if (! $existe) {
            DB::table('permisos')->insert([
                'modulo' => $modulo,
                'accion' => $accion,
                'nombre' => ucfirst(str_replace('_', ' ', $accion)) . ' ' . str_replace('_', ' ', $modulo),
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }
    }
}
