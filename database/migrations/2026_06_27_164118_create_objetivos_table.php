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
            $table->enum('tipo', ['ODS', 'PND', 'OEI']);

            // Relación jerárquica
            $table->foreignId('objetivo_padre_id')
                ->nullable()
                ->constrained('objetivos')
                ->nullOnDelete();

            // Información del objetivo
            $table->string('codigo', 20)->unique();
            $table->string('nombre', 255);
            $table->text('descripcion')->nullable();

            // Estado
            $table->enum('estado', ['Activo', 'Inactivo'])
                ->default('Activo');

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
