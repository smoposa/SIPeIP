<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Crear la tabla de subsectores.
     */
    public function up(): void
    {
        Schema::create('subsectores', function (Blueprint $table) {
            $table->id();

            $table->foreignId('sector_id')
                ->constrained('sectores')
                ->restrictOnDelete();

            $table->string('codigo', 10)
                ->unique();

            $table->string('nombre', 255);

            $table->string('nivel_gobierno', 50)
                ->default('Nacional');

            $table->string('estado', 20)
                ->default('Activo')
                ->index();

            $table->timestamps();

            /*
             * No se puede repetir el mismo subsector
             * dentro de un sector.
             */
            $table->unique([
                'sector_id',
                'nombre',
            ]);
        });
    }

    /**
     * Eliminar la tabla de subsectores.
     */
    public function down(): void
    {
        Schema::dropIfExists('subsectores');
    }
};