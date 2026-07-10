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
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('users')->delete();
        DB::statement('ALTER TABLE users AUTO_INCREMENT = 1;');

        // Aquí registraremos los usuarios.
        DB::table('users')->insert([

            [
                'rol_id' => Rol::where('nombre', 'Administrador del Sistema')->value('id'),
                'entidad_id' => Entidad::where('codigoInstitucional', 'SNP')->value('id'),
                'identificacion' => '1710000001',
                'nombres' => 'Carlos',
                'apellidos' => 'Andrade',
                'cargo' => 'Administrador del Sistema',
                'estado' => 'Activo',
                'name' => 'Carlos Andrade',
                'email' => 'carlos.andrade@planificacion.gob.ec',
                'email_verified_at' => now(),
                'password' => Hash::make('Admin.123'),
                'remember_token' => null,
                'created_at' => now(),
                'updated_at' => now(),
            ],

            [
                'rol_id' => Rol::where('nombre', 'Administrador Institucional')->value('id'),
                'entidad_id' => Entidad::where('codigoInstitucional', 'MSP')->value('id'),
                'identificacion' => '1710000002',
                'nombres' => 'María',
                'apellidos' => 'Fernández',
                'cargo' => 'Administradora Institucional',
                'estado' => 'Activo',
                'name' => 'María Fernández',
                'email' => 'maria.fernandez@salud.gob.ec',
                'email_verified_at' => now(),
                'password' => Hash::make('Admin.123'),
                'remember_token' => null,
                'created_at' => now(),
                'updated_at' => now(),
            ],

            [
                'rol_id' => Rol::where('nombre', 'Director de Planificación')->value('id'),
                'entidad_id' => Entidad::where('codigoInstitucional', 'MSP')->value('id'),
                'identificacion' => '1710000003',
                'nombres' => 'Jorge',
                'apellidos' => 'Herrera',
                'cargo' => 'Director de Planificación',
                'estado' => 'Activo',
                'name' => 'Jorge Herrera',
                'email' => 'jorge.herrera@salud.gob.ec',
                'email_verified_at' => now(),
                'password' => Hash::make('Admin.123'),
                'remember_token' => null,
                'created_at' => now(),
                'updated_at' => now(),
            ],

            [
                'rol_id' => Rol::where('nombre', 'Analista de Planificación')->value('id'),
                'entidad_id' => Entidad::where('codigoInstitucional', 'MSP')->value('id'),
                'identificacion' => '1710000004',
                'nombres' => 'Andrea',
                'apellidos' => 'Paredes',
                'cargo' => 'Analista de Planificación',
                'estado' => 'Activo',
                'name' => 'Andrea Paredes',
                'email' => 'andrea.paredes@salud.gob.ec',
                'email_verified_at' => now(),
                'password' => Hash::make('Admin.123'),
                'remember_token' => null,
                'created_at' => now(),
                'updated_at' => now(),
            ],

            [
                'rol_id' => Rol::where('nombre', 'Director de Inversión Pública')->value('id'),
                'entidad_id' => Entidad::where('codigoInstitucional', 'MSP')->value('id'),
                'identificacion' => '1710000005',
                'nombres' => 'Luis',
                'apellidos' => 'Morales',
                'cargo' => 'Director de Inversión Pública',
                'estado' => 'Activo',
                'name' => 'Luis Morales',
                'email' => 'luis.morales@salud.gob.ec',
                'email_verified_at' => now(),
                'password' => Hash::make('Admin.123'),
                'remember_token' => null,
                'created_at' => now(),
                'updated_at' => now(),
            ],

            [
                'rol_id' => Rol::where('nombre', 'Analista de Inversión Pública')->value('id'),
                'entidad_id' => Entidad::where('codigoInstitucional', 'MSP')->value('id'),
                'identificacion' => '1710000006',
                'nombres' => 'Diana',
                'apellidos' => 'Cevallos',
                'cargo' => 'Analista de Inversión Pública',
                'estado' => 'Activo',
                'name' => 'Diana Cevallos',
                'email' => 'diana.cevallos@salud.gob.ec',
                'email_verified_at' => now(),
                'password' => Hash::make('Admin.123'),
                'remember_token' => null,
                'created_at' => now(),
                'updated_at' => now(),
            ],

            [
                'rol_id' => Rol::where('nombre', 'Auditor Institucional')->value('id'),
                'entidad_id' => Entidad::where('codigoInstitucional', 'MSP')->value('id'),
                'identificacion' => '1710000007',
                'nombres' => 'Pablo',
                'apellidos' => 'Sánchez',
                'cargo' => 'Auditor Institucional',
                'estado' => 'Activo',
                'name' => 'Pablo Sánchez',
                'email' => 'pablo.sanchez@salud.gob.ec',
                'email_verified_at' => now(),
                'password' => Hash::make('Admin.123'),
                'remember_token' => null,
                'created_at' => now(),
                'updated_at' => now(),
            ],

            [
                'rol_id' => Rol::where('nombre', 'Consulta Institucional')->value('id'),
                'entidad_id' => Entidad::where('codigoInstitucional', 'MSP')->value('id'),
                'identificacion' => '1710000008',
                'nombres' => 'Verónica',
                'apellidos' => 'Castillo',
                'cargo' => 'Consulta Institucional',
                'estado' => 'Activo',
                'name' => 'Verónica Castillo',
                'email' => 'veronica.castillo@salud.gob.ec',
                'email_verified_at' => now(),
                'password' => Hash::make('Admin.123'),
                'remember_token' => null,
                'created_at' => now(),
                'updated_at' => now(),
            ],

        ]);
    }
}