<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class EntidadesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('entidades')->delete();
        DB::statement('ALTER TABLE entidades AUTO_INCREMENT = 1;');

        DB::table('entidades')->insert([

            [
                'codigoInstitucional' => 'SNP',
                'ruc' => '1760001200001',
                'nombre' => 'Secretaría Nacional de Planificación',
                'siglas' => 'SNP',
                'tipoEntidad' => 'Secretaría Nacional',
                'nivelGobierno' => 'Gobierno Central',
                'provincia' => 'Pichincha',
                'canton' => 'Quito',
                'parroquia' => 'Iñaquito',
                'direccion' => 'Av. Patria y Av. 12 de Octubre',
                'telefono' => '(02) 397-8900',
                'correoInstitucional' => 'info@planificacion.gob.ec',
                'estado' => 'Activo',
                'created_at' => now(),
                'updated_at' => now(),
            ],

            [
                'codigoInstitucional' => 'MSP',
                'ruc' => '1760005000001',
                'nombre' => 'Ministerio de Salud Pública',
                'siglas' => 'MSP',
                'tipoEntidad' => 'Ministerio',
                'nivelGobierno' => 'Gobierno Central',
                'provincia' => 'Pichincha',
                'canton' => 'Quito',
                'parroquia' => 'Itchimbía',
                'direccion' => 'Av. Quitumbe Ñan y Av. Amaru Ñan',
                'telefono' => '(02) 381-4400',
                'correoInstitucional' => 'info@salud.gob.ec',
                'estado' => 'Activo',
                'created_at' => now(),
                'updated_at' => now(),
            ],

            [
                'codigoInstitucional' => 'MTOP',
                'ruc' => '1760005600001',
                'nombre' => 'Ministerio de Transporte y Obras Públicas',
                'siglas' => 'MTOP',
                'tipoEntidad' => 'Ministerio',
                'nivelGobierno' => 'Gobierno Central',
                'provincia' => 'Pichincha',
                'canton' => 'Quito',
                'parroquia' => 'Iñaquito',
                'direccion' => 'Juan León Mera N26-220 y Av. Orellana',
                'telefono' => '(02) 397-4600',
                'correoInstitucional' => 'info@mtop.gob.ec',
                'estado' => 'Activo',
                'created_at' => now(),
                'updated_at' => now(),
            ],

            [
                'codigoInstitucional' => 'MINEDUC',
                'ruc' => '1760007000001',
                'nombre' => 'Ministerio de Educación',
                'siglas' => 'MINEDUC',
                'tipoEntidad' => 'Ministerio',
                'nivelGobierno' => 'Gobierno Central',
                'provincia' => 'Pichincha',
                'canton' => 'Quito',
                'parroquia' => 'Iñaquito',
                'direccion' => 'Av. Amazonas N34-451',
                'telefono' => '(02) 396-1300',
                'correoInstitucional' => 'info@educacion.gob.ec',
                'estado' => 'Activo',
                'created_at' => now(),
                'updated_at' => now(),
            ],

            [
                'codigoInstitucional' => 'MAG',
                'ruc' => '1760001470001',
                'nombre' => 'Ministerio de Agricultura y Ganadería',
                'siglas' => 'MAG',
                'tipoEntidad' => 'Ministerio',
                'nivelGobierno' => 'Gobierno Central',
                'provincia' => 'Pichincha',
                'canton' => 'Quito',
                'parroquia' => 'Iñaquito',
                'direccion' => 'Av. Eloy Alfaro N30-350',
                'telefono' => '(02) 396-0100',
                'correoInstitucional' => 'info@mag.gob.ec',
                'estado' => 'Activo',
                'created_at' => now(),
                'updated_at' => now(),
            ],

            [
                'codigoInstitucional' => 'MIES',
                'ruc' => '1760001200002',
                'nombre' => 'Ministerio de Inclusión Económica y Social',
                'siglas' => 'MIES',
                'tipoEntidad' => 'Ministerio',
                'nivelGobierno' => 'Gobierno Central',
                'provincia' => 'Pichincha',
                'canton' => 'Quito',
                'parroquia' => 'Iñaquito',
                'direccion' => 'Av. Amaru Ñan',
                'telefono' => '(02) 398-3000',
                'correoInstitucional' => 'info@inclusion.gob.ec',
                'estado' => 'Activo',
                'created_at' => now(),
                'updated_at' => now(),
            ],

            [
                'codigoInstitucional' => 'MDT',
                'ruc' => '1760003200001',
                'nombre' => 'Ministerio del Trabajo',
                'siglas' => 'MDT',
                'tipoEntidad' => 'Ministerio',
                'nivelGobierno' => 'Gobierno Central',
                'provincia' => 'Pichincha',
                'canton' => 'Quito',
                'parroquia' => 'Iñaquito',
                'direccion' => 'Av. República de El Salvador',
                'telefono' => '(02) 381-4000',
                'correoInstitucional' => 'info@trabajo.gob.ec',
                'estado' => 'Activo',
                'created_at' => now(),
                'updated_at' => now(),
            ],

            [
                'codigoInstitucional' => 'MIDUVI',
                'ruc' => '1760004800001',
                'nombre' => 'Ministerio de Desarrollo Urbano y Vivienda',
                'siglas' => 'MIDUVI',
                'tipoEntidad' => 'Ministerio',
                'nivelGobierno' => 'Gobierno Central',
                'provincia' => 'Pichincha',
                'canton' => 'Quito',
                'parroquia' => 'Iñaquito',
                'direccion' => 'Av. Quitumbe Ñan',
                'telefono' => '(02) 298-3600',
                'correoInstitucional' => 'info@miduvi.gob.ec',
                'estado' => 'Activo',
                'created_at' => now(),
                'updated_at' => now(),
            ],

            [
                'codigoInstitucional' => 'GADDMQ',
                'ruc' => '1760003410001',
                'nombre' => 'Gobierno Autónomo Descentralizado del Distrito Metropolitano de Quito',
                'siglas' => 'GADDMQ',
                'tipoEntidad' => 'Gobierno Autónomo Descentralizado',
                'nivelGobierno' => 'Municipal',
                'provincia' => 'Pichincha',
                'canton' => 'Quito',
                'parroquia' => 'Centro Histórico',
                'direccion' => 'Venezuela y Chile',
                'telefono' => '(02) 395-2300',
                'correoInstitucional' => 'info@quito.gob.ec',
                'estado' => 'Activo',
                'created_at' => now(),
                'updated_at' => now(),
            ],

            [
                'codigoInstitucional' => 'GADP',
                'ruc' => null,
                'nombre' => 'Gobierno Autónomo Descentralizado Parroquial Rural de Pacto',
                'siglas' => 'GAD Pacto',
                'tipoEntidad' => 'Gobierno Autónomo Descentralizado',
                'nivelGobierno' => 'Parroquial',
                'provincia' => 'Pichincha',
                'canton' => 'Quito',
                'parroquia' => 'Pacto',
                'direccion' => 'Parroquia Pacto',
                'telefono' => null,
                'correoInstitucional' => null,
                'estado' => 'Activo',
                'created_at' => now(),
                'updated_at' => now(),
            ],

            [
                'codigoInstitucional' => 'GADG',
                'ruc' => null,
                'nombre' => 'Gobierno Autónomo Descentralizado Parroquial Rural de Gualea',
                'siglas' => 'GAD Gualea',
                'tipoEntidad' => 'Gobierno Autónomo Descentralizado',
                'nivelGobierno' => 'Parroquial',
                'provincia' => 'Pichincha',
                'canton' => 'Quito',
                'parroquia' => 'Gualea',
                'direccion' => 'Parroquia Gualea',
                'telefono' => null,
                'correoInstitucional' => null,
                'estado' => 'Activo',
                'created_at' => now(),
                'updated_at' => now(),
            ],

        ]);
    }
}