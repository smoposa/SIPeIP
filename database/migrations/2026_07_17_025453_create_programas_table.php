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
        Schema::create('programas', function (Blueprint $table) {

            $table->id();

            $table->string('codigo', 30)
                ->unique();

            $table->string('nombre', 255);

            $table->text('descripcion')
                ->nullable();

            $table->year('periodo_inicio');

            $table->year('periodo_fin');

            $table->foreignId('responsable_id')
                ->constrained('users');

            $table->enum('estado', [
                'Activo',
                'Inactivo'
            ])->default('Activo');

            $table->foreignId('usuario_id')
                ->constrained('users');

            $table->timestamps();

        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('programas');
    }
};