<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class RolesSeeder extends Seeder
{
    /**
     * Ejecutar el seeder de roles oficiales del sistema.
     */
    public function run(): void
    {
        $roles = [

            [
                'codigo' => 'ADMIN_GLOBAL',
                'nombre' => 'Administrador Global',
                'descripcion' => 'Administra la configuración global de la plataforma, incluyendo roles, entidades, usuarios y catálogos generales del sistema.',
                'estado' => 'Activo',
            ],

            [
                'codigo' => 'ADMIN_SISTEMA',
                'nombre' => 'Administrador del Sistema',
                'descripcion' => 'Administra la configuración y operación del sistema de acuerdo con los permisos asignados.',
                'estado' => 'Activo',
            ],

            [
                'codigo' => 'ADMIN_INSTITUCIONAL',
                'nombre' => 'Administrador Institucional',
                'descripcion' => 'Administra la configuración institucional, usuarios y parámetros propios de la entidad.',
                'estado' => 'Activo',
            ],

            [
                'codigo' => 'DIRECTOR_PLANIFICACION',
                'nombre' => 'Director de Planificación',
                'descripcion' => 'Supervisa y aprueba la planificación institucional, incluyendo planes, objetivos, metas e indicadores.',
                'estado' => 'Activo',
            ],

            [
                'codigo' => 'ANALISTA_PLANIFICACION',
                'nombre' => 'Analista de Planificación',
                'descripcion' => 'Registra y actualiza planes, objetivos, metas e indicadores institucionales.',
                'estado' => 'Activo',
            ],

            [
                'codigo' => 'DIRECTOR_INVERSION',
                'nombre' => 'Director de Inversión Pública',
                'descripcion' => 'Supervisa programas, proyectos y el seguimiento de la inversión pública institucional.',
                'estado' => 'Activo',
            ],

            [
                'codigo' => 'ANALISTA_INVERSION',
                'nombre' => 'Analista de Inversión Pública',
                'descripcion' => 'Registra y administra programas, proyectos y seguimiento de la inversión pública.',
                'estado' => 'Activo',
            ],

            [
                'codigo' => 'AUDITOR_INSTITUCIONAL',
                'nombre' => 'Auditor Institucional',
                'descripcion' => 'Consulta la auditoría, historial de cambios y reportes para fines de control y seguimiento institucional.',
                'estado' => 'Activo',
            ],

            [
                'codigo' => 'CONSULTA_INSTITUCIONAL',
                'nombre' => 'Consulta Institucional',
                'descripcion' => 'Accede únicamente en modo consulta a la información autorizada de su institución.',
                'estado' => 'Activo',
            ],

        ];

        foreach ($roles as $rol) {

            $rolExistente = DB::table('roles')
                ->where('codigo', $rol['codigo'])
                ->orWhere('nombre', $rol['nombre'])
                ->first();

            if ($rolExistente) {

                DB::table('roles')
                    ->where('id', $rolExistente->id)
                    ->update([
                        'codigo' => $rol['codigo'],
                        'nombre' => $rol['nombre'],
                        'descripcion' => $rol['descripcion'],
                        'estado' => $rol['estado'],
                        'updated_at' => now(),
                    ]);

            } else {

                DB::table('roles')->insert([
                    'codigo' => $rol['codigo'],
                    'nombre' => $rol['nombre'],
                    'descripcion' => $rol['descripcion'],
                    'estado' => $rol['estado'],
                    'created_at' => now(),
                    'updated_at' => now(),
                ]);

            }
        }
    }
}