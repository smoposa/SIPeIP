<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('avances', function (Blueprint $table) {
            $table->id();
            $table->foreignId('proyecto_id')->constrained('proyectos')->cascadeOnUpdate()->restrictOnDelete();
            $table->foreignId('entidad_id')->constrained('entidades')->cascadeOnUpdate()->restrictOnDelete();
            $table->foreignId('indicador_id')->constrained('indicadores')->cascadeOnUpdate()->restrictOnDelete();
            $table->unsignedSmallInteger('anio');
            $table->enum('periodo', [
                'Primer trimestre',
                'Segundo trimestre',
                'Tercer trimestre',
                'Cuarto trimestre',
            ]);
            $table->date('fecha_corte');
            $table->decimal('valor_programado', 18, 4);
            $table->decimal('valor_ejecutado', 18, 4);
            $table->text('resultado')->nullable();
            $table->text('observaciones')->nullable();
            $table->enum('estado', ['Borrador', 'Cerrado'])->default('Borrador');
            $table->foreignId('created_by')->constrained('users')->restrictOnDelete();
            $table->foreignId('updated_by')->nullable()->constrained('users')->nullOnDelete();
            $table->timestamps();

            $table->unique(
                ['proyecto_id', 'indicador_id', 'anio', 'periodo'],
                'avances_proyecto_indicador_periodo_unique'
            );
            $table->index(['entidad_id', 'anio', 'periodo']);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('avances');
    }
};
