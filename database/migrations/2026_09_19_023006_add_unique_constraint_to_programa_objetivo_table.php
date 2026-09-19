<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Evitar la asignación duplicada de objetivos.
     */
    public function up(): void
    {
        $existenDuplicados = DB::table('programa_objetivo')
            ->select(
                'programa_id',
                'objetivo_id'
            )
            ->groupBy(
                'programa_id',
                'objetivo_id'
            )
            ->havingRaw('COUNT(*) > 1')
            ->exists();

        if ($existenDuplicados) {
            throw new \RuntimeException(
                'Existen objetivos duplicados en uno o más programas. '
                . 'Corrija los registros antes de aplicar la restricción.'
            );
        }

        Schema::table('programa_objetivo', function (Blueprint $table) {
            $table->unique(
                ['programa_id', 'objetivo_id'],
                'programa_objetivo_unique'
            );
        });
    }

    /**
     * Revertir los cambios.
     */
    public function down(): void
    {
        Schema::table('programa_objetivo', function (Blueprint $table) {
            $table->dropUnique(
                'programa_objetivo_unique'
            );
        });
    }
};