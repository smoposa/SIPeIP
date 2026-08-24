<?php

namespace Database\Seeders;

use App\Models\PndMeta;
use App\Models\PndObjetivo;
use Illuminate\Database\Seeder;

class PndMetaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        /*
        |--------------------------------------------------------------------------
        | METAS DEL PLAN NACIONAL DE DESARROLLO
        |--------------------------------------------------------------------------
        |
        | Las metas pertenecen directamente a los Objetivos Nacionales.
        |
        | Estructura:
        |
        | PND
        | └── Eje
        |     └── Objetivo Nacional
        |         ├── Políticas
        |         |   └── Estrategias
        |         |
        |         └── Metas
        |
        */

        $metas = [

            /*
            |--------------------------------------------------------------------------
            | OBJETIVO 1
            |--------------------------------------------------------------------------
            */
            [
                'objetivo' => 1,
                'numero' => 1,
                'descripcion' => 'Reducir la tasa de pobreza extrema por ingresos del 9,81% en el año 2023 a 9,12% al 2025.',
            ],
            [
                'objetivo' => 1,
                'numero' => 2,
                'descripcion' => 'Reducir la tasa de pobreza por necesidades básicas insatisfechas del 30,84% en el año 2023 al 30,11% al 2025.',
            ],
            [
                'objetivo' => 1,
                'numero' => 3,
                'descripcion' => 'Reducir la razón de mortalidad materna de 33,90 en el año 2022 a 33,77 al 2025.',
            ],
            [
                'objetivo' => 1,
                'numero' => 4,
                'descripcion' => 'Reducir la prevalencia de Desnutrición Crónica Infantil en menores de dos años del 20,1% en 2022-2023 a 18,7% en 2024-2025.',
            ],
            [
                'objetivo' => 1,
                'numero' => 5,
                'descripcion' => 'Reducir la tasa específica de nacimientos en mujeres adolescentes de 10 a 14 años de 2,43 en el año 2022 a 2,40 al 2025.',
            ],
            [
                'objetivo' => 1,
                'numero' => 6,
                'descripcion' => 'Reducir la tasa específica de nacimientos en mujeres adolescentes de 15 a 19 años de 47,51 en el año 2022 a 47,40 al 2025.',
            ],
            [
                'objetivo' => 1,
                'numero' => 7,
                'descripcion' => 'Incrementar la cobertura de vacunación de Rotavirus de 85,66% en el año 2022 a 86,32% al 2025.',
            ],
            [
                'objetivo' => 1,
                'numero' => 8,
                'descripcion' => 'Incrementar la cobertura de vacunación de SRP (Sarampión, Rubeola, Parodititis) de 71,50% en el año 2022 a 71,69% al 2025.',
            ],
            [
                'objetivo' => 1,
                'numero' => 9,
                'descripcion' => 'Incrementar la cobertura de vacunación de Neumococo de 85,66% en el año 2022 a 85,78% al 2025.',
            ],
            [
                'objetivo' => 1,
                'numero' => 10,
                'descripcion' => 'Incrementar el porcentaje de personas que viven con VIH que conocen su estado serológico y se encuentran en tratamiento antirretroviral de 84,9% en el año 2023 a 87,42% al 2025.',
            ],
            [
                'objetivo' => 1,
                'numero' => 11,
                'descripcion' => 'Reducir la tasa de mortalidad por suicidio de 6,48 en el año 2022 a 6,31 al 2025.',
            ],
            [
                'objetivo' => 1,
                'numero' => 12,
                'descripcion' => 'Reducir el gasto de bolsillo en salud como porcentaje del gasto total en salud de 32,59% en el año 2022 a 31,27% al 2025.',
            ],
            [
                'objetivo' => 1,
                'numero' => 13,
                'descripcion' => 'Incrementar la tasa de médicos familiares en atención primaria de 1,00 en el año 2020 a 1,70 al 2025.',
            ],
            [
                'objetivo' => 1,
                'numero' => 14,
                'descripcion' => 'Reducir el déficit habitacional de vivienda de 56,71% en el año 2022 a 56,41% al 2025.',
            ],


            /*
            |--------------------------------------------------------------------------
            | OBJETIVO 2
            |--------------------------------------------------------------------------
            */
            [
                'objetivo' => 2,
                'numero' => 1,
                'descripcion' => 'Incrementar el porcentaje de estudiantes del subnivel básica superior que han alcanzado o superado el nivel mínimo de competencia en el campo de Lengua y Literatura en la evaluación Ser Estudiante de 46,90% en el año 2022 a 47,80% al 2025.',
            ],
            [
                'objetivo' => 2,
                'numero' => 2,
                'descripcion' => 'Incrementar la tasa neta de matrícula de educación inicial de 56,63% en el año 2022 a 60,65% al 2025.',
            ],
            [
                'objetivo' => 2,
                'numero' => 3,
                'descripcion' => 'Incrementar la tasa neta de matrícula de Educación General Básica de 93,63% en el año 2022 a 97,54% al 2025.',
            ],
            [
                'objetivo' => 2,
                'numero' => 4,
                'descripcion' => 'Incrementar la tasa neta de Bachillerato de 70,35% en el año 2022 a 71,39% al 2025.',
            ],
            [
                'objetivo' => 2,
                'numero' => 5,
                'descripcion' => 'Incrementar el porcentaje de personas de 18 a 29 años de edad con bachillerato completo de 75,30% en el año 2021 a 79,32% al 2025.',
            ],
            [
                'objetivo' => 2,
                'numero' => 6,
                'descripcion' => 'Incrementar el porcentaje de Instituciones del Sistema de Educación Intercultural Bilingüe en los que se implementa el MOSEIB de 4,61% en el año 2022 a 15,12% al 2025.',
            ],
            [
                'objetivo' => 2,
                'numero' => 7,
                'descripcion' => 'Incrementar el porcentaje de Instituciones Educativas del sostenimiento fiscal con cobertura de internet con fines pedagógicos de 51,75% en el año 2022 a 61,20% al 2025.',
            ],
            [
                'objetivo' => 2,
                'numero' => 8,
                'descripcion' => 'Incrementar el número de becas y ayudas económicas adjudicadas para estudios de educación superior de 20.195 en el año 2023 a 28.696 al 2025.',
            ],
            [
                'objetivo' => 2,
                'numero' => 9,
                'descripcion' => 'Incrementar la tasa bruta de matrícula en educación superior terciaria del 40,33% en el año 2022 al 45,54% al 2025.',
            ],
            [
                'objetivo' => 2,
                'numero' => 10,
                'descripcion' => 'Disminuir la tasa de deserción de primer año en tercer nivel de grado del 20,98% en el año 2021 a 17,99% al 2025.',
            ],
            [
                'objetivo' => 2,
                'numero' => 11,
                'descripcion' => 'Incrementar el número de personas tituladas de educación superior técnica y tecnológica de 44.674 en el año 2022 a 60.404 al 2025.',
            ],
            [
                'objetivo' => 2,
                'numero' => 12,
                'descripcion' => 'Incrementar los artículos publicados por las universidades y escuelas politécnicas en revistas indexadas de 13.777 en el año 2022 a 16.727 al 2025.',
            ],
            [
                'objetivo' => 2,
                'numero' => 13,
                'descripcion' => 'Incrementar los investigadores por cada mil integrantes de la Población Económicamente Activa de 0,63 en el año 2022 a 0,75 al 2025.',
            ],
            [
                'objetivo' => 2,
                'numero' => 14,
                'descripcion' => 'Incrementar el número de obras, proyectos y producciones artísticas y culturales con presencia en espacios internacionales, financiados con fondos de fomento no reembolsable de la convocatoria de movilidad internacional de 109 en el año 2023 a 132 al 2025.',
            ],
            [
                'objetivo' => 2,
                'numero' => 15,
                'descripcion' => 'Incrementar el monto de inversión privada destinada al sector artístico, cultural y patrimonial mediante incentivos tributarios culturales de 3,6 millones en el año 2023 a 4,0 millones al 2025.',
            ],
            [
                'objetivo' => 2,
                'numero' => 16,
                'descripcion' => 'Mantener el número de medallas que se obtendrán en el ciclo Olímpico, Paralímpico y Sordolímpico en 148 al 2025.',
            ],


            /*
            |--------------------------------------------------------------------------
            | OBJETIVO 3
            |--------------------------------------------------------------------------
            */
            [
                'objetivo' => 3,
                'numero' => 1,
                'descripcion' => 'Reducir la tasa de homicidios intencionales por cada 100 mil habitantes de 45,11 en el año 2023 a 39,11 al 2025.',
            ],
            [
                'objetivo' => 3,
                'numero' => 2,
                'descripcion' => 'Reducir la tasa de femicidios por cada 100.000 mujeres de 1,14 en el año 2023 a 0,8 al 2025.',
            ],
            [
                'objetivo' => 3,
                'numero' => 3,
                'descripcion' => 'Incrementar el porcentaje de víctimas de violencia sexual detectados o cometidos en el ámbito educativo y que recibieron plan de acompañamiento anual de 91,62% en el año 2023 a 95,00% al 2025.',
            ],
            [
                'objetivo' => 3,
                'numero' => 4,
                'descripcion' => 'Incrementar el porcentaje de incidentes y/o vulnerabilidades de ciberseguridad gestionadas con los prestadores de servicios de telecomunicaciones de 85,38% en el año 2023 a 95,00% al 2025.',
            ],
            [
                'objetivo' => 3,
                'numero' => 5,
                'descripcion' => 'Aumentar el porcentaje de afectación de las estructuras de delincuencia organizada de 0% en el año 2023 a 85% al 2025.',
            ],
            [
                'objetivo' => 3,
                'numero' => 6,
                'descripcion' => 'Incrementar la contribución militar en la seguridad integral de 33,64% en el año 2023 a 39,67% al 2025.',
            ],
            [
                'objetivo' => 3,
                'numero' => 7,
                'descripcion' => 'Incrementar el porcentaje de ataques armados neutralizados que atenten la soberanía del territorio nacional de 50,00% en el año 2023 a 100% al 2025.',
            ],
            [
                'objetivo' => 3,
                'numero' => 8,
                'descripcion' => 'Incrementar el número de personas beneficiadas a través del Servicio Cívico Militar Voluntario de 9.657 en el año 2022 a 36.853 al 2025.',
            ],
            [
                'objetivo' => 3,
                'numero' => 9,
                'descripcion' => 'Incrementar el porcentaje de Personas Privadas de Libertad (PPL) participantes en al menos un eje de tratamiento de 41,67% en el año 2023 a 44,17% al 2025.',
            ],
            [
                'objetivo' => 3,
                'numero' => 10,
                'descripcion' => 'Reducir la tasa de hacinamiento en los Centros de Privación de Libertad de 13,45% en el año 2023 a 5,59% al 2025.',
            ],
            [
                'objetivo' => 3,
                'numero' => 11,
                'descripcion' => 'Incrementar la tasa de defensores públicos por cada 100.000 habitantes de 3,98 en el año 2023 a 4,08 al 2025.',
            ],
            [
                'objetivo' => 3,
                'numero' => 12,
                'descripcion' => 'Mantener la tasa de pendencia de 1,13 al 2025.',
            ],
            [
                'objetivo' => 3,
                'numero' => 13,
                'descripcion' => 'Mantener la tasa de resolución de 0,87 al 2025.',
            ],
            [
                'objetivo' => 3,
                'numero' => 14,
                'descripcion' => 'Mantener la tasa de congestión de 2,13 al 2025.',
            ],
            [
                'objetivo' => 3,
                'numero' => 15,
                'descripcion' => 'Incrementar el índice de identificación del riesgo cantonal de 41,98 en el año 2022 a 59,22 al 2025.',
            ],
            [
                'objetivo' => 3,
                'numero' => 16,
                'descripcion' => 'Incrementar el índice de preparación para casos de desastres cantonal de 32,74% en el año 2022 a 39,80% al 2025.',
            ],


            /*
            |--------------------------------------------------------------------------
            | OBJETIVO 4
            |--------------------------------------------------------------------------
            */
            [
                'objetivo' => 4,
                'numero' => 1,
                'descripcion' => 'Incrementar la participación de exportaciones no tradicionales en las exportaciones no petroleras de 42,73% en el año 2022 a 46,90% al 2025.',
            ],
            [
                'objetivo' => 4,
                'numero' => 2,
                'descripcion' => 'Incrementar las exportaciones de alta, media, baja intensidad tecnológica per cápita de 54,78 en el año 2023 a 55,09 al 2025.',
            ],
            [
                'objetivo' => 4,
                'numero' => 3,
                'descripcion' => 'Incrementar la Inversión Privada de USD 2.317,88 millones en el año 2022 a USD 2.423,89 millones al 2025.',
            ],
            [
                'objetivo' => 4,
                'numero' => 4,
                'descripcion' => 'Incrementar el monto de colocación de crédito de las entidades financieras públicas de USD 6.205,62 millones en el año 2022 a USD 7.375,10 millones al 2025.',
            ],
            [
                'objetivo' => 4,
                'numero' => 5,
                'descripcion' => 'Incrementar la inversión extranjera directa de USD 845,05 millones en el año 2022 a USD 846,10 millones al 2025.',
            ],
            [
                'objetivo' => 4,
                'numero' => 6,
                'descripcion' => 'Incrementar la calificación del Ecuador en el índice regional infrascopio de 48,66% en el año 2022 a 51,70% al 2025.',
            ],
            [
                'objetivo' => 4,
                'numero' => 7,
                'descripcion' => 'Incrementar la proporción del Presupuesto General del Estado financiado por ingresos tributarios internos de 32,37% en el año 2022 a 34,16% al 2025.',
            ],
            [
                'objetivo' => 4,
                'numero' => 8,
                'descripcion' => 'Mantener el porcentaje promedio anual de cobertura de los pasivos del primer sistema de balance BCE con las Reservas Internacionales (RI) de 100% al 2025.',
            ],
            [
                'objetivo' => 4,
                'numero' => 9,
                'descripcion' => 'Mantener la deuda pública y otras obligaciones de pago del Sector Público No Financiero (consolidada) como porcentaje del Producto Interno Bruto bajo el 57% al año 2025.',
            ],
            [
                'objetivo' => 4,
                'numero' => 10,
                'descripcion' => 'Incrementar el grado de implementación de planes de acción y políticas de compras públicas sostenibles de 14,00 puntos en el año 2023 a 26,00 puntos al 2025.',
            ],


            /*
            |--------------------------------------------------------------------------
            | OBJETIVO 5
            |--------------------------------------------------------------------------
            */
            [
                'objetivo' => 5,
                'numero' => 1,
                'descripcion' => 'Incrementar la tasa de variación de las exportaciones agropecuarias y agroindustriales de 1,54% en el año 2022 a 12,04% al 2025.',
            ],
            [
                'objetivo' => 5,
                'numero' => 2,
                'descripcion' => 'Incrementar el número de mujeres rurales de la AFC que se desempeñan como promotoras de sistemas de producción sustentable y sostenible de 1.652 en el 2023 a 2.852 al 2025.',
            ],
            [
                'objetivo' => 5,
                'numero' => 3,
                'descripcion' => 'Incrementar el porcentaje de productores asociados, registrados como Agricultura Familiar Campesina que se vinculan a sistemas de comercialización de 33,7% en el año 2023 a 45,7% al 2025.',
            ],
            [
                'objetivo' => 5,
                'numero' => 4,
                'descripcion' => 'Incrementar el porcentaje de cobertura con riego tecnificado parcelario de pequeños y medianos productores de 18,19% en el año 2022 a 21,31% al 2025.',
            ],
            [
                'objetivo' => 5,
                'numero' => 5,
                'descripcion' => 'Incrementar el rendimiento de la productividad agrícola nacional de 129,97 en el año 2022 a 131,04 al 2025.',
            ],
            [
                'objetivo' => 5,
                'numero' => 6,
                'descripcion' => 'Incrementar el VAB Pesca y Acuicultura sobre VAB ramas primarias de 16,86% en el año 2022 a 18,38% al 2025.',
            ],
            [
                'objetivo' => 5,
                'numero' => 7,
                'descripcion' => 'Incrementar el VAB manufacturero sobre VAB ramas primarias de 1,72 en el año 2022 a 1,73 al 2025.',
            ],
            [
                'objetivo' => 5,
                'numero' => 8,
                'descripcion' => 'Incrementar el valor agregado bruto de la manufactura per cápita de USD 856,04 en el año 2022 a USD 954,72 al 2025.',
            ],
            [
                'objetivo' => 5,
                'numero' => 9,
                'descripcion' => 'Incrementar el número de Escuelas de Fortalecimiento Productivo Pecuario establecidas de 97 en el año 2023 a 281 al 2025.',
            ],
            [
                'objetivo' => 5,
                'numero' => 10,
                'descripcion' => 'Incrementar el ingreso de divisas por concepto de turismo receptor de USD 1.802,63 millones en el año 2022 a USD 2.434,00 millones al 2025.',
            ],
            [
                'objetivo' => 5,
                'numero' => 11,
                'descripcion' => 'Incrementar el número de entradas de visitantes no residentes al Ecuador de 1,2 millones en el año 2022 a 2,0 millones al 2025.',
            ],
            [
                'objetivo' => 5,
                'numero' => 12,
                'descripcion' => 'Incrementar la población con empleo en las principales actividades turísticas de 533.289 en el año 2022 a 550.000 al 2025.',
            ],


            /*
            |--------------------------------------------------------------------------
            | OBJETIVO 6
            |--------------------------------------------------------------------------
            */
            [
                'objetivo' => 6,
                'numero' => 1,
                'descripcion' => 'Aumentar la tasa de empleo adecuado (15 años y más) de 34,41% en el año 2022 a 39,09% al 2025.',
            ],
            [
                'objetivo' => 6,
                'numero' => 2,
                'descripcion' => 'Reducir la tasa de desempleo de 4,35% en el año 2022 a 3,73% al 2025.',
            ],
            [
                'objetivo' => 6,
                'numero' => 3,
                'descripcion' => 'Reducir la tasa de desempleo juvenil (18 a 29 años) de 9,29% en el año 2022 a 8,00% al 2025.',
            ],
            [
                'objetivo' => 6,
                'numero' => 4,
                'descripcion' => 'Reducir el trabajo infantil (5 a 14 años) de 5,78% en el año 2022 a 4,90% al 2025.',
            ],
            [
                'objetivo' => 6,
                'numero' => 5,
                'descripcion' => 'Reducir la brecha de empleo adecuado entre hombres y mujeres (15 y más años de edad) de 32,53% en el año 2022 a 28,80% al 2025.',
            ],
            [
                'objetivo' => 6,
                'numero' => 6,
                'descripcion' => 'Reducir la brecha salarial entre hombres y mujeres de 19,23% en el año 2022 a 18,17% al 2025.',
            ],


            /*
            |--------------------------------------------------------------------------
            | OBJETIVO 7
            |--------------------------------------------------------------------------
            */
            [
                'objetivo' => 7,
                'numero' => 1,
                'descripcion' => 'Incrementar la capacidad instalada de nueva generación eléctrica de 7.154,57 MW en el año 2022 a 8.584,38 MW al 2025.',
            ],
            [
                'objetivo' => 7,
                'numero' => 2,
                'descripcion' => 'Reducir las pérdidas de energía eléctrica en los sistemas de distribución de 13,25% en el año 2022 a 13,22% al 2025.',
            ],
            [
                'objetivo' => 7,
                'numero' => 3,
                'descripcion' => 'Incrementar la potencia instalada en subestaciones de distribución para atender el crecimiento de la demanda de energía eléctrica del país de 6.958,35 MVA en el año 2023 a 7.098,21 MVA al 2025.',
            ],
            [
                'objetivo' => 7,
                'numero' => 4,
                'descripcion' => 'Incrementar el volumen de producción de hidrocarburos de 478.824,46 Barriles Equivalentes de Petróleo en el año 2023 a 550.033,60 Barriles Equivalentes de Petróleo al 2025.',
            ],
            [
                'objetivo' => 7,
                'numero' => 5,
                'descripcion' => 'Incrementar las remediaciones de fuentes de contaminación de la industria hidrocarburífera ejecutadas por el Operador Estatal responsable y avaladas por la Autoridad Ambiental y del Recurso Hídrico Nacional de 1.846 en el año 2023 a 2.105 en el año 2025.',
            ],
            [
                'objetivo' => 7,
                'numero' => 6,
                'descripcion' => 'Incrementar el ahorro de combustibles en Barriles Equivalentes de Petróleo por la Optimización de Generación Eléctrica y Eficiencia Energética en el Sector de Hidrocarburos de 32,6 millones en el año 2023 a 41,5 millones al 2025.',
            ],
            [
                'objetivo' => 7,
                'numero' => 7,
                'descripcion' => 'Incrementar la recaudación tributaria del sector minero de USD 202 millones en el año 2022 a USD 248 millones al 2025.',
            ],
            [
                'objetivo' => 7,
                'numero' => 8,
                'descripcion' => 'Incrementar las exportaciones mineras de USD 2.775 millones en el año 2022 a USD 3.515 millones al 2025.',
            ],
            [
                'objetivo' => 7,
                'numero' => 9,
                'descripcion' => 'Incrementar la superficie potencial de riego y drenaje con viabilidad técnica de 9.402,81 ha en el año 2023 a 13.402,81 ha al 2025.',
            ],
            [
                'objetivo' => 7,
                'numero' => 10,
                'descripcion' => 'Incrementar el territorio nacional bajo garantías preventivas y mecanismos de protección del recurso hídrico de 264.039,89 ha en el año 2023 a 275.000,00 ha al 2025.',
            ],
            [
                'objetivo' => 7,
                'numero' => 11,
                'descripcion' => 'Incrementar la población con acceso a agua apta para consumo humano de 3.017.778 en el año 2023 a 4.007.994 al 2025.',
            ],
            [
                'objetivo' => 7,
                'numero' => 12,
                'descripcion' => 'Incrementar los residuos y/o desechos recuperados en el marco de la aplicación de la política de responsabilidad extendida del productor de 44,06% en el año 2022 a 56,06% al 2025.',
            ],
            [
                'objetivo' => 7,
                'numero' => 13,
                'descripcion' => 'Reducir la vulnerabilidad al cambio climático en función de la capacidad adaptativa de 82,98% en el año 2023 a 82,81% al 2025.',
            ],
            [
                'objetivo' => 7,
                'numero' => 14,
                'descripcion' => 'Mantener la proporción de territorio nacional bajo conservación o manejo ambiental de 22,16% al 2025.',
            ],
            [
                'objetivo' => 7,
                'numero' => 15,
                'descripcion' => 'Incrementar el índice de Inversión en la Reducción de Riesgo cantonal de 42,47 en el año 2022 a 51,77 al 2025.',
            ],


            /*
            |--------------------------------------------------------------------------
            | OBJETIVO 8
            |--------------------------------------------------------------------------
            */
            [
                'objetivo' => 8,
                'numero' => 1,
                'descripcion' => 'Incrementar el porcentaje de cobertura poblacional con tecnología 4G de 78,08% en el año 2022 a 80,00% al 2025.',
            ],
            [
                'objetivo' => 8,
                'numero' => 2,
                'descripcion' => 'Incrementar el porcentaje de parroquias rurales y cabeceras cantonales con presencia del servicio de internet fijo a través de enlaces de fibra óptica de 75,82% en el año 2022 a 86,79% al 2025.',
            ],
            [
                'objetivo' => 8,
                'numero' => 3,
                'descripcion' => 'Reducir la tasa de mortalidad por accidentes de tránsito in situ, de 13,37 en el 2023 a 12,66 para el 2025 por cada 100.000 habitantes.',
            ],
            [
                'objetivo' => 8,
                'numero' => 4,
                'descripcion' => 'Mantener la tasa de accidentes en la operación de transporte aéreo comercial de cero accidentes al 2025.',
            ],
            [
                'objetivo' => 8,
                'numero' => 5,
                'descripcion' => 'Incrementar el mantenimiento de la Red Vial estatal con modelo de gestión sostenible de 24,60% en el 2023 a 26,90% al 2025.',
            ],
            [
                'objetivo' => 8,
                'numero' => 6,
                'descripcion' => 'Incrementar el porcentaje de kilómetros en Buen Estado de la Red Vial Estatal de 42,29% en el año 2023 a 44,30% al 2025.',
            ],


            /*
            |--------------------------------------------------------------------------
            | OBJETIVO 9
            |--------------------------------------------------------------------------
            */
            [
                'objetivo' => 9,
                'numero' => 1,
                'descripcion' => 'Aumentar el índice de percepción de la calidad de los servicios públicos en general de 6,05 en el año 2022 a 6,20 al 2025.',
            ],
            [
                'objetivo' => 9,
                'numero' => 2,
                'descripcion' => 'Aumentar el índice de Implementación de la Mejora Regulatoria en el Estado para optimizar la calidad de vida de los ciudadanos, el clima de negocios y la competitividad de 39,60% en el año 2023 a 41,60% al 2025.',
            ],
            [
                'objetivo' => 9,
                'numero' => 3,
                'descripcion' => 'Reducir el posicionamiento en el ranking de percepción de corrupción mundial del puesto 115 en el año 2023 a 109 al 2025.',
            ],
            [
                'objetivo' => 9,
                'numero' => 4,
                'descripcion' => 'Incrementar el monto desembolsado de Cooperación Internacional No Reembolsable - CINR oficial y no gubernamental de USD 261,71 millones en el año 2022 a USD 327,14 millones al 2025.',
            ],
            [
                'objetivo' => 9,
                'numero' => 5,
                'descripcion' => 'Incrementar el porcentaje de Consejos Ciudadanos Sectoriales conformados de 27,59% en el año 2023 a 72,41% al 2025.',
            ],
            [
                'objetivo' => 9,
                'numero' => 6,
                'descripcion' => 'Incrementar el número de procesos de formación, capacitación, promoción y apoyo técnico a los espacios, mecanismos e instancias de Participación Ciudadana de 1.020 en el año 2023 a 2.111 al 2025.',
            ],
            [
                'objetivo' => 9,
                'numero' => 7,
                'descripcion' => 'Incrementar el porcentaje de entidades públicas que implementan el modelo de Gobierno Abierto de 40,00% en el año 2023 a 52,27% al 2025.',
            ],
            [
                'objetivo' => 9,
                'numero' => 8,
                'descripcion' => 'Incrementar el porcentaje de instituciones que llevan a cabo el proceso de rendición de cuentas de 81,37% en el año 2022 a 82,12% al 2025.',
            ],
            [
                'objetivo' => 9,
                'numero' => 9,
                'descripcion' => 'Incrementar el porcentaje de autoridades de elección popular que llevan a cabo el proceso de rendición de cuentas de 63,20% en el 2022 a 63,95% al 2025.',
            ],
            [
                'objetivo' => 9,
                'numero' => 10,
                'descripcion' => 'Mantener el índice de capacidad operativa promedio de los Gobiernos Autónomos Descentralizados municipales – ICO al menos en 17,28 puntos al 2025.',
            ],


            /*
            |--------------------------------------------------------------------------
            | OBJETIVO 10
            |--------------------------------------------------------------------------
            */
            [
                'objetivo' => 10,
                'numero' => 1,
                'descripcion' => 'Incrementar el índice de fortalecimiento de la gobernanza local y multinivel de los Gobiernos Autónomos Descentralizados cantonales de 41,44 en el año 2022 a 56,26 al 2025.',
            ],
            [
                'objetivo' => 10,
                'numero' => 2,
                'descripcion' => 'Mantener la capacidad de protección financiera para la reducción de riesgos de los Gobiernos Autónomos Descentralizados cantonales de 27,73 al 2025.',
            ],


        ];

        foreach ($metas as $meta) {

            $objetivo = PndObjetivo::where(
                'numero',
                $meta['objetivo']
            )->firstOrFail();

            PndMeta::updateOrCreate(
                [
                    'pnd_objetivo_id' => $objetivo->id,
                    'numero' => $meta['numero'],
                ],
                [
                    'descripcion' => $meta['descripcion'],
                ]
            );
        }
    }
}