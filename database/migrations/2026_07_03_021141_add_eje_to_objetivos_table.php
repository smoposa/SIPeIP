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

            $table->string('eje', 100)
                  ->nullable()
                  ->after('tipo');

        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('objetivos', function (Blueprint $table) {

            $table->dropColumn('eje');

        });
    }
};