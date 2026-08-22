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
        Schema::table('pnd_ejes', function (Blueprint $table) {
            $table->dropColumn('estado');
        });

        Schema::table('pnd_objetivos', function (Blueprint $table) {
            $table->dropColumn('estado');
        });

        Schema::table('pnd_politicas', function (Blueprint $table) {
            $table->dropColumn('estado');
        });

        Schema::table('pnd_estrategias', function (Blueprint $table) {
            $table->dropColumn('estado');
        });

        Schema::table('pnd_metas', function (Blueprint $table) {
            $table->dropColumn('estado');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('pnd_ejes', function (Blueprint $table) {
            $table->string('estado', 20)->default('Activo');
        });

        Schema::table('pnd_objetivos', function (Blueprint $table) {
            $table->string('estado', 20)->default('Activo');
        });

        Schema::table('pnd_politicas', function (Blueprint $table) {
            $table->string('estado', 20)->default('Activo');
        });

        Schema::table('pnd_estrategias', function (Blueprint $table) {
            $table->string('estado', 20)->default('Activo');
        });

        Schema::table('pnd_metas', function (Blueprint $table) {
            $table->string('estado', 20)->default('Activo');
        });
    }
};