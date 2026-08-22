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
        Schema::create('pnd_politicas', function (Blueprint $table) {
            $table->id();

            $table->foreignId('pnd_objetivo_id')
                ->constrained('pnd_objetivos')
                ->restrictOnDelete();

            $table->string('codigo', 20);

            $table->text('nombre');

            $table->string('estado', 20)
                ->default('Activo');

            $table->timestamps();

            /*
             * El código de cada política
             * debe ser único.
             */
            $table->unique(
                'codigo',
                'pnd_politicas_codigo_unique'
            );
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pnd_politicas');
    }
};