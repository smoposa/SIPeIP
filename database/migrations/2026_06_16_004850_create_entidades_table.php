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
            Schema::create('entidades', function (Blueprint $table) {

                $table->id();

                $table->string('codigoInstitucional', 50)->unique();
                $table->string('ruc', 13)->unique();

                $table->string('nombre', 255);

                $table->string('tipoEntidad', 100);
                $table->string('nivelGobierno', 100);

                $table->string('provincia', 100);
                $table->string('canton', 100);

                $table->string('parroquia', 100)->nullable();

                $table->string('direccion', 255);

                $table->string('telefono', 20)->nullable();

                $table->string('estado', 20)->default('Activo');

                $table->timestamps();
            });
        }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('entidades');
    }
};
