<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::table('users', function (Blueprint $table) {

            $table->foreignId('rol_id')
                  ->after('id');

            $table->foreignId('entidad_id')
                  ->after('rol_id');

            $table->string('identificacion', 20)
                  ->unique()
                  ->after('entidad_id');

            $table->string('nombres', 100)
                  ->after('identificacion');

            $table->string('apellidos', 100)
                  ->after('nombres');

            $table->string('cargo', 150)
                  ->after('apellidos');

            $table->string('estado', 20)
                  ->default('Activo')
                  ->after('cargo');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('users', function (Blueprint $table) {

            $table->dropColumn([
                'rol_id',
                'entidad_id',
                'identificacion',
                'nombres',
                'apellidos',
                'cargo',
                'estado'
            ]);

        });
    }
};