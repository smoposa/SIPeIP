<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

use App\Models\Rol;
use App\Models\Entidad;

class UsersSeeder extends Seeder
{
    /**
     * Ejecutar el seeder de usuarios de prueba del sistema.
     */
    public function run(): void
    {
        DB::table('users')->delete();
        DB::statement('ALTER TABLE users AUTO_INCREMENT = 1;');

        /*
        |--------------------------------------------------------------------------
        | SECRETARÍA NACIONAL DE PLANIFICACIÓN
        |--------------------------------------------------------------------------
        */

        DB::table('users')->insert([

            // 1. Administrador Global
            [
                'rol_id' => Rol::where('codigo', 'ADMIN_GLOBAL')->value('id'),
                'entidad_id' => Entidad::where('codigoInstitucional', 'SNP')->value('id'),
                'identificacion' => '1710000001',
                'nombres' => 'Carlos',
                'apellidos' => 'Andrade',
                'cargo' => 'Administrador Global',
                'estado' => 'Activo',
                'name' => 'Carlos Andrade',
                'email' => 'carlos.andrade@planificacion.gob.ec',
                'email_verified_at' => now(),
                'password' => Hash::make('Admin.123'),
                'remember_token' => null,
                'created_at' => now(),
                'updated_at' => now(),
            ],

            // 2. Administrador del Sistema
            [
                'rol_id' => Rol::where('codigo', 'ADMIN_SISTEMA')->value('id'),
                'entidad_id' => Entidad::where('codigoInstitucional', 'SNP')->value('id'),
                'identificacion' => '1710000002',
                'nombres' => 'Laura',
                'apellidos' => 'Mendoza',
                'cargo' => 'Administrador del Sistema',
                'estado' => 'Activo',
                'name' => 'Laura Mendoza',
                'email' => 'laura.mendoza@planificacion.gob.ec',
                'email_verified_at' => now(),
                'password' => Hash::make('Admin.123'),
                'remember_token' => null,
                'created_at' => now(),
                'updated_at' => now(),
            ],

        ]);


        /*
        |--------------------------------------------------------------------------
        | MINISTERIO DE TRANSPORTE Y OBRAS PÚBLICAS
        | Entidad principal para el caso de estudio vial
        |--------------------------------------------------------------------------
        */

        DB::table('users')->insert([

            // 3. Administrador Institucional
            [
                'rol_id' => Rol::where('codigo', 'ADMIN_INSTITUCIONAL')->value('id'),
                'entidad_id' => Entidad::where('codigoInstitucional', 'MTOP')->value('id'),
                'identificacion' => '1710000003',
                'nombres' => 'María',
                'apellidos' => 'Fernández',
                'cargo' => 'Administradora Institucional',
                'estado' => 'Activo',
                'name' => 'María Fernández',
                'email' => 'maria.fernandez@mtop.gob.ec',
                'email_verified_at' => now(),
                'password' => Hash::make('Admin.123'),
                'remember_token' => null,
                'created_at' => now(),
                'updated_at' => now(),
            ],

            // 4. Director de Planificación
            [
                'rol_id' => Rol::where('codigo', 'DIRECTOR_PLANIFICACION')->value('id'),
                'entidad_id' => Entidad::where('codigoInstitucional', 'MTOP')->value('id'),
                'identificacion' => '1710000004',
                'nombres' => 'Jorge',
                'apellidos' => 'Herrera',
                'cargo' => 'Director de Planificación',
                'estado' => 'Activo',
                'name' => 'Jorge Herrera',
                'email' => 'jorge.herrera@mtop.gob.ec',
                'email_verified_at' => now(),
                'password' => Hash::make('Admin.123'),
                'remember_token' => null,
                'created_at' => now(),
                'updated_at' => now(),
            ],

            // 5. Analista de Planificación
            [
                'rol_id' => Rol::where('codigo', 'ANALISTA_PLANIFICACION')->value('id'),
                'entidad_id' => Entidad::where('codigoInstitucional', 'MTOP')->value('id'),
                'identificacion' => '1710000005',
                'nombres' => 'Andrea',
                'apellidos' => 'Paredes',
                'cargo' => 'Analista de Planificación',
                'estado' => 'Activo',
                'name' => 'Andrea Paredes',
                'email' => 'andrea.paredes@mtop.gob.ec',
                'email_verified_at' => now(),
                'password' => Hash::make('Admin.123'),
                'remember_token' => null,
                'created_at' => now(),
                'updated_at' => now(),
            ],

            // 6. Director de Inversión Pública
            [
                'rol_id' => Rol::where('codigo', 'DIRECTOR_INVERSION')->value('id'),
                'entidad_id' => Entidad::where('codigoInstitucional', 'MTOP')->value('id'),
                'identificacion' => '1710000006',
                'nombres' => 'Luis',
                'apellidos' => 'Morales',
                'cargo' => 'Director de Inversión Pública',
                'estado' => 'Activo',
                'name' => 'Luis Morales',
                'email' => 'luis.morales@mtop.gob.ec',
                'email_verified_at' => now(),
                'password' => Hash::make('Admin.123'),
                'remember_token' => null,
                'created_at' => now(),
                'updated_at' => now(),
            ],

            // 7. Analista de Inversión Pública
            [
                'rol_id' => Rol::where('codigo', 'ANALISTA_INVERSION')->value('id'),
                'entidad_id' => Entidad::where('codigoInstitucional', 'MTOP')->value('id'),
                'identificacion' => '1710000007',
                'nombres' => 'Diana',
                'apellidos' => 'Cevallos',
                'cargo' => 'Analista de Inversión Pública',
                'estado' => 'Activo',
                'name' => 'Diana Cevallos',
                'email' => 'diana.cevallos@mtop.gob.ec',
                'email_verified_at' => now(),
                'password' => Hash::make('Admin.123'),
                'remember_token' => null,
                'created_at' => now(),
                'updated_at' => now(),
            ],

            // 8. Auditor Institucional
            [
                'rol_id' => Rol::where('codigo', 'AUDITOR_INSTITUCIONAL')->value('id'),
                'entidad_id' => Entidad::where('codigoInstitucional', 'MTOP')->value('id'),
                'identificacion' => '1710000008',
                'nombres' => 'Pablo',
                'apellidos' => 'Sánchez',
                'cargo' => 'Auditor Institucional',
                'estado' => 'Activo',
                'name' => 'Pablo Sánchez',
                'email' => 'pablo.sanchez@mtop.gob.ec',
                'email_verified_at' => now(),
                'password' => Hash::make('Admin.123'),
                'remember_token' => null,
                'created_at' => now(),
                'updated_at' => now(),
            ],

            // 9. Consulta Institucional
            [
                'rol_id' => Rol::where('codigo', 'CONSULTA_INSTITUCIONAL')->value('id'),
                'entidad_id' => Entidad::where('codigoInstitucional', 'MTOP')->value('id'),
                'identificacion' => '1710000009',
                'nombres' => 'Verónica',
                'apellidos' => 'Castillo',
                'cargo' => 'Consulta Institucional',
                'estado' => 'Activo',
                'name' => 'Verónica Castillo',
                'email' => 'veronica.castillo@mtop.gob.ec',
                'email_verified_at' => now(),
                'password' => Hash::make('Admin.123'),
                'remember_token' => null,
                'created_at' => now(),
                'updated_at' => now(),
            ],

        ]);


        /*
        |--------------------------------------------------------------------------
        | MINISTERIO DE SALUD PÚBLICA
        | Usuarios para pruebas de aislamiento institucional
        |--------------------------------------------------------------------------
        */

        DB::table('users')->insert([

            // 10. Director de Planificación
            [
                'rol_id' => Rol::where('codigo', 'DIRECTOR_PLANIFICACION')->value('id'),
                'entidad_id' => Entidad::where('codigoInstitucional', 'MSP')->value('id'),
                'identificacion' => '1710000010',
                'nombres' => 'Fernando',
                'apellidos' => 'Torres',
                'cargo' => 'Director de Planificación',
                'estado' => 'Activo',
                'name' => 'Fernando Torres',
                'email' => 'fernando.torres@salud.gob.ec',
                'email_verified_at' => now(),
                'password' => Hash::make('Admin.123'),
                'remember_token' => null,
                'created_at' => now(),
                'updated_at' => now(),
            ],

            // 11. Analista de Planificación
            [
                'rol_id' => Rol::where('codigo', 'ANALISTA_PLANIFICACION')->value('id'),
                'entidad_id' => Entidad::where('codigoInstitucional', 'MSP')->value('id'),
                'identificacion' => '1710000011',
                'nombres' => 'Gabriela',
                'apellidos' => 'Vega',
                'cargo' => 'Analista de Planificación',
                'estado' => 'Activo',
                'name' => 'Gabriela Vega',
                'email' => 'gabriela.vega@salud.gob.ec',
                'email_verified_at' => now(),
                'password' => Hash::make('Admin.123'),
                'remember_token' => null,
                'created_at' => now(),
                'updated_at' => now(),
            ],

        ]);


        /*
        |--------------------------------------------------------------------------
        | MINISTERIO DE EDUCACIÓN
        | Usuarios para pruebas de aislamiento institucional
        |--------------------------------------------------------------------------
        */

        DB::table('users')->insert([

            // 12. Director de Planificación
            [
                'rol_id' => Rol::where('codigo', 'DIRECTOR_PLANIFICACION')->value('id'),
                'entidad_id' => Entidad::where('codigoInstitucional', 'MINEDUC')->value('id'),
                'identificacion' => '1710000012',
                'nombres' => 'Ricardo',
                'apellidos' => 'Salazar',
                'cargo' => 'Director de Planificación',
                'estado' => 'Activo',
                'name' => 'Ricardo Salazar',
                'email' => 'ricardo.salazar@educacion.gob.ec',
                'email_verified_at' => now(),
                'password' => Hash::make('Admin.123'),
                'remember_token' => null,
                'created_at' => now(),
                'updated_at' => now(),
            ],

            // 13. Analista de Planificación
            [
                'rol_id' => Rol::where('codigo', 'ANALISTA_PLANIFICACION')->value('id'),
                'entidad_id' => Entidad::where('codigoInstitucional', 'MINEDUC')->value('id'),
                'identificacion' => '1710000013',
                'nombres' => 'Daniela',
                'apellidos' => 'Ruiz',
                'cargo' => 'Analista de Planificación',
                'estado' => 'Activo',
                'name' => 'Daniela Ruiz',
                'email' => 'daniela.ruiz@educacion.gob.ec',
                'email_verified_at' => now(),
                'password' => Hash::make('Admin.123'),
                'remember_token' => null,
                'created_at' => now(),
                'updated_at' => now(),
            ],

        ]);
    }
}