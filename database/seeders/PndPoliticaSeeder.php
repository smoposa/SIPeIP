<?php

namespace Database\Seeders;

use App\Models\PndObjetivo;
use App\Models\PndPolitica;
use Illuminate\Database\Seeder;

class PndPoliticaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        /*
        |--------------------------------------------------------------------------
        | OBJETIVOS NACIONALES
        |--------------------------------------------------------------------------
        */

        $objetivos = PndObjetivo::query()
            ->whereIn('numero', range(1, 10))
            ->get()
            ->keyBy('numero');

        /*
        |--------------------------------------------------------------------------
        | POLÍTICAS DEL PND
        |--------------------------------------------------------------------------
        */

        $politicas = [

            // ================================================================
            // OBJETIVO 1
            // ================================================================

            [
                'objetivo' => 1,
                'codigo' => '1.1',
                'nombre' => 'Contribuir a la reducción de la pobreza y pobreza extrema',
            ],
            [
                'objetivo' => 1,
                'codigo' => '1.2',
                'nombre' => 'Garantizar la inclusión social de las personas y grupos de atención prioritaria durante su ciclo de vida',
            ],
            [
                'objetivo' => 1,
                'codigo' => '1.3',
                'nombre' => 'Mejorar la prestación de los servicios de salud de manera integral, mediante la promoción, prevención, atención primaria, tratamiento, rehabilitación y cuidados paliativos, con talento humano suficiente y fortalecido, enfatizando la atención a grupos prioritarios y todos aquellos en situación de vulnerabilidad',
            ],
            [
                'objetivo' => 1,
                'codigo' => '1.4',
                'nombre' => 'Fortalecer la vigilancia, prevención y control de enfermedades transmisibles y no transmisibles',
            ],
            [
                'objetivo' => 1,
                'codigo' => '1.5',
                'nombre' => 'Garantizar el acceso a la información, educación integral de la sexualidad y servicios de salud sexual y reproductiva de calidad, para el pleno ejercicio de los derechos sexuales y reproductivos de la población',
            ],
            [
                'objetivo' => 1,
                'codigo' => '1.6',
                'nombre' => 'Promover el buen uso del tiempo libre en la población ecuatoriana a través de la práctica de actividad física',
            ],
            [
                'objetivo' => 1,
                'codigo' => '1.7',
                'nombre' => 'Implementar programas de prevención y promoción que aborden los determinantes de la salud alrededor de los diferentes problemas de malnutrición en toda la población, con énfasis en desnutrición crónica infantil',
            ],
            [
                'objetivo' => 1,
                'codigo' => '1.8',
                'nombre' => 'Garantizar el derecho a una vivienda adecuada y promover entornos habitables, seguros y saludables mediante acciones integrales, coordinadas y participativas, que contribuyan al fomento y desarrollo de ciudades y comunidades inclusivas, seguras, resilientes y sostenibles',
            ],
            [
                'objetivo' => 1,
                'codigo' => '1.9',
                'nombre' => 'Promover la inclusión social, el ejercicio de derechos y la no discriminación de los Pueblos y Nacionalidades',
            ],
            [
                'objetivo' => 1,
                'codigo' => '1.10',
                'nombre' => 'Fortalecer la bioeconomía de los Pueblos y Nacionalidades',
            ],

            // ================================================================
            // OBJETIVO 2
            // ================================================================

            [
                'objetivo' => 2,
                'codigo' => '2.1',
                'nombre' => 'Garantizar el acceso universal a una educación, inclusiva, equitativa, pertinente e intercultural para niños, niñas, adolescentes, jóvenes y adultos, promoviendo la permanencia y culminación de sus estudios; y asegurando su movilidad dentro del Sistema Nacional de Educación',
            ],
            [
                'objetivo' => 2,
                'codigo' => '2.2',
                'nombre' => 'Promover una educación de calidad con un enfoque innovador, competencial, inclusivo, resiliente y participativo, que fortalezca las habilidades cognitivas, socioemocionales, comunicacionales, digitales y para la vida práctica; sin discriminación y libre de todo tipo de violencia, apoyados con procesos de evaluación integral para la mejora continua',
            ],
            [
                'objetivo' => 2,
                'codigo' => '2.3',
                'nombre' => 'Fortalecer el sistema de educación superior a través del mejoramiento del acceso, permanencia y titularización con criterios de democracia, calidad y meritocracia',
            ],
            [
                'objetivo' => 2,
                'codigo' => '2.4',
                'nombre' => 'Desarrollar el sistema de educación superior a través de nuevas modalidades de estudio, carreras y profundización de la educación técnica tecnológica como mecanismo para la profesionalización de la población',
            ],
            [
                'objetivo' => 2,
                'codigo' => '2.5',
                'nombre' => 'Fomentar la investigación, desarrollo e innovación (I+D+i) con el acceso a fondos concursables de investigación científica, la creación de comunidades científicas de apoyo y la inclusión de actores de los saberes ancestrales',
            ],
            [
                'objetivo' => 2,
                'codigo' => '2.6',
                'nombre' => 'Promover la conservación, salvaguardia y desarrollo del patrimonio material e inmaterial',
            ],
            [
                'objetivo' => 2,
                'codigo' => '2.7',
                'nombre' => 'Impulsar la creación artística y las industrias culturales',
            ],
            [
                'objetivo' => 2,
                'codigo' => '2.8',
                'nombre' => 'Garantizar la preparación integral de los atletas de alto rendimiento y reserva deportiva, para alcanzar logros deportivos',
            ],

            // ================================================================
            // OBJETIVO 3
            // ================================================================

            [
                'objetivo' => 3,
                'codigo' => '3.1',
                'nombre' => 'Prever, prevenir y controlar, con pertinencia territorial, los fenómenos de violencia y delincuencia que afectan a la ciudadanía y sus derechos, fortaleciendo la convivencia pacífica',
            ],
            [
                'objetivo' => 3,
                'codigo' => '3.2',
                'nombre' => 'Contrarrestar las economías criminales, fortaleciendo las acciones de investigación, persecución y control de la delincuencia organizada, el narcotráfico, la minería ilegal, el control migratorio, apoyando a la consolidación y sostenibilidad del sistema económico',
            ],
            [
                'objetivo' => 3,
                'codigo' => '3.3',
                'nombre' => 'Fortalecer a las instituciones y entidades de la defensa para garantizar la soberanía, integridad territorial y contribuir a la paz y seguridad internacional',
            ],
            [
                'objetivo' => 3,
                'codigo' => '3.4',
                'nombre' => 'Fortalecer la acción interinstitucional y el relacionamiento con la sociedad para contribuir a la seguridad integral y al desarrollo nacional',
            ],
            [
                'objetivo' => 3,
                'codigo' => '3.5',
                'nombre' => 'Fortalecer el ejercicio de los derechos de las personas que se encuentran en situación de movilidad humana',
            ],
            [
                'objetivo' => 3,
                'codigo' => '3.6',
                'nombre' => 'Generar inteligencia y actividades de contrainteligencia que permitan proteger a los elementos estructurales del Estado',
            ],
            [
                'objetivo' => 3,
                'codigo' => '3.7',
                'nombre' => 'Fomentar una cultura de inteligencia a nivel nacional para mejorar el conocimiento y aporte de la sociedad a la seguridad integral del Estado',
            ],
            [
                'objetivo' => 3,
                'codigo' => '3.8',
                'nombre' => 'Fortalecer la seguridad de los Centros de Privación de la Libertad y Centros de Adolescentes Infractores y la protección de las personas privadas de la libertad y adolescentes infractores a través de la prevención, control y mantenimiento del orden interno, en el marco del debido proceso y respeto a los derechos humanos',
            ],
            [
                'objetivo' => 3,
                'codigo' => '3.9',
                'nombre' => 'Fortalecer los procesos de rehabilitación social y reeducación de adolescentes infractores, garantizando los derechos de las personas privadas de libertad y de adolescentes infractores',
            ],
            [
                'objetivo' => 3,
                'codigo' => '3.10',
                'nombre' => 'Impulsar la reducción de riesgo de desastres y atención oportuna a emergencias ante amenazas naturales o antrópicas en todos los sectores y niveles territoriales',
            ],
            [
                'objetivo' => 3,
                'codigo' => '3.11',
                'nombre' => 'Fomentar la cultura de prevención de riesgos de desastres y la resiliencia comunitaria',
            ],
            [
                'objetivo' => 3,
                'codigo' => '3.12',
                'nombre' => 'Contribuir al fortalecimiento de la ciberseguridad en el sector de las telecomunicaciones',
            ],
            [
                'objetivo' => 3,
                'codigo' => '3.13',
                'nombre' => 'Incrementar la efectividad de los mecanismos de promoción y reparación de derechos humanos, mediante el cumplimiento de las obligaciones nacionales e internacionales en esta materia',
            ],
            [
                'objetivo' => 3,
                'codigo' => '3.14',
                'nombre' => 'Reducir la discriminación y violencia basada en género mediante la prevención, atención y protección integral a la población ecuatoriana y extranjera residente dentro del territorio ecuatoriano, especialmente a la población vulnerable integrada por mujeres, niños, niñas, adolescentes, y personas LGBTIQ+',
            ],
            [
                'objetivo' => 3,
                'codigo' => '3.15',
                'nombre' => 'Institucionalizar la transparencia e integridad en la Función Judicial, facilitar el control social y asegurar el óptimo acceso a los servicios de justicia',
            ],
            [
                'objetivo' => 3,
                'codigo' => '3.16',
                'nombre' => 'Garantizar la prestación gratuita de los servicios defensoriales para el ejercicio de los derechos de la ciudadanía',
            ],

            // ================================================================
            // OBJETIVO 4
            // ================================================================

            [
                'objetivo' => 4,
                'codigo' => '4.1',
                'nombre' => 'Profundizar la inserción estratégica de Ecuador en la comunidad internacional para contribuir al crecimiento y desarrollo económico',
            ],
            [
                'objetivo' => 4,
                'codigo' => '4.2',
                'nombre' => 'Incrementar la apertura comercial con socios estratégicos y con países que constituyan mercados potenciales',
            ],
            [
                'objetivo' => 4,
                'codigo' => '4.3',
                'nombre' => 'Generar un clima adecuado de negocios para la atracción y mantenimiento de inversiones',
            ],
            [
                'objetivo' => 4,
                'codigo' => '4.4',
                'nombre' => 'Incrementar el uso de procesos competitivos de contratación pública de régimen común',
            ],
            [
                'objetivo' => 4,
                'codigo' => '4.5',
                'nombre' => 'Incluir progresivamente criterios de sostenibilidad en los procesos de compras públicas en Ecuador',
            ],
            [
                'objetivo' => 4,
                'codigo' => '4.6',
                'nombre' => 'Fortalecer un sistema tributario de forma progresiva, equitativa y eficiente',
            ],
            [
                'objetivo' => 4,
                'codigo' => '4.7',
                'nombre' => 'Fortalecer un sistema de finanzas públicas eficiente y sostenible',
            ],
            [
                'objetivo' => 4,
                'codigo' => '4.8',
                'nombre' => 'Fortalecer la dolarización, consolidar el acceso a financiamiento y promover la regulación financiera',
            ],
            [
                'objetivo' => 4,
                'codigo' => '4.9',
                'nombre' => 'Establecer el entorno normativo e institucional para atraer, facilitar, estructurar, concretar y proteger las inversiones en Asociaciones Público-Privadas',
            ],

            // ================================================================
            // OBJETIVO 5
            // ================================================================

            [
                'objetivo' => 5,
                'codigo' => '5.1',
                'nombre' => 'Incrementar la oferta del sector agropecuario para satisfacer la demanda nacional e internacional de productos tradicionales y no tradicionales de calidad',
            ],
            [
                'objetivo' => 5,
                'codigo' => '5.2',
                'nombre' => 'Fortalecer los sistemas agroalimentarios y prácticas innovadoras que propendan a la sostenibilidad ambiental',
            ],
            [
                'objetivo' => 5,
                'codigo' => '5.3',
                'nombre' => 'Incrementar la productividad, desarrollo y la diversificación de la producción acuícola y pesquera, incentivando el uso de tecnologías modernas y limpias',
            ],
            [
                'objetivo' => 5,
                'codigo' => '5.4',
                'nombre' => 'Posicionar al destino Ecuador en el mercado nacional e internacional en función del desarrollo equilibrado de la oferta turística, generación de alianzas estratégicas y la gestión integral del territorio',
            ],
            [
                'objetivo' => 5,
                'codigo' => '5.5',
                'nombre' => 'Fomentar la productividad, competitividad, comercialización, industrialización y generación de valor agregado en el sector agroindustrial, industrial y manufacturero a nivel nacional',
            ],

            // ================================================================
            // OBJETIVO 6
            // ================================================================

            [
                'objetivo' => 6,
                'codigo' => '6.1',
                'nombre' => 'Fomentar las oportunidades de empleo digno de manera inclusiva garantizando el cumplimiento de derechos laborales',
            ],
            [
                'objetivo' => 6,
                'codigo' => '6.2',
                'nombre' => 'Incentivar el desarrollo sostenible de las unidades productivas (MIPYMES)',
            ],
            [
                'objetivo' => 6,
                'codigo' => '6.3',
                'nombre' => 'Impulsar la generación de empleo a través de mecanismos de crecimiento y expansión de empresas con pertinencia territorial',
            ],
            [
                'objetivo' => 6,
                'codigo' => '6.4',
                'nombre' => 'Desarrollar las capacidades de los jóvenes de 18 a 29 años para promover su inserción laboral',
            ],
            [
                'objetivo' => 6,
                'codigo' => '6.5',
                'nombre' => 'Garantizar la igualdad de remuneración y/o retribución económica entre hombres y mujeres por un trabajo de igual valor',
            ],

            // ================================================================
            // OBJETIVO 7
            // ================================================================

            [
                'objetivo' => 7,
                'codigo' => '7.1',
                'nombre' => 'Garantizar la sostenibilidad en el continuo abastecimiento de energía eléctrica en el Ecuador, con el aprovechamiento óptimo de los recursos naturales con los que cuenta el país; y, propender el uso racional y eficiente de la energía eléctrica por parte de los consumidores',
            ],
            [
                'objetivo' => 7,
                'codigo' => '7.2',
                'nombre' => 'Garantizar el manejo eficiente de los recursos naturales no renovables, a través del uso de tecnologías sostenibles, que permitan optimizar la producción nacional de hidrocarburos, y demás actividades de la cadena de valor del sector, con responsabilidad social y ambiental',
            ],
            [
                'objetivo' => 7,
                'codigo' => '7.3',
                'nombre' => 'Fortalecer el desarrollo responsable del sector minero a través de estrategias integrales que involucren la sostenibilidad ambiental y social e impulsen el crecimiento económico del país',
            ],
            [
                'objetivo' => 7,
                'codigo' => '7.4',
                'nombre' => 'Conservar y restaurar los recursos naturales renovables terrestres y marinos, fomentando modelos de desarrollo sostenibles, bajos en emisiones y resilientes a los efectos adversos del cambio climático',
            ],
            [
                'objetivo' => 7,
                'codigo' => '7.5',
                'nombre' => 'Promover la articulación de la gestión ambiental, del cambio climático y la reducción del riesgo de desastres',
            ],
            [
                'objetivo' => 7,
                'codigo' => '7.6',
                'nombre' => 'Fortalecer la resiliencia de las infraestructuras para garantizar la seguridad de los usuarios ante riesgos y peligros',
            ],
            [
                'objetivo' => 7,
                'codigo' => '7.7',
                'nombre' => 'Promover la gestión integral e integrada del recurso hídrico y su conservación, fomentando el derecho humano al agua potable en cantidad y calidad, y su saneamiento; así como, el riego y drenaje en un entorno adaptativo a los efectos del cambio climático',
            ],

            // ================================================================
            // OBJETIVO 8
            // ================================================================

            [
                'objetivo' => 8,
                'codigo' => '8.1',
                'nombre' => 'Mejorar la conectividad digital y el acceso a nuevas tecnologías para la población',
            ],
            [
                'objetivo' => 8,
                'codigo' => '8.2',
                'nombre' => 'Optimizar las infraestructuras construidas, capacidades instaladas y de gestión del transporte multimodal, para una movilización nacional e internacional de personas, bienes y mercancías de manera sostenible, oportuna y segura',
            ],

            // ================================================================
            // OBJETIVO 9
            // ================================================================

            [
                'objetivo' => 9,
                'codigo' => '9.1',
                'nombre' => 'Fomentar la participación ciudadana con enfoques de igualdad, en todos los niveles de gobierno y funciones del Estado, que permita realizar el monitoreo y evaluación de la gestión pública, fortaleciendo la rendición de cuentas',
            ],
            [
                'objetivo' => 9,
                'codigo' => '9.2',
                'nombre' => 'Impulsar el Gobierno Abierto que propicie la transparencia y el acceso de información oportuna y cercana a la ciudadanía',
            ],
            [
                'objetivo' => 9,
                'codigo' => '9.3',
                'nombre' => 'Fomentar buenas prácticas regulatorias y la simplificación normativa y administrativa que promueva la innovación de la gestión pública',
            ],
            [
                'objetivo' => 9,
                'codigo' => '9.4',
                'nombre' => 'Diseñar mecanismos interinstitucionales de identificación, prevención y gestión de conflictos para su implementación en la Función Ejecutiva',
            ],
            [
                'objetivo' => 9,
                'codigo' => '9.5',
                'nombre' => 'Consolidar los Consejos Ciudadanos Sectoriales de la Función Ejecutiva, involucrando a las organizaciones sociales, en los procesos de diálogo, deliberación, seguimiento y evaluación de las políticas públicas de carácter ministerial y sectorial, a fin de garantizar la gobernabilidad',
            ],
            [
                'objetivo' => 9,
                'codigo' => '9.6',
                'nombre' => 'Fortalecer las capacidades del Estado que garanticen la transparencia, eficiencia, calidad y excelencia de los servicios públicos',
            ],
            [
                'objetivo' => 9,
                'codigo' => '9.7',
                'nombre' => 'Ampliar y fortalecer la cooperación internacional para el desarrollo sostenible del Ecuador en función de las prioridades determinadas por el Gobierno Nacional',
            ],
            [
                'objetivo' => 9,
                'codigo' => '9.8',
                'nombre' => 'Fomentar la integridad pública y la lucha contra la corrupción en coordinación interinstitucional efectiva entre todas las funciones del Estado',
            ],

            // ================================================================
            // OBJETIVO 10
            // ================================================================

            [
                'objetivo' => 10,
                'codigo' => '10.1',
                'nombre' => 'Fortalecer el Sistema Nacional Descentralizado de Gestión de Riesgos de Desastres mediante una gestión efectiva y oportuna con visión prospectiva',
            ],
            [
                'objetivo' => 10,
                'codigo' => '10.2',
                'nombre' => 'Implementar medidas de comprensión, prevención, mitigación y participación ciudadana para la gestión de riesgos de desastres',
            ],
        ];

        /*
        |--------------------------------------------------------------------------
        | REGISTRAR POLÍTICAS
        |--------------------------------------------------------------------------
        */

        foreach ($politicas as $politica) {

            $objetivo = $objetivos->get($politica['objetivo']);

            if (!$objetivo) {
                throw new \RuntimeException(
                    "No se encontró el Objetivo Nacional {$politica['objetivo']}."
                );
            }

            PndPolitica::updateOrCreate(
                [
                    'codigo' => $politica['codigo'],
                ],
                [
                    'pnd_objetivo_id' => $objetivo->id,
                    'nombre' => $politica['nombre'],
                ]
            );
        }
    }
}