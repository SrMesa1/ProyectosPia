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
        Schema::create('proyecto_estudiante', function (Blueprint $table) {
            $table->unsignedBigInteger('id_proyecto');
            $table->unsignedBigInteger('id_estudiante');
            $table->timestamps();

            $table->primary(['id_proyecto', 'id_estudiante']);

            $table->foreign('id_proyecto')->references('id_proyecto')->on('proyecto')->onDelete('cascade');
            $table->foreign('id_estudiante')->references('id_estudiante')->on('estudiante')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('proyecto_estudiante');
    }
};
