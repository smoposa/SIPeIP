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
        Schema::create('pnd_ejes', function (Blueprint $table) {
            $table->id();

            $table->foreignId('pnd_id')
                ->constrained('pnd')
                ->restrictOnDelete();

            $table->unsignedTinyInteger('numero');

            $table->string('nombre', 255);

            $table->text('descripcion')->nullable();

            $table->string('estado', 20)
                ->default('Activo');

            $table->timestamps();

            /*
             * Evita registrar dos veces el mismo
             * número de eje dentro de un PND.
             */
            $table->unique(
                ['pnd_id', 'numero'],
                'pnd_ejes_pnd_numero_unique'
            );
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pnd_ejes');
    }
};