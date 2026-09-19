<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Crear la tabla de sectores.
     */
    public function up(): void
    {
        Schema::create('sectores', function (Blueprint $table) {
            $table->id();

            $table->foreignId('macrosector_id')
                ->constrained('macrosectores')
                ->restrictOnDelete();

            $table->string('nombre', 150);

            $table->string('estado', 20)
                ->default('Activo')
                ->index();

            $table->timestamps();

            /*
             * No se puede repetir el mismo sector
             * dentro de un macrosector.
             */
            $table->unique([
                'macrosector_id',
                'nombre',
            ]);
        });
    }

    /**
     * Eliminar la tabla de sectores.
     */
    public function down(): void
    {
        Schema::dropIfExists('sectores');
    }
};