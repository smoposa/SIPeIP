<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

use App\Models\Entidad;
use App\Models\User;

class PlanesSeeder extends Seeder
{
    /**
     * Ejecutar el seeder de planes institucionales.
     */
    public function run(): void
    {
        DB::table('planes')->delete();

        DB::statement('ALTER TABLE planes AUTO_INCREMENT = 1;');

        $mtopId = Entidad::where(
            'codigoInstitucional',
            'MTOP'
        )->value('id');

        $analistaPlanificacionId = User::where(
            'email',
            'andrea.paredes@mtop.gob.ec'
        )->value('id');

        DB::table('planes')->insert([

            [
                'codigo' => 'PEI-MTOP-001',

                'nombre' => 'Plan Estratégico Institucional del Ministerio de Transporte y Obras Públicas',

                'entidad_id' => $mtopId,

                'tipo' => 'Plan Estratégico Institucional',

                'periodo_inicio' => 2026,

                'periodo_fin' => 2029,

                'descripcion' => 'Instrumento de planificación institucional que establece los objetivos estratégicos, indicadores, metas y lineamientos del Ministerio de Transporte y Obras Públicas para el período 2026 - 2029.',

                'estado' => 'Activo',

                'estado_proceso' => 'Borrador',

                'version' => 1,

                'usuario_id' => $analistaPlanificacionId,

                'created_at' => now(),

                'updated_at' => now(),
            ],

        ]);
    }
}