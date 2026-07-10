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
        Schema::create('objetivos', function (Blueprint $table) {

            $table->id();

            // Plan al que pertenece el objetivo
            $table->foreignId('plan_id')
                ->constrained('planes')
                ->cascadeOnUpdate()
                ->restrictOnDelete();

            // Objetivo del Plan Nacional de Desarrollo
            $table->foreignId('pnd_id')
                ->constrained('pnd')
                ->cascadeOnUpdate()
                ->restrictOnDelete();

            // Objetivo de Desarrollo Sostenible
            $table->foreignId('ods_id')
                ->constrained('ods')
                ->cascadeOnUpdate()
                ->restrictOnDelete();

            // Información del objetivo
            $table->string('codigo', 30)
                ->unique();

            $table->string('nombre', 255);

            $table->text('descripcion')
                ->nullable();

            // Estado
            $table->enum('estado', ['Activo', 'Inactivo'])
                ->default('Activo');

            // Usuario que registró el objetivo
            $table->foreignId('usuario_id')
                ->constrained('users')
                ->cascadeOnUpdate()
                ->restrictOnDelete();

            $table->timestamps();

        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('objetivos');
    }
};