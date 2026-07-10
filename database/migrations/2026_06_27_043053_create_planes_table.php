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
        Schema::create('planes', function (Blueprint $table) {

            $table->id();

            $table->string('codigo', 30)->unique();

            $table->string('nombre', 255);

            $table->foreignId('entidad_id')
                  ->constrained('entidades')
                  ->cascadeOnUpdate()
                  ->restrictOnDelete();

            $table->string('tipo', 100);

            $table->year('periodo_inicio');

            $table->year('periodo_fin');

            $table->text('descripcion')->nullable();

            $table->enum('estado', [
                'Activo',
                'Inactivo'
            ])->default('Activo');

            $table->foreignId('usuario_id')
                  ->constrained('users')
                  ->cascadeOnUpdate()
                  ->restrictOnDelete();

            $table->timestamps();

        });
    }

    /**
     * Revertir la migración.
     */
    public function down(): void
    {
        Schema::dropIfExists('planes');
    }
};