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

            $table->string('codigo', 50)->unique();

            $table->string('nombre', 200);

            $table->string('tipo', 50);

            $table->date('fecha_inicio');

            $table->date('fecha_fin');

            $table->text('descripcion')->nullable();

            $table->enum('estado', ['Activo', 'Inactivo'])
                  ->default('Activo');

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