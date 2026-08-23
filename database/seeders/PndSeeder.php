<?php

namespace Database\Seeders;

use App\Models\Pnd;
use App\Models\PndEje;
use App\Models\PndObjetivo;
use Illuminate\Database\Seeder;

class PndSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        /*
        |--------------------------------------------------------------------------
        | PLAN NACIONAL DE DESARROLLO
        |--------------------------------------------------------------------------
        */

        $pnd = Pnd::create([
            'nombre' => 'Plan de Desarrollo para el Nuevo Ecuador',
            'periodo_inicio' => 2024,
            'periodo_fin' => 2025,
            'descripcion' => 'Plan Nacional de Desarrollo del Ecuador para el período 2024-2025.',
            'estado' => 'Activo',
        ]);

        /*
        |--------------------------------------------------------------------------
        | EJES DEL PND
        |--------------------------------------------------------------------------
        */

        $ejes = [
            [
                'numero' => 1,
                'nombre' => 'Social',
                'descripcion' => 'Eje orientado a mejorar la calidad de vida de la población y garantizar derechos y servicios públicos.',
            ],
            [
                'numero' => 2,
                'nombre' => 'Desarrollo Económico',
                'descripcion' => 'Eje orientado al impulso productivo, la innovación, la inversión y el fortalecimiento económico.',
            ],
            [
                'numero' => 3,
                'nombre' => 'Infraestructura, Energía y Medio Ambiente',
                'descripcion' => 'Eje orientado a infraestructura, energía y uso responsable de los recursos naturales.',
            ],
            [
                'numero' => 4,
                'nombre' => 'Institucional',
                'descripcion' => 'Eje orientado a fortalecer la transparencia, eficiencia y calidad de las instituciones públicas.',
            ],
            [
                'numero' => 5,
                'nombre' => 'Gestión de Riesgos',
                'descripcion' => 'Eje orientado a promover la resiliencia de ciudades y comunidades frente a riesgos naturales y antrópicos.',
            ],
        ];

        $ejesCreados = [];

        foreach ($ejes as $eje) {
            $ejeCreado = PndEje::create([
                'pnd_id' => $pnd->id,
                'numero' => $eje['numero'],
                'nombre' => $eje['nombre'],
                'descripcion' => $eje['descripcion'],
            ]);

            $ejesCreados[$eje['numero']] = $ejeCreado;
        }

        /*
        |--------------------------------------------------------------------------
        | OBJETIVOS NACIONALES
        |--------------------------------------------------------------------------
        */

        $objetivos = [
            [
                'eje' => 1,
                'numero' => 1,
                'nombre' => 'Mejorar las condiciones de vida de la población de forma integral, promoviendo el acceso equitativo a salud, vivienda y bienestar social',
            ],
            [
                'eje' => 1,
                'numero' => 2,
                'nombre' => 'Impulsar las capacidades de la ciudadanía con educación equitativa e inclusiva de calidad y promoviendo espacios de intercambio cultural',
            ],
            [
                'eje' => 1,
                'numero' => 3,
                'nombre' => 'Garantizar la seguridad integral, la paz ciudadana y transformar el sistema de justicia respetando los derechos humanos',
            ],

            [
                'eje' => 2,
                'numero' => 4,
                'nombre' => 'Estimular el sistema económico y de finanzas públicas para dinamizar la inversión y las relaciones comerciales',
            ],
            [
                'eje' => 2,
                'numero' => 5,
                'nombre' => 'Fomentar de manera sustentable la producción mejorando los niveles de productividad',
            ],
            [
                'eje' => 2,
                'numero' => 6,
                'nombre' => 'Incentivar la generación de empleo digno',
            ],

            [
                'eje' => 3,
                'numero' => 7,
                'nombre' => 'Precautelar el uso responsable de los recursos naturales con un entorno ambientalmente sostenible',
            ],
            [
                'eje' => 3,
                'numero' => 8,
                'nombre' => 'Impulsar la conectividad como fuente de desarrollo y crecimiento económico y sostenible',
            ],

            [
                'eje' => 4,
                'numero' => 9,
                'nombre' => 'Propender la construcción de un Estado eficiente, transparente y orientado al bienestar social',
            ],

            [
                'eje' => 5,
                'numero' => 10,
                'nombre' => 'Promover la resiliencia de ciudades y comunidades para enfrentar los riesgos de origen natural y antrópico',
            ],
        ];

        foreach ($objetivos as $objetivo) {
            PndObjetivo::create([
                'pnd_eje_id' => $ejesCreados[$objetivo['eje']]->id,
                'numero' => $objetivo['numero'],
                'nombre' => $objetivo['nombre'],
                'descripcion' => null,
            ]);
        }
    }
}