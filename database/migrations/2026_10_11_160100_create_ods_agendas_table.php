<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('ods_agendas', function (Blueprint $table) {
            $table->id();
            $table->string('nombre', 150);
            $table->unsignedSmallInteger('periodo_inicio');
            $table->unsignedSmallInteger('periodo_fin');
            $table->text('descripcion')->nullable();
            $table->string('estado', 20)->default('Activo');
            $table->timestamps();
        });
        $agendaId = DB::table('ods_agendas')->insertGetId([
            'nombre' => 'Agenda 2030', 'periodo_inicio' => 2015, 'periodo_fin' => 2030,
            'descripcion' => 'Agenda 2030 para el Desarrollo Sostenible.',
            'estado' => 'Activo', 'created_at' => now(), 'updated_at' => now(),
        ]);
        Schema::table('ods', function (Blueprint $table) {
            $table->foreignId('agenda_id')->nullable()->constrained('ods_agendas')->restrictOnDelete();
        });
        // Se conservan los IDs de objetivos/metas y todas las alineaciones existentes.
        DB::table('ods')->update(['agenda_id' => $agendaId]);
        Schema::table('ods', function (Blueprint $table) {
            $table->unsignedBigInteger('agenda_id')->nullable(false)->change();
            $table->dropUnique('ods_codigo_unique');
            $table->unique(['agenda_id', 'codigo'], 'ods_agenda_codigo_unique');
        });
    }

    public function down(): void
    {
        // No se revierte si implicaría perder agendas o sus asociaciones históricas.
        if (DB::table('ods_agendas')->count() > 1 || DB::table('ods')->select('codigo')->groupBy('codigo')->havingRaw('COUNT(*) > 1')->exists()) {
            throw new RuntimeException('La reversión requiere consolidar las agendas y códigos manualmente; no se elimina el historial.');
        }
        Schema::table('ods', function (Blueprint $table) {
            $table->dropUnique('ods_agenda_codigo_unique');
            $table->unique('codigo', 'ods_codigo_unique');
            $table->dropConstrainedForeignId('agenda_id');
        });
        Schema::dropIfExists('ods_agendas');
    }
};
