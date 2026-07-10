<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class OdsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('ods')->delete();
        DB::statement('ALTER TABLE ods AUTO_INCREMENT = 1;');

        DB::table('ods')->insert([

            [
                'codigo' => 'ODS-01',
                'nombre' => 'Fin de la pobreza',
                'descripcion' => 'Poner fin a la pobreza en todas sus formas y en todo el mundo.',
                'estado' => 'Activo',
                'created_at' => now(),
                'updated_at' => now(),
            ],

            [
                'codigo' => 'ODS-02',
                'nombre' => 'Hambre cero',
                'descripcion' => 'Poner fin al hambre, lograr la seguridad alimentaria y promover la agricultura sostenible.',
                'estado' => 'Activo',
                'created_at' => now(),
                'updated_at' => now(),
            ],

            [
                'codigo' => 'ODS-03',
                'nombre' => 'Salud y bienestar',
                'descripcion' => 'Garantizar una vida sana y promover el bienestar para todas las personas en todas las edades.',
                'estado' => 'Activo',
                'created_at' => now(),
                'updated_at' => now(),
            ],

            [
                'codigo' => 'ODS-04',
                'nombre' => 'Educación de calidad',
                'descripcion' => 'Garantizar una educación inclusiva, equitativa y de calidad y promover oportunidades de aprendizaje durante toda la vida.',
                'estado' => 'Activo',
                'created_at' => now(),
                'updated_at' => now(),
            ],

            [
                'codigo' => 'ODS-05',
                'nombre' => 'Igualdad de género',
                'descripcion' => 'Lograr la igualdad entre los géneros y empoderar a todas las mujeres y las niñas.',
                'estado' => 'Activo',
                'created_at' => now(),
                'updated_at' => now(),
            ],

            [
                'codigo' => 'ODS-06',
                'nombre' => 'Agua limpia y saneamiento',
                'descripcion' => 'Garantizar la disponibilidad de agua, su gestión sostenible y el saneamiento para todos.',
                'estado' => 'Activo',
                'created_at' => now(),
                'updated_at' => now(),
            ],

            [
                'codigo' => 'ODS-07',
                'nombre' => 'Energía asequible y no contaminante',
                'descripcion' => 'Garantizar el acceso a una energía asequible, fiable, sostenible y moderna para todos.',
                'estado' => 'Activo',
                'created_at' => now(),
                'updated_at' => now(),
            ],

            [
                'codigo' => 'ODS-08',
                'nombre' => 'Trabajo decente y crecimiento económico',
                'descripcion' => 'Promover el crecimiento económico sostenido, inclusivo y sostenible, el empleo pleno y productivo y el trabajo decente para todos.',
                'estado' => 'Activo',
                'created_at' => now(),
                'updated_at' => now(),
            ],

            [
                'codigo' => 'ODS-09',
                'nombre' => 'Industria, innovación e infraestructura',
                'descripcion' => 'Construir infraestructuras resilientes, promover la industrialización sostenible y fomentar la innovación.',
                'estado' => 'Activo',
                'created_at' => now(),
                'updated_at' => now(),
            ],

            [
                'codigo' => 'ODS-10',
                'nombre' => 'Reducción de las desigualdades',
                'descripcion' => 'Reducir la desigualdad en y entre los países.',
                'estado' => 'Activo',
                'created_at' => now(),
                'updated_at' => now(),
            ],

            [
                'codigo' => 'ODS-11',
                'nombre' => 'Ciudades y comunidades sostenibles',
                'descripcion' => 'Lograr que las ciudades y los asentamientos humanos sean inclusivos, seguros, resilientes y sostenibles.',
                'estado' => 'Activo',
                'created_at' => now(),
                'updated_at' => now(),
            ],

            [
                'codigo' => 'ODS-12',
                'nombre' => 'Producción y consumo responsables',
                'descripcion' => 'Garantizar modalidades de consumo y producción sostenibles.',
                'estado' => 'Activo',
                'created_at' => now(),
                'updated_at' => now(),
            ],

            [
                'codigo' => 'ODS-13',
                'nombre' => 'Acción por el clima',
                'descripcion' => 'Adoptar medidas urgentes para combatir el cambio climático y sus efectos.',
                'estado' => 'Activo',
                'created_at' => now(),
                'updated_at' => now(),
            ],

            [
                'codigo' => 'ODS-14',
                'nombre' => 'Vida submarina',
                'descripcion' => 'Conservar y utilizar sosteniblemente los océanos, los mares y los recursos marinos.',
                'estado' => 'Activo',
                'created_at' => now(),
                'updated_at' => now(),
            ],

            [
                'codigo' => 'ODS-15',
                'nombre' => 'Vida de ecosistemas terrestres',
                'descripcion' => 'Gestionar sosteniblemente los bosques, luchar contra la desertificación y detener la pérdida de biodiversidad.',
                'estado' => 'Activo',
                'created_at' => now(),
                'updated_at' => now(),
            ],

            [
                'codigo' => 'ODS-16',
                'nombre' => 'Paz, justicia e instituciones sólidas',
                'descripcion' => 'Promover sociedades pacíficas e inclusivas, facilitar el acceso a la justicia y construir instituciones eficaces.',
                'estado' => 'Activo',
                'created_at' => now(),
                'updated_at' => now(),
            ],

            [
                'codigo' => 'ODS-17',
                'nombre' => 'Alianzas para lograr los objetivos',
                'descripcion' => 'Fortalecer los medios de implementación y revitalizar la Alianza Mundial para el Desarrollo Sostenible.',
                'estado' => 'Activo',
                'created_at' => now(),
                'updated_at' => now(),
            ],

        ]);
    }
}