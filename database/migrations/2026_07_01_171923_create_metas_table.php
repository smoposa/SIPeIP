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
        Schema::create('metas', function (Blueprint $table) {

            $table->id();

            // Objetivo Estratégico al que pertenece
            $table->foreignId('objetivo_id')
                ->constrained('objetivos')
                ->cascadeOnUpdate()
                ->restrictOnDelete();

            // Código de la meta
            $table->string('codigo', 30)
                ->unique();

            // Información general
            $table->string('nombre', 255);

            $table->text('descripcion')
                ->nullable();

            // Valores
            $table->decimal('linea_base', 10, 2);

            $table->decimal('valor_meta', 10, 2);

            $table->string('unidad_medida', 50);

            // Período
            $table->year('periodo_inicio');

            $table->year('periodo_fin');

            // Responsable de la meta
            $table->foreignId('responsable_id')
                ->constrained('users')
                ->cascadeOnUpdate()
                ->restrictOnDelete();

            // Estado
            $table->enum('estado', [
                'Activo',
                'Inactivo'
            ])->default('Activo');

            // Usuario que registró la información
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
        Schema::dropIfExists('metas');
    }
};