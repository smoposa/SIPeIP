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
        Schema::create('indicadores', function (Blueprint $table) {

            $table->id();

            /*
            |--------------------------------------------------------------------------
            | Relación
            |--------------------------------------------------------------------------
            */

            // Meta a la que pertenece
            $table->foreignId('meta_id')
                ->constrained('metas')
                ->cascadeOnDelete();

            /*
            |--------------------------------------------------------------------------
            | Información general
            |--------------------------------------------------------------------------
            */

            // Código
            $table->string('codigo', 30)
                ->unique();

            // Nombre
            $table->string('nombre', 255);

            // Tipo
            $table->string('tipo', 50);

            // Fórmula
            $table->text('formula');

            // Unidad de medida
            $table->string('unidad_medida', 50);

            // Frecuencia
            $table->string('frecuencia', 50);

            /*
            |--------------------------------------------------------------------------
            | Responsable
            |--------------------------------------------------------------------------
            */

            $table->foreignId('responsable_id')
                ->constrained('users')
                ->restrictOnDelete();

            /*
            |--------------------------------------------------------------------------
            | Estado
            |--------------------------------------------------------------------------
            */

            $table->enum('estado', [
                'Activo',
                'Inactivo'
            ])->default('Activo');

            /*
            |--------------------------------------------------------------------------
            | Auditoría
            |--------------------------------------------------------------------------
            */

            $table->foreignId('usuario_id')
                ->constrained('users')
                ->restrictOnDelete();

            $table->timestamps();

        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('indicadores');
    }
};