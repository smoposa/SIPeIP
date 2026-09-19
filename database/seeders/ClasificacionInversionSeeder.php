<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ClasificacionInversionSeeder extends Seeder
{
    /**
     * Cargar los macrosectores, sectores y subsectores oficiales
     * definidos en el Anexo No. 1 de la Guía para la presentación
     * de programas y proyectos de inversión pública.
     */
    public function run(): void
    {
        $clasificacion = $this->clasificacionOficial();

        DB::transaction(function () use ($clasificacion): void {

            foreach ($clasificacion as $nombreMacrosector => $sectores) {

                /*
                 * Registrar o actualizar el macrosector.
                 */
                $macrosector = DB::table('macrosectores')
                    ->where('nombre', $nombreMacrosector)
                    ->first();

                if ($macrosector) {
                    DB::table('macrosectores')
                        ->where('id', $macrosector->id)
                        ->update([
                            'estado' => 'Activo',
                            'updated_at' => now(),
                        ]);

                    $macrosectorId = $macrosector->id;
                } else {
                    $macrosectorId = DB::table('macrosectores')
                        ->insertGetId([
                            'nombre' => $nombreMacrosector,
                            'estado' => 'Activo',
                            'created_at' => now(),
                            'updated_at' => now(),
                        ]);
                }

                foreach ($sectores as $nombreSector => $subsectores) {

                    /*
                     * Registrar o actualizar el sector.
                     */
                    $sector = DB::table('sectores')
                        ->where('macrosector_id', $macrosectorId)
                        ->where('nombre', $nombreSector)
                        ->first();

                    if ($sector) {
                        DB::table('sectores')
                            ->where('id', $sector->id)
                            ->update([
                                'estado' => 'Activo',
                                'updated_at' => now(),
                            ]);

                        $sectorId = $sector->id;
                    } else {
                        $sectorId = DB::table('sectores')
                            ->insertGetId([
                                'macrosector_id' => $macrosectorId,
                                'nombre' => $nombreSector,
                                'estado' => 'Activo',
                                'created_at' => now(),
                                'updated_at' => now(),
                            ]);
                    }

                    foreach ($subsectores as $codigo => $nombreSubsector) {

                        /*
                         * Registrar o actualizar el subsector.
                         */
                        $subsector = DB::table('subsectores')
                            ->where('codigo', $codigo)
                            ->first();

                        $datosSubsector = [
                            'sector_id' => $sectorId,
                            'nombre' => $nombreSubsector,
                            'nivel_gobierno' => 'Nacional',
                            'estado' => 'Activo',
                            'updated_at' => now(),
                        ];

                        if ($subsector) {
                            DB::table('subsectores')
                                ->where('id', $subsector->id)
                                ->update($datosSubsector);
                        } else {
                            DB::table('subsectores')->insert([
                                ...$datosSubsector,
                                'codigo' => $codigo,
                                'created_at' => now(),
                            ]);
                        }
                    }
                }
            }
        });
    }

    /**
     * Clasificación oficial del Anexo No. 1.
     *
     * @return array<string, array<string, array<string, string>>>
     */
    private function clasificacionOficial(): array
    {
        return [

            /*
            |--------------------------------------------------------------------------
            | MACROSECTOR: SOCIAL
            |--------------------------------------------------------------------------
            */

            'Social' => [

                'Salud' => [
                    'A0101' => 'Administración Salud',
                    'A0102' => 'Primer Nivel de Atención',
                    'A0103' => 'Segundo Nivel de Atención',
                    'A0104' => 'Tercer Nivel de Atención',
                    'A0105' => 'Productos Farmacéuticos y Químicos',
                    'A0121' => 'Intersubsectorial Salud',
                ],

                'Cultura' => [
                    'A0301' => 'Administración Arte y Cultura',
                    'A0302' => 'Arte y Cultura',
                    'A0321' => 'Intersubsectorial Cultura',
                ],

                'Equipamiento Urbano y Vivienda' => [
                    'A0601' => 'Administración Equipamiento Urbano y Vivienda',
                    'A0602' => 'Agua Potable',
                    'A0603' => 'Alcantarillado',
                    'A0604' => 'Vivienda',
                    'A0605' => 'Reasentamientos Humanos',
                    'A0606' => 'Desechos Sólidos',
                    'A0607' => 'Otro Equipamiento Urbano',
                    'A0621' => 'Intersubsectorial Equipamiento Urbano y Vivienda',
                ],

                'Protección Social y Familiar' => [
                    'A0701' => 'Administración Protección Social y Familiar',
                    'A0702' => 'Atención a Víctimas',
                    'A0703' => 'Atención Primera Infancia',
                    'A0704' => 'Atención Adolescentes Jóvenes',
                    'A0705' => 'Atención Adultos Mayores',
                    'A0706' => 'Atención Discapacitados',
                    'A0707' => 'Equidad de Género',
                    'A0708' => 'Inclusión Social',
                    'A0709' => 'Desarrollo Rural',
                    'A0721' => 'Intersubsectorial Protección Social y Familiar',
                ],

                'Deporte' => [
                    'A0901' => 'Administración Deporte',
                    'A0902' => 'Deporte Competitivo',
                    'A0903' => 'Deporte Formativo',
                    'A0904' => 'Deporte Recreativo',
                    'A0921' => 'Intersubsectorial Deporte',
                ],
            ],

            /*
            |--------------------------------------------------------------------------
            | MACROSECTOR: SECTORES ESTRATÉGICOS
            |--------------------------------------------------------------------------
            */

            'Sectores Estratégicos' => [

                'Energía' => [
                    'B1001' => 'Administración Energía',
                    'B1002' => 'Alumbrado Público',
                    'B1003' => 'Distribución y Conexión Final Usuarios',
                    'B1004' => 'Generación',
                    'B1005' => 'Transmisión',
                    'B1006' => 'Energías Renovables',
                    'B1021' => 'Intersubsectorial Energía',
                ],

                'Minería e Hidrocarburos' => [
                    'B1101' => 'Administración Minería e Hidrocarburos',
                    'B1102' => 'Hidrocarburos',
                    'B1103' => 'Minería',
                    'B1121' => 'Intersubsectorial Minería e Hidrocarburos',
                ],

                'Ambiente' => [
                    'B0801' => 'Administración Ambiente',
                    'B0802' => 'Conservación y Manejo Ambiental',
                    'B0803' => 'Prevención, Mitigación y Gestión del Riesgo',
                    'B0804' => 'Cadena Forestal Sustentable y sus Productos Elaborados',
                    'B0821' => 'Intersubsectorial Ambiente',
                ],

                'Telecomunicaciones' => [
                    'B1201' => 'Administración Telecomunicaciones',
                    'B1202' => 'Comunicaciones',
                    'B1221' => 'Intersubsectorial Telecomunicaciones',
                ],
            ],

            /*
            |--------------------------------------------------------------------------
            | MACROSECTOR: FOMENTO A LA PRODUCCIÓN
            |--------------------------------------------------------------------------
            */

            'Fomento a la Producción' => [

                'Agricultura, Ganadería y Pesca' => [
                    'C1501' => 'Administración Agricultura, Ganadería y Pesca',
                    'C1502' => 'Agricultura, Agroindustria y Alimentos',
                    'C1503' => 'Recuperación de Cultivos',
                    'C1504' => 'Ganadería',
                    'C1505' => 'Pesca',
                    'C1506' => 'Riego',
                    'C1521' => 'Intersubsectorial Agricultura, Ganadería y Pesca',
                ],

                'Fomento a la Producción' => [
                    'C1601' => 'Administración Fomento a la Producción',
                    'C1602' => 'Comercio',
                    'C1603' => 'Financiamiento',
                    'C1604' => 'Otras Industrias',
                    'C1605' => 'Turismo',
                    'C1606' => 'Confecciones y Calzado',
                    'C1607' => 'Metalmecánica y Vehículos',
                    'C1608' => 'Siderurgia',
                ],

                'Vialidad y Transporte' => [
                    'C1301' => 'Administración Vialidad y Transporte',
                    'C1302' => 'Terminales Marítimos y Puertos',
                    'C1303' => 'Terminales Terrestres',
                    'C1304' => 'Transporte Aéreo',
                    'C1305' => 'Transporte Terrestre',
                    'C1306' => 'Transporte Ferroviario',
                    'C1307' => 'Transporte Marítimo, Fluvial y Lacustre',
                    'C1308' => 'Vialidad Especial: Ciclovías, Senderos Peatonales, Pasos Peatonales, etc.',
                    'C1321' => 'Intersubsectorial Vialidad y Transporte',
                ],
            ],

            /*
            |--------------------------------------------------------------------------
            | MACROSECTOR: MULTISECTORIAL
            |--------------------------------------------------------------------------
            */

            'Multisectorial' => [

                'Planificación y Regulación' => [
                    'D1801' => 'Administración Planificación y Regulación',
                ],

                'Manejo Fiscal' => [
                    'D1901' => 'Administración Fiscal',
                ],

                'Legislativo' => [
                    'D2001' => 'Administración Legislativa',
                ],

                'Información' => [
                    'D2201' => 'Administración Información',
                    'D2202' => 'Generación de Información',
                ],

                'Asuntos del Exterior' => [
                    'F2101' => 'Administración Asuntos del Exterior',
                ],
            ],

            /*
            |--------------------------------------------------------------------------
            | MACROSECTOR: SEGURIDAD
            |--------------------------------------------------------------------------
            */

            'Seguridad' => [

                'Seguridad' => [
                    'F0401' => 'Administración Seguridad',
                    'F0402' => 'Rehabilitación',
                    'F0403' => 'Seguridad',
                    'F0421' => 'Intersubsectorial Seguridad',
                ],

                'Justicia' => [
                    'F0501' => 'Administración Justicia',
                    'F0502' => 'Asistencia Judicial',
                    'F0521' => 'Intersubsectorial Justicia',
                ],

                'Defensa' => [
                    'F1401' => 'Administración Defensa',
                    'F1402' => 'Defensa',
                    'F1421' => 'Intersubsectorial Defensa',
                ],
            ],

            /*
            |--------------------------------------------------------------------------
            | MACROSECTOR: TALENTO HUMANO
            |--------------------------------------------------------------------------
            */

            'Talento Humano' => [

                'Educación' => [
                    'E2301' => 'Administración Educación',
                    'E2302' => 'Educación Prebásica',
                    'E2303' => 'Educación Básica y Media',
                    'E2304' => 'Educación Media Técnico',
                    'E2305' => 'Educación Superior',
                    'E2306' => 'Educación Diferencial y Especial',
                    'E2307' => 'Educación para Adultos',
                    'E2321' => 'Intersubsectorial Educación',
                ],

                'Proyectos de Investigación y Becas' => [
                    'E1701' => 'Administración Proyectos de Investigación y Becas',
                    'E1702' => 'Becas',
                    'E1703' => 'Proyecto Investigación',
                    'E1704' => 'Biotecnología',
                    'E1705' => 'Desarrollo de Tecnología (Hardware y Software)',
                ],
            ],
        ];
    }
}