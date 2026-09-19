<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Crear la tabla de macrosectores.
     */
    public function up(): void
    {
        Schema::create('macrosectores', function (Blueprint $table) {
            $table->id();

            $table->string('nombre', 150)
                ->unique();

            $table->string('estado', 20)
                ->default('Activo')
                ->index();

            $table->timestamps();
        });
    }

    /**
     * Eliminar la tabla de macrosectores.
     */
    public function down(): void
    {
        Schema::dropIfExists('macrosectores');
    }
};