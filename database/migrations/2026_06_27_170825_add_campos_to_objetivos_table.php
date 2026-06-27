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
        Schema::table('objetivos', function (Blueprint $table) {

            $table->string('color', 20)->nullable()->after('descripcion');

            $table->string('icono', 100)->nullable()->after('color');

            $table->unsignedSmallInteger('numero_metas')
                  ->default(0)
                  ->after('icono');

            $table->string('documento')
                  ->nullable()
                  ->after('numero_metas');

        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('objetivos', function (Blueprint $table) {

            $table->dropColumn([
                'color',
                'icono',
                'numero_metas',
                'documento'
            ]);

        });
    }
};