<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('presupuestos', function (Blueprint $table) {
            $table->id();
            $table->foreignId('proyecto_id')->constrained('proyectos')->cascadeOnUpdate()->restrictOnDelete();
            $table->foreignId('entidad_id')->constrained('entidades')->cascadeOnUpdate()->restrictOnDelete();
            $table->unsignedSmallInteger('anio');
            $table->enum('periodo', [
                'Primer trimestre',
                'Segundo trimestre',
                'Tercer trimestre',
                'Cuarto trimestre',
            ]);
            $table->date('fecha_corte');
            $table->decimal('monto_programado', 15, 2);
            $table->decimal('presupuesto_vigente', 15, 2);
            $table->decimal('monto_ejecutado', 15, 2);
            $table->text('observaciones')->nullable();
            $table->enum('estado', ['Borrador', 'Cerrado'])->default('Borrador');
            $table->foreignId('created_by')->constrained('users')->restrictOnDelete();
            $table->foreignId('updated_by')->nullable()->constrained('users')->nullOnDelete();
            $table->timestamps();

            $table->unique(
                ['proyecto_id', 'anio', 'periodo'],
                'presupuestos_proyecto_periodo_unique'
            );
            $table->index(['entidad_id', 'anio', 'periodo']);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('presupuestos');
    }
};
