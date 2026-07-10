<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class PlanesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('planes')->delete();
        DB::statement('ALTER TABLE planes AUTO_INCREMENT = 1;');

        DB::table('planes')->insert([

            [
                'codigo' => 'PEI-2026-2029',

                'nombre' => 'Plan Estratégico Institucional del Ministerio de Salud Pública',

                'entidad_id' => 2,

                'tipo' => 'Plan Estratégico Institucional',

                'periodo_inicio' => 2026,

                'periodo_fin' => 2029,

                'descripcion' => 'Instrumento de planificación institucional que establece los objetivos estratégicos, metas, indicadores, programas y proyectos del Ministerio de Salud Pública para el período 2026 - 2029.',

                'estado' => 'Activo',

                'usuario_id' => 1,

                'created_at' => now(),

                'updated_at' => now(),

            ],

        ]);
    }
}