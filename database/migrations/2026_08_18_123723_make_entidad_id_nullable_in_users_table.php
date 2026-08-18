<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Permitir usuarios sin entidad para roles globales del sistema.
     */
    public function up(): void
    {
        Schema::table('users', function (Blueprint $table) {
            $table->unsignedBigInteger('entidad_id')
                ->nullable()
                ->change();
        });
    }

    /**
     * Revertir el cambio.
     */
    public function down(): void
    {
        Schema::table('users', function (Blueprint $table) {
            $table->unsignedBigInteger('entidad_id')
                ->nullable(false)
                ->change();
        });
    }
};