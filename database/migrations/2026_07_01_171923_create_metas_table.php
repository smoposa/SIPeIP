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
        Schema::create('metas', function (Blueprint $table) {

            $table->id();

            $table->foreignId('objetivo_id')
                ->constrained('objetivos')
                ->cascadeOnDelete();

            $table->string('codigo', 30);

            $table->string('nombre', 255);

            $table->text('descripcion')->nullable();

            $table->decimal('valor_meta', 15, 2)->nullable();

            $table->string('unidad_medida', 100)->nullable();

            $table->date('fecha_inicio')->nullable();

            $table->date('fecha_fin')->nullable();

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
        Schema::dropIfExists('metas');
    }
};