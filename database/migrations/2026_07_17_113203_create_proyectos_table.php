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
        Schema::create('proyectos', function (Blueprint $table) {

            $table->id();

            // Programa al que pertenece
            $table->foreignId('programa_id')
                ->constrained('programas')
                ->cascadeOnDelete();

            // Código automático
            $table->string('codigo', 30)
                ->unique();

            // Información general
            $table->string('nombre', 255);

            $table->text('descripcion')
                ->nullable();

            $table->date('fecha_inicio');

            $table->date('fecha_fin');

            // Presupuesto
            $table->decimal('presupuesto_aprobado', 15, 2);

            // Responsable
            $table->foreignId('responsable_id')
                ->constrained('users')
                ->restrictOnDelete();

            // Estado
            $table->enum('estado', [
                'Planificado',
                'En ejecución',
                'Finalizado',
                'Suspendido'
            ])->default('Planificado');

            // Usuario que registra
            $table->foreignId('usuario_id')
                ->constrained('users')
                ->cascadeOnDelete();

            $table->timestamps();

        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('proyectos');
    }
};