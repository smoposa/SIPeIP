<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Ejecutar la migración.
     */
    public function up(): void
    {
        Schema::table('planes', function (Blueprint $table) {

            $table->enum('estado_proceso', [
                'Borrador',
                'En revisión',
                'Observado',
                'Aprobado'
            ])
            ->default('Borrador')
            ->after('estado');

            $table->unsignedInteger('version')
                ->default(1)
                ->after('estado_proceso');
        });
    }

    /**
     * Revertir la migración.
     */
    public function down(): void
    {
        Schema::table('planes', function (Blueprint $table) {
            $table->dropColumn([
                'estado_proceso',
                'version'
            ]);
        });
    }
};