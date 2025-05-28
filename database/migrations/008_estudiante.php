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
        Schema::create('estudiante', function (Blueprint $table) {
            $table->id('id_estudiante');
            $table->string('nombre', 100);
            $table->string('correo', 100)->unique();
            $table->string('documento', 20)->unique();
            $table->unsignedBigInteger('id_programa');
            $table->timestamps();

            $table->foreign('id_programa')->references('id_programa')->on('programa')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('estudiante');
    }
};
