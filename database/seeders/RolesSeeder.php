<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class RolesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('roles')->truncate();

        DB::table('roles')->insert([

            [
                'nombre' => 'Administrador del Sistema',
                'descripcion' => 'Administra la plataforma completa, incluyendo configuración, entidades, usuarios, roles y todos los módulos del sistema.',
                'estado' => 'Activo',
                'created_at' => now(),
                'updated_at' => now(),
            ],

            [
                'nombre' => 'Administrador Institucional',
                'descripcion' => 'Administra la configuración institucional, usuarios y parámetros propios de la entidad.',
                'estado' => 'Activo',
                'created_at' => now(),
                'updated_at' => now(),
            ],

            [
                'nombre' => 'Director de Planificación',
                'descripcion' => 'Supervisa y aprueba la planificación institucional, incluyendo planes, objetivos, metas e indicadores.',
                'estado' => 'Activo',
                'created_at' => now(),
                'updated_at' => now(),
            ],

            [
                'nombre' => 'Analista de Planificación',
                'descripcion' => 'Registra y actualiza planes, objetivos, metas e indicadores institucionales.',
                'estado' => 'Activo',
                'created_at' => now(),
                'updated_at' => now(),
            ],

            [
                'nombre' => 'Director de Inversión Pública',
                'descripcion' => 'Supervisa programas, proyectos y el seguimiento de la inversión pública institucional.',
                'estado' => 'Activo',
                'created_at' => now(),
                'updated_at' => now(),
            ],

            [
                'nombre' => 'Analista de Inversión Pública',
                'descripcion' => 'Registra y administra programas, proyectos y seguimiento de la inversión pública.',
                'estado' => 'Activo',
                'created_at' => now(),
                'updated_at' => now(),
            ],

            [
                'nombre' => 'Auditor Institucional',
                'descripcion' => 'Consulta la auditoría, historial de cambios y reportes para fines de control y seguimiento.',
                'estado' => 'Activo',
                'created_at' => now(),
                'updated_at' => now(),
            ],

            [
                'nombre' => 'Consulta Institucional',
                'descripcion' => 'Accede únicamente en modo consulta a la información autorizada de la institución.',
                'estado' => 'Activo',
                'created_at' => now(),
                'updated_at' => now(),
            ],

        ]);
    }
}