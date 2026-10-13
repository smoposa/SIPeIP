<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        foreach (['pnd_ejes', 'pnd_objetivos', 'pnd_politicas', 'pnd_estrategias', 'pnd_metas'] as $tabla) {
            Schema::table($tabla, fn (Blueprint $table) => $table->string('estado', 20)->default('Activo'));
        }
    }

    public function down(): void
    {
        foreach (['pnd_ejes', 'pnd_objetivos', 'pnd_politicas', 'pnd_estrategias', 'pnd_metas'] as $tabla) {
            Schema::table($tabla, fn (Blueprint $table) => $table->dropColumn('estado'));
        }
    }
};
