<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
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
            | PLANIFICACIÓN INSTITUCIONAL
            |--------------------------------------------------------------------------
            */

            PlanesSeeder::class,

        ]);
    }
}