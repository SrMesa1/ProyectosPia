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
        Schema::create('tipo_proyecto', function (Blueprint $table) {
            $table->id('id_tipo_proyecto');
            $table->string('nombre', 50)->unique();
            $table->string('descripcion');
            $table->integer('duracion_minima')->comment('Duración mínima en semanas');
            $table->integer('duracion_maxima')->comment('Duración máxima en semanas');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tipo_proyecto');
    }
};
