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
        Schema::create('pnd_metas', function (Blueprint $table) {
            $table->id();

            $table->foreignId('pnd_objetivo_id')
                ->constrained('pnd_objetivos')
                ->restrictOnDelete();

            $table->unsignedSmallInteger('numero');

            $table->text('descripcion');

            $table->string('estado', 20)
                ->default('Activo');

            $table->timestamps();

            /*
             * Evita registrar dos veces el mismo
             * número de meta dentro de un objetivo.
             */
            $table->unique(
                ['pnd_objetivo_id', 'numero'],
                'pnd_metas_objetivo_numero_unique'
            );
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pnd_metas');
    }
};