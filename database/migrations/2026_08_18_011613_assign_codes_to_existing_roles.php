<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    /**
     * Asignar códigos técnicos a los roles oficiales existentes.
     */
    public function up(): void
    {
        $roles = [
            'Administrador del Sistema' => 'ADMIN_SISTEMA',
            'Administrador Institucional' => 'ADMIN_INSTITUCIONAL',
            'Director de Planificación' => 'DIRECTOR_PLANIFICACION',
            'Analista de Planificación' => 'ANALISTA_PLANIFICACION',
            'Director de Inversión Pública' => 'DIRECTOR_INVERSION',
            'Analista de Inversión Pública' => 'ANALISTA_INVERSION',
            'Auditor Institucional' => 'AUDITOR_INSTITUCIONAL',
            'Consulta Institucional' => 'CONSULTA_INSTITUCIONAL',
            'Administrador Global' => 'ADMIN_GLOBAL',
        ];

        foreach ($roles as $nombre => $codigo) {
            DB::table('roles')
                ->where('nombre', $nombre)
                ->update([
                    'codigo' => $codigo,
                    'updated_at' => now(),
                ]);
        }
    }

    /**
     * Revertir la asignación de códigos.
     */
    public function down(): void
    {
        DB::table('roles')
            ->whereIn('codigo', [
                'ADMIN_SISTEMA',
                'ADMIN_INSTITUCIONAL',
                'DIRECTOR_PLANIFICACION',
                'ANALISTA_PLANIFICACION',
                'DIRECTOR_INVERSION',
                'ANALISTA_INVERSION',
                'AUDITOR_INSTITUCIONAL',
                'CONSULTA_INSTITUCIONAL',
                'ADMIN_GLOBAL',
            ])
            ->update([
                'codigo' => null,
                'updated_at' => now(),
            ]);
    }
};