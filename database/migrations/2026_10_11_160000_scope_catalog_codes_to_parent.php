<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        // Diferentes planes pueden reutilizar la numeración oficial de sus políticas.
        Schema::table('pnd_politicas', function (Blueprint $table) {
            $table->dropUnique('pnd_politicas_codigo_unique');
            $table->unique(['pnd_objetivo_id', 'codigo'], 'pnd_politicas_objetivo_codigo_unique');
        });
        Schema::table('pnd_estrategias', function (Blueprint $table) {
            $table->dropUnique('pnd_estrategias_codigo_unique');
            $table->unique(['pnd_politica_id', 'codigo'], 'pnd_estrategias_politica_codigo_unique');
        });
        Schema::table('ods_metas', function (Blueprint $table) {
            $table->unique(['ods_id', 'codigo'], 'ods_metas_ods_codigo_unique');
        });
    }

    public function down(): void
    {
        // El rollback al esquema anterior requiere códigos globalmente únicos.
        Schema::table('ods_metas', function (Blueprint $table) {
            $table->dropUnique('ods_metas_ods_codigo_unique');
        });
        Schema::table('pnd_estrategias', function (Blueprint $table) {
            $table->dropUnique('pnd_estrategias_politica_codigo_unique');
            $table->unique('codigo', 'pnd_estrategias_codigo_unique');
        });
        Schema::table('pnd_politicas', function (Blueprint $table) {
            $table->dropUnique('pnd_politicas_objetivo_codigo_unique');
            $table->unique('codigo', 'pnd_politicas_codigo_unique');
        });
    }
};
