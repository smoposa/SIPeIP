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
            'nombre' => 'Agenda 2030',
            'periodo_inicio' => 2015,
            'periodo_fin' => 2030,
            'descripcion' => 'Agenda 2030 para el Desarrollo Sostenible.',
            'estado' => 'Activo',
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        Schema::table('ods', function (Blueprint $table) {
            $table->foreignId('agenda_id')
                ->nullable()
                ->constrained('ods_agendas')
                ->restrictOnDelete();
        });

        // Conservar los identificadores y las alineaciones existentes.
        DB::table('ods')->update([
            'agenda_id' => $agendaId,
        ]);

        Schema::table('ods', function (Blueprint $table) {
            $table->unsignedBigInteger('agenda_id')
                ->nullable(false)
                ->change();

            $table->dropUnique('ods_codigo_unique');

            $table->unique(
                ['agenda_id', 'codigo'],
                'ods_agenda_codigo_unique'
            );
        });
    }

    public function down(): void
    {
        $hayVariasAgendas = DB::table('ods_agendas')->count() > 1;

        $hayCodigosRepetidos = DB::table('ods')
            ->select('codigo')
            ->groupBy('codigo')
            ->havingRaw('COUNT(*) > 1')
            ->exists();

        if ($hayVariasAgendas || $hayCodigosRepetidos) {
            throw new RuntimeException(
                'La reversión requiere consolidar las agendas y códigos manualmente; no se elimina el historial.'
            );
        }

        // Recuperar primero la unicidad global del código.
        Schema::table('ods', function (Blueprint $table) {
            $table->unique('codigo', 'ods_codigo_unique');
        });

        // Retirar la clave foránea antes del índice que utiliza MySQL.
        Schema::table('ods', function (Blueprint $table) {
            $table->dropForeign(['agenda_id']);
        });

        Schema::table('ods', function (Blueprint $table) {
            $table->dropUnique('ods_agenda_codigo_unique');
        });

        Schema::table('ods', function (Blueprint $table) {
            $table->dropColumn('agenda_id');
        });

        Schema::dropIfExists('ods_agendas');
    }
};