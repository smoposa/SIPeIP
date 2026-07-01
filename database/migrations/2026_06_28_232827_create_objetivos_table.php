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

            // Tipo de objetivo
            $table->enum('tipo', [
                'ODS',
                'PND',
                'OEI'
            ]);

            // Relaciones
            $table->foreignId('entidad_id')
                  ->nullable()
                  ->constrained('entidades')
                  ->nullOnDelete();

            $table->foreignId('plan_id')
                  ->nullable()
                  ->constrained('planes')
                  ->nullOnDelete();

            // Información general
            $table->string('codigo', 30)->unique();

            $table->string('nombre',255);

            $table->text('descripcion')->nullable();

            // Responsable institucional
            $table->string('responsable')->nullable();

            // Vigencia
            $table->date('fecha_inicio')->nullable();

            $table->date('fecha_fin')->nullable();

            // Estado
            $table->enum('estado', [
                'Activo',
                'Inactivo'
            ])->default('Activo');

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