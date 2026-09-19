<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Ejecutar los seeders principales del sistema.
     */
    public function run(): void
    {
        $this->call([

            /*
            |--------------------------------------------------------------------------
            | CONFIGURACIÓN
            |--------------------------------------------------------------------------
            */

            RolesSeeder::class,
            EntidadesSeeder::class,
            UsersSeeder::class,


            /*
            |--------------------------------------------------------------------------
            | CATÁLOGOS - ODS
            |--------------------------------------------------------------------------
            */

            OdsSeeder::class,
            OdsMetaSeeder::class,


            /*
            |--------------------------------------------------------------------------
            | CATÁLOGOS - PND
            |--------------------------------------------------------------------------
            |
            | PndSeeder crea:
            | - Plan Nacional de Desarrollo
            | - Ejes
            | - Objetivos Nacionales
            |
            */

            PndSeeder::class,
            PndPoliticaSeeder::class,
            PndEstrategiaSeeder::class,
            PndMetaSeeder::class,


            /*
            |--------------------------------------------------------------------------
            | CATÁLOGOS - CLASIFICACIÓN DE LA INVERSIÓN
            |--------------------------------------------------------------------------
            |
            | ClasificacionInversionSeeder crea:
            | - Macrosectores
            | - Sectores
            | - Subsectores
            |
            */

            ClasificacionInversionSeeder::class,


            /*
            |--------------------------------------------------------------------------
            | PLANIFICACIÓN INSTITUCIONAL
            |--------------------------------------------------------------------------
            */

            PlanesSeeder::class,

        ]);
    }
}