<?php

namespace Database\Seeders;

use App\Models\PndEstrategia;
use App\Models\PndPolitica;
use Illuminate\Database\Seeder;

class PndEstrategiaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        /*
        |--------------------------------------------------------------------------
        | POLÍTICAS DEL PND
        |--------------------------------------------------------------------------
        */

        $politicas = PndPolitica::query()
            ->get()
            ->keyBy('codigo');

        /*
        |--------------------------------------------------------------------------
        | ESTRATEGIAS DEL PND
        |--------------------------------------------------------------------------
        */

        $estrategias = [

            /*
            |--------------------------------------------------------------------------
            | OBJETIVO 1
            | Mejorar las condiciones de vida de la población de forma integral,
            | promoviendo el acceso equitativo a salud, vivienda y bienestar social
            |--------------------------------------------------------------------------
            */

            /*
            | POLÍTICA 1.1
            | Contribuir a la reducción de la pobreza y pobreza extrema
            */

            [
                'politica' => '1.1',
                'codigo' => '1.1.a',
                'descripcion' => 'Desarrollar las capacidades de empleabilidad y autoempleo, acceso a financiamiento; así como acompañamiento en la comercialización, desarrollo de emprendimientos con énfasis en personas en situación de pobreza y pobreza extrema.',
            ],
            [
                'politica' => '1.1',
                'codigo' => '1.1.b',
                'descripcion' => 'Fortalecer la cobertura del Programa de Transferencias Monetarias no contributivas en provincias con alta incidencia de pobreza y pobreza extrema.',
            ],
            [
                'politica' => '1.1',
                'codigo' => '1.1.c',
                'descripcion' => 'Promover la asistencia técnica para la inclusión económica de actores de la economía popular y solidaria.',
            ],


            /*
            | POLÍTICA 1.2
            | Garantizar la inclusión social de las personas y grupos de atención prioritaria durante su ciclo de vida.
            */

            [
                'politica' => '1.2',
                'codigo' => '1.2.a',
                'descripcion' => 'Potenciar los programas y servicios de protección especial de cuidado y atención integral a las personas y grupos de atención prioritaria.',
            ],
            [
                'politica' => '1.2',
                'codigo' => '1.2.b',
                'descripcion' => 'Fortalecer la capacidad técnica, equipamiento e infraestructura para los programas y servicios de protección especial, de cuidado y atención integral a las personas y grupos de atención prioritaria.',
            ],
            [
                'politica' => '1.2',
                'codigo' => '1.2.c',
                'descripcion' => 'Implementar programas y proyectos que fortalezcan el tejido social y a la familia como el espacio natural y fundamental para el desarrollo integral del niño, niña y adolescente.',
            ],


            /*
            | POLÍTICA 1.3
            | Mejorar la prestación de los servicios de salud de manera integral...
            */

            [
                'politica' => '1.3',
                'codigo' => '1.3.a',
                'descripcion' => 'Fortalecer prácticas de vida saludable que promuevan la salud en un ambiente y entorno sostenible, seguro e inclusivo; con enfoques de derechos, intercultural, intergeneracional, de participación social y de género.',
            ],
            [
                'politica' => '1.3',
                'codigo' => '1.3.b',
                'descripcion' => 'Promover la formación académica continua de los profesionales de la salud.',
            ],
            [
                'politica' => '1.3',
                'codigo' => '1.3.c',
                'descripcion' => 'Incrementar el acceso oportuno a los servicios de salud, con énfasis en la atención a grupos prioritarios, a través de la provisión de medicamentos e insumos y el mejoramiento del equipamiento e infraestructura del Sistema Nacional de Salud.',
            ],


            /*
            | POLÍTICA 1.4
            | Fortalecer la vigilancia, prevención y control de enfermedades transmisibles y no transmisibles.
            */

            [
                'politica' => '1.4',
                'codigo' => '1.4.a',
                'descripcion' => 'Mejorar las acciones para la prevención, diagnóstico y tratamiento oportuno de enfermedades transmisibles, con énfasis en el control y atención de infecciones de transmisión sexual y el VIH/SIDA.',
            ],
            [
                'politica' => '1.4',
                'codigo' => '1.4.b',
                'descripcion' => 'Fortalecer acciones para la prevención, diagnóstico y tratamiento oportuno de enfermedades no transmisibles, con énfasis en el control y atención integral del cáncer.',
            ],
            [
                'politica' => '1.4',
                'codigo' => '1.4.c',
                'descripcion' => 'Fortalecer el modelo comunitario de salud mental, con abordaje de prevención y rehabilitación.',
            ],


            /*
            | POLÍTICA 1.5
            | Garantizar el acceso a la información, educación integral de la sexualidad y servicios de salud sexual...
            */

            [
                'politica' => '1.5',
                'codigo' => '1.5.a',
                'descripcion' => 'Mejorar la calidad de la atención en salud materna y salud sexual y reproductiva, abordando las desigualdades en el acceso a los servicios.',
            ],
            [
                'politica' => '1.5',
                'codigo' => '1.5.b',
                'descripcion' => 'Fortalecer el acceso al paquete de servicios para garantizar la atención integral en educación y salud sexual y salud reproductiva.',
            ],
            [
                'politica' => '1.5',
                'codigo' => '1.5.c',
                'descripcion' => 'Implementar acciones de promoción de la salud para prevenir el embarazo en niñas y adolescentes.',
            ],


            /*
            | POLÍTICA 1.6
            | Promover el buen uso del tiempo libre en la población ecuatoriana a través de la práctica de actividad física.
            */

            [
                'politica' => '1.6',
                'codigo' => '1.6.a',
                'descripcion' => 'Promover el acceso a espacios públicos seguros e inclusivos para el disfrute del tiempo libre, el desarrollo personal, la cohesión social, y la salud mental y física.',
            ],
            [
                'politica' => '1.6',
                'codigo' => '1.6.b',
                'descripcion' => 'Implementar el plan de mantenimiento de las instalaciones deportivas administradas por el Ministerio del Deporte, promoviendo la accesibilidad universal en los espacios públicos.',
            ],


            /*
            | POLÍTICA 1.7
            | Implementar programas de prevención y promoción que aborden los determinantes de la salud...

            */

            [
                'politica' => '1.7',
                'codigo' => '1.7.a',
                'descripcion' => 'Ampliar la cobertura de servicios integrales para la primera infancia en zonas priorizadas para brindar el paquete priorizado de forma oportuna, con calidad y con un enfoque de equidad.',
            ],
            [
                'politica' => '1.7',
                'codigo' => '1.7.b',
                'descripcion' => 'Generar intervenciones articuladas y coordinadas con las instituciones del Estado que aseguren la entrega de bienes y servicios para reducir la desnutrición crónica infantil, con enfoque territorial y de derechos.',
            ],
            [
                'politica' => '1.7',
                'codigo' => '1.7.c',
                'descripcion' => 'Fortalecer las estrategias público-privadas para actuar frente a los determinantes de la salud en la primera infancia, fomentando la participación ciudadana y la articulación con las entidades gubernamentales locales y del sector privado.',
            ],


            /*
            | POLÍTICA 1.8
            | Garantizar el derecho a una vivienda adecuada y promover entornos habitables, seguros y saludables...
            */

            [
                'politica' => '1.8',
                'codigo' => '1.8.a',
                'descripcion' => 'Mejorar el acceso de la vivienda y las condiciones de habitabilidad de la población urbana y rural con énfasis en las personas de bajos ingresos y grupos prioritarios, garantizando la sostenibilidad y condiciones de vida a nivel nacional.',
            ],
            [
                'politica' => '1.8',
                'codigo' => '1.8.b',
                'descripcion' => 'Formular normativa técnica de gestión de hábitat, el espacio público, el desarrollo de asentamientos humanos e implementar las acciones que garanticen el derecho a un hábitat inclusivo, seguro, resiliente y sostenible a nivel nacional.',
            ],
            [
                'politica' => '1.8',
                'codigo' => '1.8.c',
                'descripcion' => 'Direccionar, articular y promover la implementación de instrumentos, normativas y herramientas para fomentar el uso y gestión del suelo, los catastros; así como, la asistencia técnica en la gestión territorial a nivel nacional.',
            ],


            /*
            | POLÍTICA 1.9
            | Promover la inclusión social, el ejercicio de derechos y la no discriminación de los Pueblos y Nacionalidades.
            */

            [
                'politica' => '1.9',
                'codigo' => '1.9.a',
                'descripcion' => 'Fomentar y proteger las identidades y diversidades culturales de Pueblos y Nacionalidades.',
            ],
            [
                'politica' => '1.9',
                'codigo' => '1.9.b',
                'descripcion' => 'Incidir en la gestión de las políticas públicas para la inclusión social de pueblos y nacionalidades a través de la implementación de la Agenda Nacional para la Igualdad de Pueblos y Nacionalidades, orientado a la reducción de la pobreza multidimensional.',
            ],
            [
                'politica' => '1.9',
                'codigo' => '1.9.c',
                'descripcion' => 'Identificar proyectos en territorios transfronterizos de pueblos binacionales el marco del Memorando de Entendimiento de Cooperación Internacional entre Colombia y Ecuador.',
            ],


            /*
            | POLÍTICA 1.10
            | Fortalecer la bioeconomía de los Pueblos y Nacionalidades.
            */

            [
                'politica' => '1.10',
                'codigo' => '1.10.a',
                'descripcion' => 'Financiar proyectos sociales, económicos y productivos, fortaleciendo las cadenas de valor para mejorar las condiciones de vida de los Pueblos y Nacionalidades.',
            ],
            [
                'politica' => '1.10',
                'codigo' => '1.10.b',
                'descripcion' => 'Brindar asistencia técnica, capacitación para la ejecución de proyectos productivos sostenibles; y, asistencia humanitaria a pueblos y nacionalidades en condiciones de riesgo.',
            ],
            [
                'politica' => '1.10',
                'codigo' => '1.10.c',
                'descripcion' => 'Implementar el sistema de registro comunas, comunidades pueblos y nacionalidades de las organizaciones sociales para su fortalecimiento y ejercicio de los derechos colectivos.',
            ],


            /*
            |--------------------------------------------------------------------------
            | OBJETIVO 2
            | Impulsar las capacidades de la ciudadanía con educación equitativa
            | e inclusiva de calidad y promoviendo espacios de intercambio cultural
            |--------------------------------------------------------------------------
            */

            /*
            | POLÍTICA 2.1
            | Garantizar el acceso universal a una educación, inclusiva, equitativa, pertinente e intercultural para niños...
            */

            [
                'politica' => '2.1',
                'codigo' => '2.1.a',
                'descripcion' => 'Generar instrumentos normativos y técnicos que promuevan el acceso al sistema educativo.',
            ],
            [
                'politica' => '2.1',
                'codigo' => '2.1.b',
                'descripcion' => 'Dotar de infraestructura física, recursos y talento humano a las instituciones educativas públicas a nivel nacional.',
            ],
            [
                'politica' => '2.1',
                'codigo' => '2.1.c',
                'descripcion' => 'Fortalecer la oferta educativa en modalidades flexibles e innovadoras que atiendan las necesidades contextualizadas de los territorios con la participación de las comunidades.',
            ],


            /* POLÍTICA 2.2 */

            [
                'politica' => '2.2',
                'codigo' => '2.2.a',
                'descripcion' => 'Innovar el currículo nacional, planes de estudio, gestión pedagógica, evaluación de aprendizajes y recursos educativos; para la transición de una lógica contenidista a un proceso de desarrollo que construya una ciudadanía competente, con pertinencia intercultural, local y global; acompañados de procesos sostenibles de formación y capacitación contextualizada de los profesionales de la educación para su revalorización.',
            ],
            [
                'politica' => '2.2',
                'codigo' => '2.2.b',
                'descripcion' => 'Potenciar entornos educativos seguros e inclusivos, libres de toda forma de discriminación y violencia.',
            ],
            [
                'politica' => '2.2',
                'codigo' => '2.2.c',
                'descripcion' => 'Mejorar la calidad de la formación del bachillerato técnico y del bachillerato científico – humanístico vinculada con la vocación productiva de los territorios y los proyectos de vida del estudiantado.',
            ],
            [
                'politica' => '2.2',
                'codigo' => '2.2.d',
                'descripcion' => 'Mejorar el sistema de nivelación, garantizando la permanencia de los estudiantes y evitando la deserción en el sistema de educación.',
            ],


            /* POLÍTICA 2.3 */

            [
                'politica' => '2.3',
                'codigo' => '2.3.a',
                'descripcion' => 'Articular el desarrollo de programas y proyectos a la gestión pública de los otros organismos públicos del Sistema de Educación Superior para trabajar en conjunto en el aseguramiento de la calidad, a nivel institucional, de carreras y programas profesionalizantes.',
            ],
            [
                'politica' => '2.3',
                'codigo' => '2.3.b',
                'descripcion' => 'Ampliar la capacidad de oferta del Sistema de Educación Superior a nivel nacional a través de la dotación de infraestructura, talento humano y la capacidad operativa necesaria de manera sostenible.',
            ],
            [
                'politica' => '2.3',
                'codigo' => '2.3.c',
                'descripcion' => 'Fortalecer el proceso y la política de becas, créditos educativos y ayudas económicas, que permita a los estudiantes ingresar a la educación superior, priorizando los grupos históricamente excluidos.',
            ],


            /* POLÍTICA 2.4 */

            [
                'politica' => '2.4',
                'codigo' => '2.4.a',
                'descripcion' => 'Impulsar la educación superior a través del acceso a la tecnología mediante la coordinación interinstitucional considerando niveles de cobertura y enfoques de igualdad.',
            ],
            [
                'politica' => '2.4',
                'codigo' => '2.4.b',
                'descripcion' => 'Desarrollar carreras en áreas estratégicas para la investigación científica, ingenierías, matemáticas (STEM) con base en la innovación como motor del cambio productivo y tecnológico nacional.',
            ],
            [
                'politica' => '2.4',
                'codigo' => '2.4.c',
                'descripcion' => 'Generar espacios de diálogo para la construcción de acuerdos entre el sector público y privado para impulsar las carreras en modalidad dual.',
            ],


            /* POLÍTICA 2.5 */

            [
                'politica' => '2.5',
                'codigo' => '2.5.a',
                'descripcion' => 'Implementar programas de capacitación al personal académico en innovaciones tecnológicas, tomando en cuenta las zonas geográficas y temáticas aplicables.',
            ],
            [
                'politica' => '2.5',
                'codigo' => '2.5.b',
                'descripcion' => 'Ejecutar programas para el apoyo de la investigación científica, innovación y transferencia de tecnología con parámetros de responsabilidad y enfoques equitativo e intercultural.',
            ],
            [
                'politica' => '2.5',
                'codigo' => '2.5.c',
                'descripcion' => 'Desarrollar redes y espacios abiertos de conocimiento por medio de la investigación científica, la innovación, la transferencia de la tecnología y la vinculación con la sociedad.',
            ],


            /* POLÍTICA 2.6 */

            [
                'politica' => '2.6',
                'codigo' => '2.6.a',
                'descripcion' => 'Diseñar proyectos para el mejoramiento de la infraestructura cultural y patrimonial, con énfasis en los repositorios del Ministerio de Cultura y Patrimonio, contenedores de la Colección Nacional (archivos, bibliotecas y museos), para la conservación adecuada de sus bienes, su investigación y difusión.',
            ],
            [
                'politica' => '2.6',
                'codigo' => '2.6.b',
                'descripcion' => 'Promover la cooperación interinstitucional para la conservación, salvaguarda y desarrollo del patrimonio material e inmaterial, para los distintos niveles de gobierno y la ciudadanía en general.',
            ],
            [
                'politica' => '2.6',
                'codigo' => '2.6.c',
                'descripcion' => 'Incentivar la creación, circulación y acceso a bienes y servicios culturales, para el fortalecimiento de las identidades culturales desde el enfoque de derechos.',
            ],


            /* POLÍTICA 2.7 */

            [
                'politica' => '2.7',
                'codigo' => '2.7.a',
                'descripcion' => 'Financiar proyectos artísticos y culturales a nivel nacional, priorizando las provincias con altos niveles de violencia e inseguridad.',
            ],
            [
                'politica' => '2.7',
                'codigo' => '2.7.b',
                'descripcion' => 'Promover la difusión y comercialización de bienes y servicios artísticos y culturales en espacios nacionales e internacionales.',
            ],
            [
                'politica' => '2.7',
                'codigo' => '2.7.c',
                'descripcion' => 'Incentivar la articulación público – privada para el financiamiento de procesos culturales.',
            ],


            /* POLÍTICA 2.8 */

            [
                'politica' => '2.8',
                'codigo' => '2.8.a',
                'descripcion' => 'Reforzar la atención médica y técnica para los deportistas de alto rendimiento.',
            ],
            [
                'politica' => '2.8',
                'codigo' => '2.8.b',
                'descripcion' => 'Priorizar deportes y deportistas con miras a Juegos Olímpicos y Paralímpicos.',
            ],


            /*
            |--------------------------------------------------------------------------
            | OBJETIVO 3
            | Garantizar la seguridad integral, la paz ciudadana y transformar
            | el sistema de justicia respetando los derechos humanos
            |--------------------------------------------------------------------------
            */

            /* POLÍTICA 3.1 */

            [
                'politica' => '3.1',
                'codigo' => '3.1.a',
                'descripcion' => 'Prevenir el reclutamiento de niñas, niños y adolescentes, por parte de grupos delictivos organizados, promocionando factores de protección en entornos influenciados por el delito y la violencia.',
            ],
            [
                'politica' => '3.1',
                'codigo' => '3.1.b',
                'descripcion' => 'Contener y disminuir los delitos de oportunidad, principalmente el secuestro, extorsión, como los delitos cibernéticos, la trata de personas y el tráfico ilícito de migrantes, con base a la investigación técnica especializada.',
            ],
            [
                'politica' => '3.1',
                'codigo' => '3.1.c',
                'descripcion' => 'Integrar a la comunidad en la recuperación del territorio captado por grupos de delincuencia organizada y mercados ilegales generadores de violencia criminal, promoviendo la participación ciudadana.',
            ],


            /* POLÍTICA 3.2 */

            [
                'politica' => '3.2',
                'codigo' => '3.2.a',
                'descripcion' => 'Dotar a las Instituciones del Sector Seguridad con el equipamiento y medios logísticos necesarios para el cumplimiento de su misión institucional, en favor del fortalecimiento de la seguridad ciudadana, el orden público y protección interna.',
            ],
            [
                'politica' => '3.2',
                'codigo' => '3.2.b',
                'descripcion' => 'Intervenir los territorios afectados por mercados ilícitos, sus cadenas de valor y actores criminales, fortaleciendo la detección, interdicción, desarticulación y denegación de recursos, capacidades, redes de abastecimiento y logística, utilidades ilícitas y de financiamiento de la delincuencia organizada y el terrorismo.',
            ],
            [
                'politica' => '3.2',
                'codigo' => '3.2.c',
                'descripcion' => 'Fortalecer el control migratorio integral, los mecanismos de control del sistema financiero y actividades económicas vulnerables para prevenir y detectar el lavado de activos, flujos ilícitos y economías ilegales, provenientes del narcotráfico, la minería ilegal, y otros delitos de altos impacto.',
            ],


            /* POLÍTICA 3.3 */

            [
                'politica' => '3.3',
                'codigo' => '3.3.a',
                'descripcion' => 'Optimizar las capacidades de la defensa para garantizar la soberanía, integridad territorial enfrentando las amenazas y riesgos.',
            ],
            [
                'politica' => '3.3',
                'codigo' => '3.3.b',
                'descripcion' => 'Incrementar la participación del sector defensa en representaciones militares en el exterior, misiones de paz y ejercicios militares en el contexto internacional mediante acciones de cooperación.',
            ],


            /* POLÍTICA 3.4 */

            [
                'politica' => '3.4',
                'codigo' => '3.4.a',
                'descripcion' => 'Ejecutar programas y proyectos de cooperación y asistencia con otras instituciones del Estado, para contribuir a la seguridad integral en beneficio de la sociedad.',
            ],
            [
                'politica' => '3.4',
                'codigo' => '3.4.b',
                'descripcion' => 'Optimizar la Investigación, Desarrollo, Innovación y Producción en el sector Defensa.',
            ],
            [
                'politica' => '3.4',
                'codigo' => '3.4.c',
                'descripcion' => 'Fortalecer las relaciones cívico-militares para posicionar en la ciudadanía la importancia de la Defensa y la Seguridad Multidimensional.',
            ],


            /* POLÍTICA 3.5 */

            [
                'politica' => '3.5',
                'codigo' => '3.5.a',
                'descripcion' => 'Incrementar la calidad del servicio de atención a la comunidad migrante mediante procesos de simplificación, accesibilidad y calidez.',
            ],
            [
                'politica' => '3.5',
                'codigo' => '3.5.b',
                'descripcion' => 'Implementar programas de transformación digital de los servicios para beneficio de las personas en situación de movilidad humana.',
            ],
            [
                'politica' => '3.5',
                'codigo' => '3.5.c',
                'descripcion' => 'Ejecutar programas de integración, inclusión social y fortalecimiento de capacidades para migrantes ecuatorianos y personas en condiciones de movilidad humana.',
            ],


            /* POLÍTICA 3.6 */

            [
                'politica' => '3.6',
                'codigo' => '3.6.a',
                'descripcion' => 'Identificar, monitorear y alertar de forma permanente y oportuna sobre amenazas y riesgos a la seguridad integral del Estado.',
            ],
            [
                'politica' => '3.6',
                'codigo' => '3.6.b',
                'descripcion' => 'Producir Inteligencia Estratégica que aporte a la seguridad integral del Estado.',
            ],
            [
                'politica' => '3.6',
                'codigo' => '3.6.c',
                'descripcion' => 'Fortalecer las capacidades técnicas y tecnológicas para producir ciberinteligencia.',
            ],


            /* POLÍTICA 3.7 */

            [
                'politica' => '3.7',
                'codigo' => '3.7.a',
                'descripcion' => 'Concientizar a las autoridades, funciones del Estado, gobiernos autónomos descentralizados, sociedad civil y academia sobre el rol de la actividad de inteligencia.',
            ],
            [
                'politica' => '3.7',
                'codigo' => '3.7.b',
                'descripcion' => 'Fortalecer la cooperación internacional que aporte a la implementación de la estrategia de cultura de inteligencia.',
            ],
            [
                'politica' => '3.7',
                'codigo' => '3.7.c',
                'descripcion' => 'Promover acuerdos interinstitucionales de intercambio de información en todos los niveles del estado.',
            ],


            /* POLÍTICA 3.8 */

            [
                'politica' => '3.8',
                'codigo' => '3.8.a',
                'descripcion' => 'Proveer y mantener de medios tecnológicos de seguridad y vigilancia penitenciaria, equipamiento de protección de los servidores del Cuerpo de Seguridad y Vigilancia Penitenciaria, e infraestructura penitenciaria.',
            ],
            [
                'politica' => '3.8',
                'codigo' => '3.8.b',
                'descripcion' => 'Formar y capacitar a los servidores del Cuerpo de Seguridad y Vigilancia Penitenciaria en el marco de los derechos humanos y la seguridad penitenciaria.',
            ],
            [
                'politica' => '3.8',
                'codigo' => '3.8.c',
                'descripcion' => 'Prevenir y mitigar eventos que pongan en riesgo la seguridad de los Centros de Privación de la Libertad, personas privadas de libertad y funcionarios del Sistema Nacional de Rehabilitación Social y medidas socioeducativas, a través del desarrollo de inteligencia penitenciaria.',
            ],


            /* POLÍTICA 3.9 */

            [
                'politica' => '3.9',
                'codigo' => '3.9.a',
                'descripcion' => 'Clasificar a las personas privadas de libertad bajo parámetros de peligrosidad que permita adecuar y fortalecer los procesos de diagnóstico y rehabilitación por medio de la ejecución de los ejes de tratamiento.',
            ],
            [
                'politica' => '3.9',
                'codigo' => '3.9.b',
                'descripcion' => 'Garantizar el acceso oportuno a beneficios penitenciarios, cambios de régimen, indultos y repatriaciones en cumplimiento a la normativa legal vigente en todo el territorio nacional.',
            ],
            [
                'politica' => '3.9',
                'codigo' => '3.9.c',
                'descripcion' => 'Fortalecer las habilidades y competencias laborales y sociales en cumplimiento de los ejes de tratamiento por medio de la cooperación, especialmente con instituciones del Directorio del Organismo Técnico de rehabilitación social e instituciones educativas avaladas por el ente rector de la educación superior.',
            ],


            /* POLÍTICA 3.10 */

            [
                'politica' => '3.10',
                'codigo' => '3.10.a',
                'descripcion' => 'Promover la participación activa de la comunidad en la identificación, reducción de riesgos locales y preparación ante desastres.',
            ],

            /* POLÍTICA 3.11 */

            [
                'politica' => '3.11',
                'codigo' => '3.11.a',
                'descripcion' => 'Desarrollar programas educativos y de capacitación que mejoren la conciencia y el conocimiento de los riesgos existentes, así como las medidas de prevención y respuestas adecuadas.',
            ],


            /* POLÍTICA 3.12 */

            [
                'politica' => '3.12',
                'codigo' => '3.12.a',
                'descripcion' => 'Gestionar las incidencias o vulnerabilidades de ciberseguridad presentadas en los servicios de telecomunicaciones.',
            ],
            [
                'politica' => '3.12',
                'codigo' => '3.12.b',
                'descripcion' => 'Implementar programas de educación y concientización en ciberseguridad dirigidos a la población en general, empresas y funcionarios públicos, mejorando las habilidades digitales de la población.',
            ],


            /* POLÍTICA 3.13 */

            [
                'politica' => '3.13',
                'codigo' => '3.13.a',
                'descripcion' => 'Impulsar programas de sensibilización y educación en materia de derechos humanos para los funcionarios de las entidades públicas de la Función Ejecutiva.',
            ],
            [
                'politica' => '3.13',
                'codigo' => '3.13.b',
                'descripcion' => 'Establecer medidas de garantía para no repetición, reparación y promoción de derechos humanos a ser implementadas por las entidades públicas de la Función Ejecutiva.',
            ],


            /* POLÍTICA 3.14 */

            [
                'politica' => '3.14',
                'codigo' => '3.14.a',
                'descripcion' => 'Fortalecer los mecanismos gestionados por la institución en materia de prevención y atención integral ante la violencia contra mujeres, niños, niñas y adolescentes.',
            ],
            [
                'politica' => '3.14',
                'codigo' => '3.14.b',
                'descripcion' => 'Promover la no discriminación y la igualdad de oportunidades para las personas LGBTIQ+, mediante programas de sensibilización referentes a orientación sexual y diversidad sexogenérica.',
            ],


            /* POLÍTICA 3.15 */

            [
                'politica' => '3.15',
                'codigo' => '3.15.a',
                'descripcion' => 'Mejorar el sistema de audiencias y despacho de causas.',
            ],
            [
                'politica' => '3.15',
                'codigo' => '3.15.b',
                'descripcion' => 'Implementar tecnologías y procesos que optimicen la gestión de casos, reduzcan los tiempos de espera y mejoren la calidad de las decisiones judiciales.',
            ],
            [
                'politica' => '3.15',
                'codigo' => '3.15.c',
                'descripcion' => 'Establecer mecanismos de control interno y externo para supervisar el cumplimiento de las normas de transparencia, integridad y eficiencia en la Función Judicial.',
            ],


            /* POLÍTICA 3.16 */

            [
                'politica' => '3.16',
                'codigo' => '3.16.a',
                'descripcion' => 'Dotar de defensores públicos para la prestación del servicio a nivel nacional.',
            ],
            [
                'politica' => '3.16',
                'codigo' => '3.16.b',
                'descripcion' => 'Dotar de infraestructura, equipamiento y mobiliario a nivel nacional para la Defensoría Pública.',
            ],

            /*
            |--------------------------------------------------------------------------
            | OBJETIVO 4
            | Estimular el sistema económico y de finanzas públicas para
            | dinamizar la inversión y las relaciones comerciales
            |--------------------------------------------------------------------------
            */

            /* POLÍTICA 4.1 */

            [
                'politica' => '4.1',
                'codigo' => '4.1.a',
                'descripcion' => 'Negociar y suscribir instrumentos y acuerdos internacionales.',
            ],
            [
                'politica' => '4.1',
                'codigo' => '4.1.b',
                'descripcion' => 'Generar espacios de promoción de la oferta cultural, turística y patrimonial del país.',
            ],


            /* POLÍTICA 4.2 */

            [
                'politica' => '4.2',
                'codigo' => '4.2.a',
                'descripcion' => 'Negociar, suscribir e implementar acuerdos comerciales para impulsar la agenda comercial del país.',
            ],
            [
                'politica' => '4.2',
                'codigo' => '4.2.b',
                'descripcion' => 'Diversificar la oferta exportable de bienes y servicios no petroleros en mercados actuales y potenciales.',
            ],
            [
                'politica' => '4.2',
                'codigo' => '4.2.c',
                'descripcion' => 'Fortalecer la participación de Ecuador en los sistemas de integración regional y sistema multilateral de comercio.',
            ],


            /* POLÍTICA 4.3 */

            [
                'politica' => '4.3',
                'codigo' => '4.3.a',
                'descripcion' => 'Robustecer el marco institucional y normativo para la atracción, promoción y facilitación de las inversiones, brindándoles estabilidad jurídica.',
            ],
            [
                'politica' => '4.3',
                'codigo' => '4.3.b',
                'descripcion' => 'Establecer e implementar acciones coordinadas para la promoción y atracción de inversiones locales y extranjeras que permitan efectiva concreción de inversión.',
            ],
            [
                'politica' => '4.3',
                'codigo' => '4.3.c',
                'descripcion' => 'Facilitar procesos de gestión y concreción de la inversión nacional y extranjera.',
            ],


            /* POLÍTICA 4.4 */

            [
                'politica' => '4.4',
                'codigo' => '4.4.a',
                'descripcion' => 'Elaborar normativa que fortalezca controles sobre los tipos de regímenes de contratación.',
            ],
            [
                'politica' => '4.4',
                'codigo' => '4.4.b',
                'descripcion' => 'Capacitar a entidades y proveedores respecto a los usos de procesos competitivos de contratación.',
            ],
            [
                'politica' => '4.4',
                'codigo' => '4.4.c',
                'descripcion' => 'Fortalecer los mecanismos de control del Servicio Nacional de Contratación Pública.',
            ],


            /* POLÍTICA 4.5 */

            [
                'politica' => '4.5',
                'codigo' => '4.5.a',
                'descripcion' => 'Elaborar normativa que promueva la sostenibilidad en los procesos de contratación.',
            ],
            [
                'politica' => '4.5',
                'codigo' => '4.5.b',
                'descripcion' => 'Promover el fortalecimiento institucional en términos de control y capacidades de oferentes y demandantes.',
            ],


            /* POLÍTICA 4.6 */

            [
                'politica' => '4.6',
                'codigo' => '4.6.a',
                'descripcion' => 'Incrementar la recaudación tributaria y disponer de mayores ingresos permanentes para el Presupuesto General del Estado.',
            ],


            /* POLÍTICA 4.7 */

            [
                'politica' => '4.7',
                'codigo' => '4.7.a',
                'descripcion' => 'Gestionar la deuda pública de forma eficiente y sostenible para mantener niveles de deuda coherentes con las reglas fiscales.',
            ],
            [
                'politica' => '4.7',
                'codigo' => '4.7.b',
                'descripcion' => 'Diversificar fuentes de financiamiento e implementar mecanismos financieros sostenibles e innovadores.',
            ],
            [
                'politica' => '4.7',
                'codigo' => '4.7.c',
                'descripcion' => 'Mejorar los mecanismos para promover la calidad del gasto y la vinculación planificación-presupuesto.',
            ],


            /* POLÍTICA 4.8 */

            [
                'politica' => '4.8',
                'codigo' => '4.8.a',
                'descripcion' => 'Construir instrumentos normativos sustentados en investigaciones y propuestas técnicas de información económica.',
            ],
            [
                'politica' => '4.8',
                'codigo' => '4.8.b',
                'descripcion' => 'Promover mecanismos que faciliten el acceso a crédito para sectores clave de la economía.',
            ],
            [
                'politica' => '4.8',
                'codigo' => '4.8.c',
                'descripcion' => 'Ampliar las herramientas de regulación y supervisión de la actividad financiera del país para aumentar la resiliencia del sistema financiero.',
            ],


            /* POLÍTICA 4.9 */

            [
                'politica' => '4.9',
                'codigo' => '4.9.a',
                'descripcion' => 'Fortalecer las capacidades institucionales del Estado para potenciar la identificación, priorización y estructuración de un portafolio de proyectos de Asociaciones Público-Privadas de infraestructura pública.',
            ],
            [
                'politica' => '4.9',
                'codigo' => '4.9.b',
                'descripcion' => 'Fortalecer la cooperación y servicios al inversionista en materia de Asociaciones Público Privadas para ampliar y priorizar el portafolio de proyectos Asociaciones Público-Privadas.',
            ],
            [
                'politica' => '4.9',
                'codigo' => '4.9.c',
                'descripcion' => 'Diseñar instrumentos que permitan la identificación de posibles soluciones de nudos críticos, y la priorización y estructuración de proyectos y contratos en materia de Asociaciones Público – Privadas.',
            ],

            /*
            |--------------------------------------------------------------------------
            | OBJETIVO 5
            | Fomentar de manera sustentable la producción mejorando los
            | niveles de productividad
            |--------------------------------------------------------------------------
            */

            /* POLÍTICA 5.1 */

            [
                'politica' => '5.1',
                'codigo' => '5.1.a',
                'descripcion' => 'Desarrollar capacidades productivas y empresariales de los productores y organizaciones de productores con acompañamiento integral y multidimensional hacia modelos de agricultura sostenible.',
            ],
            [
                'politica' => '5.1',
                'codigo' => '5.1.b',
                'descripcion' => 'Generar mecanismos de comercialización que faciliten el acceso a mercados a través de la diversificación de productos de calidad y espacios con intermediación controlada.',
            ],
            [
                'politica' => '5.1',
                'codigo' => '5.1.c',
                'descripcion' => 'Implementar estándares nacionales e internacionales para mejorar las prácticas de sanidad agropecuaria y reformar la tecnificación y profesionalización de los organismos competentes.',
            ],


            /* POLÍTICA 5.2 */

            [
                'politica' => '5.2',
                'codigo' => '5.2.a',
                'descripcion' => 'Dotar de infraestructura, riego, legalización de la tenencia de la tierra, asistencia técnica y capacitación, e investigación para la mejora genética agrícola, pecuaria y forestal.',
            ],
            [
                'politica' => '5.2',
                'codigo' => '5.2.b',
                'descripcion' => 'Desarrollar la práctica y mejora productiva de forma diversificada, sostenible y resiliente, que incluyan buenas prácticas agropecuarias, interculturales, preserven la biodiversidad e incrementen la participación de jóvenes y mujeres.',
            ],
            [
                'politica' => '5.2',
                'codigo' => '5.2.c',
                'descripcion' => 'Facilitar el acceso a financiamiento y aseguramiento agropecuario especializado en función del tipo de cultivo y actividades innovadoras.',
            ],


            /* POLÍTICA 5.3 */

            [
                'politica' => '5.3',
                'codigo' => '5.3.a',
                'descripcion' => 'Potenciar la producción acuícola y pesquera, a través del fomento de la piscicultura y maricultura en el Ecuador.',
            ],
            [
                'politica' => '5.3',
                'codigo' => '5.3.b',
                'descripcion' => 'Fortalecer las capacidades, líneas de investigación científico-técnica de acuicultura y pesca orientada al desarrollo de técnicas sostenibles y sustentables que se articulen al sector productivo.',
            ],
            [
                'politica' => '5.3',
                'codigo' => '5.3.c',
                'descripcion' => 'Fortalecer el desarrollo organizacional y productivo del sector acuícola de pequeña escala y al sector pesquero artesanal.',
            ],
            [
                'politica' => '5.3',
                'codigo' => '5.3.d',
                'descripcion' => 'Implementar mecanismos de control laboral y pesquero que incentiven la formalidad y reduzcan la pesca ilegal no declarada y no reglamentada.',
            ],


            /* POLÍTICA 5.4 */

            [
                'politica' => '5.4',
                'codigo' => '5.4.a',
                'descripcion' => 'Ampliar la conectividad de los sectores turísticos locales.',
            ],
            [
                'politica' => '5.4',
                'codigo' => '5.4.b',
                'descripcion' => 'Incrementar y diversificar la oferta de servicios turísticos, su competitividad y calidad de acuerdo con la demanda local e internacional, la integralidad territorial de los destinos, y con la participación coordinada de los actores del sector turístico.',
            ],


            /* POLÍTICA 5.5 */

            [
                'politica' => '5.5',
                'codigo' => '5.5.a',
                'descripcion' => 'Promover el manejo eficiente de recursos naturales y el uso de tecnologías limpias para diversificar la producción e incorporar nuevos productos.',
            ],
            [
                'politica' => '5.5',
                'codigo' => '5.5.b',
                'descripcion' => 'Fortalecer procesos que permitan la diversificación y calidad de las cadenas productivas.',
            ],
            [
                'politica' => '5.5',
                'codigo' => '5.5.c',
                'descripcion' => 'Elaborar la Estrategia de Agronegocios Sostenibles e implementar la Estrategia Nacional de Calidad y de Economía Circular.',
            ],
            [
                'politica' => '5.5',
                'codigo' => '5.5.d',
                'descripcion' => 'Fortalecer la asociatividad, y el acceso a servicios financieros y no financieros en circuitos de economía popular y solidaria.',
            ],

            /*
            |--------------------------------------------------------------------------
            | OBJETIVO 6
            | Incentivar la generación de empleo digno
            |--------------------------------------------------------------------------
            */

            /* POLÍTICA 6.1 */

            [
                'politica' => '6.1',
                'codigo' => '6.1.a',
                'descripcion' => 'Fortalecer los incentivos, controles y marco normativo para promover la inclusión laboral en condiciones dignas en todo el territorio nacional.',
            ],
            [
                'politica' => '6.1',
                'codigo' => '6.1.b',
                'descripcion' => 'Fortalecer las acciones de control a las partes involucradas para verificar el cumplimiento de los derechos laborales.',
            ],


            /* POLÍTICA 6.2 */

            [
                'politica' => '6.2',
                'codigo' => '6.2.a',
                'descripcion' => 'Ampliar los programas de mejoramiento continuo para las micro, pequeñas y medianas empresas (MIPYMES).',
            ],


            /* POLÍTICA 6.3 */

            [
                'politica' => '6.3',
                'codigo' => '6.3.a',
                'descripcion' => 'Fomentar el desarrollo de iniciativas clústeres como herramienta de colaboración público-privada enfocada en resolver problemas de las cadenas productivas para la generación de empleo.',
            ],
            [
                'politica' => '6.3',
                'codigo' => '6.3.b',
                'descripcion' => 'Promover zonas francas potenciando las vocaciones productivas de cada zona y de esta forma fomentar el empleo local.',
            ],


            /* POLÍTICA 6.4 */

            [
                'politica' => '6.4',
                'codigo' => '6.4.a',
                'descripcion' => 'Ofrecer programas de capacitación y de fortalecimiento de competencias laborales que permitan a los jóvenes ampliar sus oportunidades en el mercado laboral.',
            ],
            [
                'politica' => '6.4',
                'codigo' => '6.4.b',
                'descripcion' => 'Implementar programas y proyectos e incentivos fiscales en aplicación a la Ley de Eficiencia Económica y Generación de Empleo.',
            ],


            /* POLÍTICA 6.5 */

            [
                'politica' => '6.5',
                'codigo' => '6.5.a',
                'descripcion' => 'Implementar normativa secundaria para reforzar el cumplimiento de obligaciones sobre retribución económica entre hombres y mujeres por un trabajo de igual valor.',
            ],

            /*
            |--------------------------------------------------------------------------
            | OBJETIVO 7
            | Precautelar el uso responsable de los recursos naturales con un
            | entorno ambientalmente sostenible
            |--------------------------------------------------------------------------
            */

            /* POLÍTICA 7.1 */

            [
                'politica' => '7.1',
                'codigo' => '7.1.a',
                'descripcion' => 'Suministrar energía eléctrica con enfoque de largo plazo, promoviendo el uso sostenible de recursos renovables, autogeneración con venta de excedentes, generación distribuida y sistemas de almacenamiento; así como, la participación de empresas públicas e inversiones privadas.',
            ],
            [
                'politica' => '7.1',
                'codigo' => '7.1.b',
                'descripcion' => 'Planificar integralmente la expansión y operación óptima de los sistemas de distribución de energía eléctrica y del sistema de alumbrado público general, que responda a las necesidades de desarrollo del sector con eficiencia, calidad y resiliencia, para el corto, mediano y largo plazo.',
            ],
            [
                'politica' => '7.1',
                'codigo' => '7.1.c',
                'descripcion' => 'Optimizar el uso y consumo energético en toda la cadena de suministro y en los usuarios finales, fortaleciendo el marco normativo e institucional, gestión de la energía, innovación tecnológica, aplicación de incentivos, uso de tecnologías y equipos con estándares mínimos de rendimiento energético y difusión de mejores prácticas.',
            ],


            /* POLÍTICA 7.2 */

            [
                'politica' => '7.2',
                'codigo' => '7.2.a',
                'descripcion' => 'Impulsar el desarrollo de proyectos de inversión pública y privada; así como, el uso de tecnologías sostenibles en la cadena de valor del sector de hidrocarburos, fortaleciendo el marco legal que permita su ejecución.',
            ],


            /* POLÍTICA 7.3 */

            [
                'politica' => '7.3',
                'codigo' => '7.3.a',
                'descripcion' => 'Desarrollar el sector minero promocionando la captación de inversión nacional y extranjera con enfoque ambiental y fortaleciendo el marco normativo para la administración, regulación y control del Estado a las actividades mineras.',
            ],


            /* POLÍTICA 7.4 */

            [
                'politica' => '7.4',
                'codigo' => '7.4.a',
                'descripcion' => 'Promover la conservación, restauración, protección, uso y aprovechamiento sostenible del patrimonio natural, con mecanismos y medios regulatorios establecidos para su gestión.',
            ],
            [
                'politica' => '7.4',
                'codigo' => '7.4.b',
                'descripcion' => 'Fomentar la gestión del cambio climático con acciones en territorio en los componentes de adaptación, mitigación y producción; y, desarrollo sostenible dentro de los sectores priorizados.',
            ],
            [
                'politica' => '7.4',
                'codigo' => '7.4.c',
                'descripcion' => 'Promover los modelos circulares que contribuyan a la reducción de la contaminación de los recursos naturales e hídricos.',
            ],


            /* POLÍTICA 7.5 */

            [
                'politica' => '7.5',
                'codigo' => '7.5.a',
                'descripcion' => 'Articular medidas de adaptación al cambio climático, considerando los criterios de sostenibilidad, en coordinación con los actores competentes, y aportando desde la reducción de riesgos de desastres.',
            ],
            [
                'politica' => '7.5',
                'codigo' => '7.5.b',
                'descripcion' => 'Promover la gestión de riesgos de desastres asociados a factores climáticos, ambientales, geológicos, oceánicos, hidrometeorológicos y factores antrópicos.',
            ],


            /* POLÍTICA 7.6 */

            [
                'politica' => '7.6',
                'codigo' => '7.6.a',
                'descripcion' => 'Fomentar la implementación de normas y estándares de construcciones resilientes y sostenibles en infraestructuras nuevas y existentes.',
            ],


            /* POLÍTICA 7.7 */

            [
                'politica' => '7.7',
                'codigo' => '7.7.a',
                'descripcion' => 'Impulsar la gestión integral, integrada y sostenible del recurso hídrico, en todos sus usos y aprovechamientos, con la identificación y establecimiento de garantías preventivas y formas de conservación del dominio hídrico público.',
            ],
            [
                'politica' => '7.7',
                'codigo' => '7.7.b',
                'descripcion' => 'Fomentar la implementación y ampliación de sistemas de aprovechamiento de agua para su potabilización, drenaje y saneamiento, y uso en riego.',
            ],

                        /*
            |--------------------------------------------------------------------------
            | OBJETIVO 8
            | Impulsar la conectividad como fuente de desarrollo y crecimiento
            | económico y sostenible
            |--------------------------------------------------------------------------
            */

            /* POLÍTICA 8.1 */

            [
                'politica' => '8.1',
                'codigo' => '8.1.a',
                'descripcion' => 'Incrementar la cobertura de la tecnología 4G en el territorio nacional.',
            ],
            [
                'politica' => '8.1',
                'codigo' => '8.1.b',
                'descripcion' => 'Aumentar la cobertura de fibra óptica en el país.',
            ],


            /* POLÍTICA 8.2 */

            [
                'politica' => '8.2',
                'codigo' => '8.2.a',
                'descripcion' => 'Promover procesos permanentes de formación y control, bajo una cultura de movilidad segura para reducir la siniestralidad a nivel nacional.',
            ],
            [
                'politica' => '8.2',
                'codigo' => '8.2.b',
                'descripcion' => 'Garantizar la Seguridad Operacional del transporte aéreo con la finalidad de evitar incidentes y accidentes.',
            ],
            [
                'politica' => '8.2',
                'codigo' => '8.2.c',
                'descripcion' => 'Promover un modelo de gestión sostenible que permita mantener el buen estado de la infraestructura y la calidad de los servicios de transporte multimodal, optimizando la capacidad instalada en función de las necesidades ciudadanas y del mercado, a través de proyectos públicos y privados.',
            ],

                        /*
            |--------------------------------------------------------------------------
            | OBJETIVO 9
            | Propender la construcción de un Estado eficiente, transparente
            | y orientado al bienestar social
            |--------------------------------------------------------------------------
            */

            /* POLÍTICA 9.1 */

            [
                'politica' => '9.1',
                'codigo' => '9.1.a',
                'descripcion' => 'Desarrollar espacios de participación y control social que permitan una formulación, seguimiento y evaluación eficiente de los procesos de las instituciones públicas.',
            ],
            [
                'politica' => '9.1',
                'codigo' => '9.1.b',
                'descripcion' => 'Generar alianzas estratégicas con diversos niveles de gobierno, para fortalecer la gestión de las delegaciones provinciales.',
            ],
            [
                'politica' => '9.1',
                'codigo' => '9.1.c',
                'descripcion' => 'Desarrollar mecanismos que permitan incrementar la participación ciudadana activa de los pueblos y nacionalidades; y, grupos prioritarios.',
            ],
            [
                'politica' => '9.1',
                'codigo' => '9.1.d',
                'descripcion' => 'Diseñar e implementar mecanismos de evaluación ciudadana en la gestión pública de las instituciones y los sujetos obligados a rendir cuentas.',
            ],


            /* POLÍTICA 9.2 */

            [
                'politica' => '9.2',
                'codigo' => '9.2.a',
                'descripcion' => 'Implementar el modelo de Estado abierto a través del Plan de Acción de Gobierno Abierto e impulsar la adhesión de instituciones a este modelo de gestión.',
            ],
            [
                'politica' => '9.2',
                'codigo' => '9.2.b',
                'descripcion' => 'Fortalecer la transparencia mediante el acceso a información oportuna a toda la ciudadanía.',
            ],


            /* POLÍTICA 9.3 */

            [
                'politica' => '9.3',
                'codigo' => '9.3.a',
                'descripcion' => 'Incrementar el análisis en simplificación regulatoria, proponer reformas normativas e identificar procesos derivados de este análisis para su optimización.',
            ],
            [
                'politica' => '9.3',
                'codigo' => '9.3.b',
                'descripcion' => 'Desarrollar propuesta de alineamiento estratégico y la implementación de metodologías de innovación pública en materia de simplificación de procesos administrativos para la mejora regulatoria.',
            ],


            /* POLÍTICA 9.4 */

            [
                'politica' => '9.4',
                'codigo' => '9.4.a',
                'descripcion' => 'Estandarizar instrumentos para la identificación, prevención y gestión de conflictos en la Función Ejecutiva.',
            ],
            [
                'politica' => '9.4',
                'codigo' => '9.4.b',
                'descripcion' => 'Establecer canales de comunicación efectiva que permitan a los funcionarios gubernamentales y a las partes interesadas reportar posibles conflictos.',
            ],


            /* POLÍTICA 9.5 */

            [
                'politica' => '9.5',
                'codigo' => '9.5.a',
                'descripcion' => 'Promover la conformación de los Consejos Ciudadanos Sectoriales en la Función Ejecutiva, a través de socialización y asistencia técnica con los ministerios sectoriales.',
            ],
            [
                'politica' => '9.5',
                'codigo' => '9.5.b',
                'descripcion' => 'Fortalecer el funcionamiento de los Consejos Ciudadanos Sectoriales en la Función Ejecutiva, a través de la coordinación interinstitucional, el seguimiento y la resolución de nudos críticos con las entidades rectoras.',
            ],


            /* POLÍTICA 9.6 */

            [
                'politica' => '9.6',
                'codigo' => '9.6.a',
                'descripcion' => 'Mejorar los procesos de gestión institucional a través de la innovación de las estructuras orgánicas, para brindar servicios de calidad y satisfacer las demandas ciudadanas.',
            ],


            /* POLÍTICA 9.7 */

            [
                'politica' => '9.7',
                'codigo' => '9.7.a',
                'descripcion' => 'Fortalecer, ampliar y articular los programas de cooperación internacional vigentes.',
            ],
            [
                'politica' => '9.7',
                'codigo' => '9.7.b',
                'descripcion' => 'Implementar estrategias de identificación y de acercamiento a nuevas fuentes de cooperación bilateral, multilateral y no gubernamental.',
            ],
            [
                'politica' => '9.7',
                'codigo' => '9.7.c',
                'descripcion' => 'Fortalecer la institucionalidad de la cooperación internacional y el trabajo de coordinación interinstitucional.',
            ],


            /* POLÍTICA 9.8 */

            [
                'politica' => '9.8',
                'codigo' => '9.8.a',
                'descripcion' => 'Ampliar la implementación de metodologías de riesgos institucionales de corrupción en las entidades públicas.',
            ],
            [
                'politica' => '9.8',
                'codigo' => '9.8.b',
                'descripcion' => 'Desarrollar propuestas de mejora de procesos y estructura institucional para mitigar los riesgos de corrupción en instituciones y procesos priorizados.',
            ],
            [
                'politica' => '9.8',
                'codigo' => '9.8.c',
                'descripcion' => 'Formular y consolidar metodologías de investigación e impulso jurídico de los casos que hayan generado corrupción, afectación de los derechos de la ciudadanía o el interés social en la gestión pública.',
            ],

                        /*
            |--------------------------------------------------------------------------
            | OBJETIVO 10
            | Promover la resiliencia de ciudades y comunidades para enfrentar
            | los riesgos de origen natural y antrópico
            |--------------------------------------------------------------------------
            */

            /* POLÍTICA 10.1 */

            [
                'politica' => '10.1',
                'codigo' => '10.1.a',
                'descripcion' => 'Adecuar la normativa y los lineamientos técnicos acorde con la Ley Orgánica de Gestión Integral de Riesgo de Desastre.',
            ],
            [
                'politica' => '10.1',
                'codigo' => '10.1.b',
                'descripcion' => 'Ampliar la cobertura y mejorar la eficacia de los sistemas de alerta temprana, mapeo y monitoreo de amenazas, para proteger a la población mediante la adopción de medidas de respuesta oportunas y efectivas.',
            ],
            [
                'politica' => '10.1',
                'codigo' => '10.1.c',
                'descripcion' => 'Implementar mecanismos de respuesta ante desastres y de recuperación post desastre velando por la protección de los derechos de las personas afectadas y de la naturaleza.',
            ],
            [
                'politica' => '10.1',
                'codigo' => '10.1.d',
                'descripcion' => 'Capacitar y equipar al voluntariado de protección civil y a los actores nacionales y locales para que puedan asistir a la población ante emergencias y desastres de forma segura considerando las particularidades y necesidades del territorio.',
            ],
            [
                'politica' => '10.1',
                'codigo' => '10.1.e',
                'descripcion' => 'Fortalecer las capacidades de primera respuesta, respuesta humanitaria y logística para la atención de desastres en todos los niveles.',
            ],
            [
                'politica' => '10.1',
                'codigo' => '10.1.f',
                'descripcion' => 'Adoptar medidas integrales de recuperación post-desastre basadas en la evaluación de los efectos e impactos del desastre y/o emergencia en todos los niveles territoriales.',
            ],
            [
                'politica' => '10.1',
                'codigo' => '10.1.g',
                'descripcion' => 'Diseñar e implementar mecanismos de gestión financiera y técnica para la gestión integral del riesgo de desastres.',
            ],


            /* POLÍTICA 10.2 */

            [
                'politica' => '10.2',
                'codigo' => '10.2.a',
                'descripcion' => 'Desarrollar e implementar programas y proyectos de investigación, de vinculación con la comunidad e iniciativas de participación ciudadana para comprender, anticipar y monitorear los riesgos de desastres a nivel nacional.',
            ],
            [
                'politica' => '10.2',
                'codigo' => '10.2.b',
                'descripcion' => 'Revisar la aplicación o expedición de normas técnicas y/o ordenanzas para la gestión de riesgos en los GAD municipales.',
            ],
            [
                'politica' => '10.2',
                'codigo' => '10.2.c',
                'descripcion' => 'Fomentar el desarrollo de ejercicios de simulación y simulacros de las principales amenazas existentes en el territorio.',
            ], 

        ];


        /*
        |--------------------------------------------------------------------------
        | REGISTRAR ESTRATEGIAS
        |--------------------------------------------------------------------------
        */

        foreach ($estrategias as $estrategia) {

            $politica = $politicas->get($estrategia['politica']);

            if (!$politica) {
                throw new \RuntimeException(
                    "No se encontró la política {$estrategia['politica']}."
                );
            }

            PndEstrategia::updateOrCreate(
                [
                    'codigo' => $estrategia['codigo'],
                ],
                [
                    'pnd_politica_id' => $politica->id,
                    'descripcion' => $estrategia['descripcion'],
                ]
            );
        }
    }
}