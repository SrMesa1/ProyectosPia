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
        Schema::create('asignatura', function (Blueprint $table) {
            $table->id('id_asignatura');
            $table->string('nombre', 100);
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
        Schema::dropIfExists('asignatura');
    }
};
