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
        Schema::create('pnd_objetivos', function (Blueprint $table) {
            $table->id();

            $table->foreignId('pnd_eje_id')
                ->constrained('pnd_ejes')
                ->restrictOnDelete();

            $table->unsignedTinyInteger('numero');

            $table->text('nombre');

            $table->text('descripcion')->nullable();

            $table->string('estado', 20)
                ->default('Activo');

            $table->timestamps();

            /*
             * Evita registrar dos veces el mismo
             * número de objetivo dentro de un eje.
             */
            $table->unique(
                ['pnd_eje_id', 'numero'],
                'pnd_objetivos_eje_numero_unique'
            );
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pnd_objetivos');
    }
};