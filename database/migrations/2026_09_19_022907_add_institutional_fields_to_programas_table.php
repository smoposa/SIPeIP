<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Incorporar aislamiento institucional
     * y estado del proceso.
     */
    public function up(): void
    {
        /*
        |--------------------------------------------------------------------------
        | Agregar las nuevas columnas
        |--------------------------------------------------------------------------
        */

        Schema::table('programas', function (Blueprint $table) {
            $table->foreignId('entidad_id')
                ->nullable()
                ->after('id')
                ->constrained('entidades')
                ->restrictOnDelete();

            $table->string('estado_proceso', 30)
                ->default('Borrador')
                ->after('estado');
        });

        /*
        |--------------------------------------------------------------------------
        | Asignar entidad a registros existentes
        |--------------------------------------------------------------------------
        |
        | Se procesa cada programa mediante Query Builder para mantener
        | compatibilidad con MySQL y SQLite.
        |
        */

        DB::table('programas')
            ->whereNull('entidad_id')
            ->orderBy('id')
            ->chunkById(
                100,
                function ($programas): void {
                    foreach ($programas as $programa) {
                        $entidadId = DB::table('users')
                            ->where(
                                'id',
                                $programa->usuario_id
                            )
                            ->value('entidad_id');

                        if ($entidadId) {
                            DB::table('programas')
                                ->where(
                                    'id',
                                    $programa->id
                                )
                                ->update([
                                    'entidad_id' => $entidadId,
                                ]);
                        }
                    }
                }
            );

        /*
        |--------------------------------------------------------------------------
        | Comprobar que ningún programa quede sin entidad
        |--------------------------------------------------------------------------
        */

        $existenProgramasSinEntidad = DB::table('programas')
            ->whereNull('entidad_id')
            ->exists();

        if ($existenProgramasSinEntidad) {
            throw new \RuntimeException(
                'No se pudo asignar una entidad a todos los programas. '
                . 'Revise que los usuarios creadores tengan una entidad.'
            );
        }

        /*
        |--------------------------------------------------------------------------
        | Convertir entidad_id en obligatorio
        |--------------------------------------------------------------------------
        */

        Schema::table('programas', function (Blueprint $table) {
            $table->unsignedBigInteger('entidad_id')
                ->nullable(false)
                ->change();
        });

        /*
        |--------------------------------------------------------------------------
        | Configurar el código como único dentro de cada entidad
        |--------------------------------------------------------------------------
        */

        Schema::table('programas', function (Blueprint $table) {
            $table->dropUnique(
                'programas_codigo_unique'
            );

            $table->unique(
                ['entidad_id', 'codigo'],
                'programas_entidad_codigo_unique'
            );
        });
    }

    /**
     * Revertir los cambios.
     */
    public function down(): void
    {
        Schema::table('programas', function (Blueprint $table) {
            $table->dropUnique(
                'programas_entidad_codigo_unique'
            );

            $table->unique(
                'codigo',
                'programas_codigo_unique'
            );

            $table->dropColumn(
                'estado_proceso'
            );

            $table->dropConstrainedForeignId(
                'entidad_id'
            );
        });
    }
};