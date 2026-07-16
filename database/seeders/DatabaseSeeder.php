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

            // Configuración
            RolesSeeder::class,
            EntidadesSeeder::class,
            UsersSeeder::class,

            // Catálogos
            OdsSeeder::class,
            OdsMetaSeeder::class,

            PndSeeder::class,
            PndPoliticaSeeder::class,

            // Planificación
            PlanesSeeder::class,

        ]);
    }
}