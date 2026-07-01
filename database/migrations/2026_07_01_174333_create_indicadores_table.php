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

            $table->foreignId('meta_id')
                ->constrained('metas')
                ->cascadeOnDelete();

            $table->string('codigo', 30);

            $table->string('nombre', 255);

            $table->text('descripcion')->nullable();

            $table->string('formula')->nullable();

            $table->decimal('linea_base', 15, 2)->nullable();

            $table->decimal('meta', 15, 2)->nullable();

            $table->decimal('valor_actual', 15, 2)->nullable();

            $table->string('unidad_medida', 100)->nullable();

            $table->string('frecuencia', 50)->nullable();

            $table->enum('estado', [
                'Activo',
                'Inactivo'
            ])->default('Activo');

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