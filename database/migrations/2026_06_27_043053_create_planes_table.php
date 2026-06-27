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
        Schema::create('planes', function (Blueprint $table) {

            $table->id();

            // Información general
            $table->string('codigo', 20)->unique();
            $table->string('nombre', 255);
            $table->text('descripcion')->nullable();

            // Período de planificación
            $table->integer('periodo_inicio');
            $table->integer('periodo_fin');

            // Vigencia
            $table->date('fecha_inicio');
            $table->date('fecha_fin');

            // Estado
            $table->string('estado', 20)->default('Activo');

            // Entidad propietaria del plan
            $table->foreignId('entidad_id')
                  ->constrained('entidades')
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
        Schema::dropIfExists('planes');
    }
};