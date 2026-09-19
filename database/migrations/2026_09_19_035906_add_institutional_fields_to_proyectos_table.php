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
        Schema::table('proyectos', function (Blueprint $table) {
            $table->foreignId('entidad_id')
                ->after('programa_id')
                ->constrained('entidades')
                ->cascadeOnUpdate()
                ->restrictOnDelete();

            $table->foreignId('subsector_id')
                ->after('entidad_id')
                ->constrained('subsectores')
                ->cascadeOnUpdate()
                ->restrictOnDelete();

            $table->enum('estado_administrativo', [
                'Activo',
                'Inactivo',
            ])
                ->default('Activo')
                ->after('estado');

            $table->enum('estado_proceso', [
                'Borrador',
                'En revisión',
                'Observado',
                'Priorizado',
                'Negado',
            ])
                ->default('Borrador')
                ->after('estado_administrativo');

            $table->dropUnique('proyectos_codigo_unique');

            $table->unique(
                ['entidad_id', 'codigo'],
                'proyectos_entidad_codigo_unique'
            );
        });
    }

    /**
     * Revertir la migración.
     */
    public function down(): void
    {
        Schema::table('proyectos', function (Blueprint $table) {
            $table->dropUnique(
                'proyectos_entidad_codigo_unique'
            );

            $table->unique(
                'codigo',
                'proyectos_codigo_unique'
            );

            $table->dropForeign(
                ['subsector_id']
            );

            $table->dropForeign(
                ['entidad_id']
            );

            $table->dropColumn([
                'subsector_id',
                'entidad_id',
                'estado_administrativo',
                'estado_proceso',
            ]);
        });
    }
};