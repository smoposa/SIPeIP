<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('objetivos', function (Blueprint $table) {
            $table->foreignId('pnd_politica_id')
                ->nullable()
                ->after('pnd_id')
                ->constrained('pnd_politicas')
                ->restrictOnDelete();

            $table->foreignId('ods_meta_id')
                ->nullable()
                ->after('ods_id')
                ->constrained('ods_metas')
                ->restrictOnDelete();
        });
    }

    public function down(): void
    {
        Schema::table('objetivos', function (Blueprint $table) {
            $table->dropConstrainedForeignId('pnd_politica_id');
            $table->dropConstrainedForeignId('ods_meta_id');
        });
    }
};