<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class PndSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('pnd')->delete();
        DB::statement('ALTER TABLE pnd AUTO_INCREMENT = 1;');

        DB::table('pnd')->insert([

            [
                'eje' => 'Eje Social',
                'codigo' => 'PND-01',
                'nombre' => 'Mejorar las condiciones de vida de la población de forma integral.',
                'descripcion' => 'Promover políticas públicas orientadas al bienestar integral de la población.',
                'estado' => 'Activo',
                'created_at' => now(),
                'updated_at' => now(),
            ],

            [
                'eje' => 'Eje Social',
                'codigo' => 'PND-02',
                'nombre' => 'Garantizar el acceso oportuno, equitativo y de calidad a los servicios de salud.',
                'descripcion' => 'Promover políticas públicas que aseguren el acceso universal a los servicios de salud.',
                'estado' => 'Activo',
                'created_at' => now(),
                'updated_at' => now(),
            ],

            [
                'eje' => 'Eje Social',
                'codigo' => 'PND-03',
                'nombre' => 'Fortalecer la educación y el desarrollo del talento humano.',
                'descripcion' => 'Impulsar una educación inclusiva y de calidad para el desarrollo del talento humano.',
                'estado' => 'Activo',
                'created_at' => now(),
                'updated_at' => now(),
            ],

            [
                'eje' => 'Desarrollo Económico',
                'codigo' => 'PND-04',
                'nombre' => 'Impulsar el crecimiento económico sostenible y la productividad.',
                'descripcion' => 'Fomentar políticas que impulsen la productividad y el crecimiento económico sostenible.',
                'estado' => 'Activo',
                'created_at' => now(),
                'updated_at' => now(),
            ],

            [
                'eje' => 'Desarrollo Económico',
                'codigo' => 'PND-05',
                'nombre' => 'Promover el empleo digno y el fortalecimiento del sector productivo.',
                'descripcion' => 'Fortalecer el empleo digno mediante el desarrollo del sector productivo nacional.',
                'estado' => 'Activo',
                'created_at' => now(),
                'updated_at' => now(),
            ],

            [
                'eje' => 'Infraestructura, Energía y Medio Ambiente',
                'codigo' => 'PND-06',
                'nombre' => 'Fortalecer la infraestructura estratégica y la sostenibilidad ambiental.',
                'descripcion' => 'Impulsar infraestructura resiliente y proteger el medio ambiente.',
                'estado' => 'Activo',
                'created_at' => now(),
                'updated_at' => now(),
            ],

            [
                'eje' => 'Infraestructura, Energía y Medio Ambiente',
                'codigo' => 'PND-07',
                'nombre' => 'Garantizar la gestión sostenible de los recursos naturales y energéticos.',
                'descripcion' => 'Promover el uso eficiente y sostenible de los recursos naturales y energéticos.',
                'estado' => 'Activo',
                'created_at' => now(),
                'updated_at' => now(),
            ],

            [
                'eje' => 'Eje Institucional',
                'codigo' => 'PND-08',
                'nombre' => 'Fortalecer la transparencia y la eficiencia del Estado.',
                'descripcion' => 'Promover una gestión pública transparente, eficiente y orientada a resultados.',
                'estado' => 'Activo',
                'created_at' => now(),
                'updated_at' => now(),
            ],

            [
                'eje' => 'Eje Institucional',
                'codigo' => 'PND-09',
                'nombre' => 'Mejorar la seguridad, la gobernabilidad y la participación ciudadana.',
                'descripcion' => 'Fortalecer la seguridad ciudadana y la participación democrática.',
                'estado' => 'Activo',
                'created_at' => now(),
                'updated_at' => now(),
            ],

            [
                'eje' => 'Eje Institucional',
                'codigo' => 'PND-10',
                'nombre' => 'Impulsar la transformación digital y la modernización de la gestión pública.',
                'descripcion' => 'Modernizar el Estado mediante la transformación digital y la innovación pública.',
                'estado' => 'Activo',
                'created_at' => now(),
                'updated_at' => now(),
            ],

        ]);
    }
}