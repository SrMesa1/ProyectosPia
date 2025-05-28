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
        Schema::create('proyecto_asignatura', function (Blueprint $table) {
            $table->unsignedBigInteger('id_proyecto');
            $table->unsignedBigInteger('id_asignatura');
            $table->string('grupo', 20)->nullable();
            $table->unsignedBigInteger('id_docente');
            $table->timestamps();

            $table->primary(['id_proyecto', 'id_asignatura']);

            $table->foreign('id_proyecto')->references('id_proyecto')->on('proyecto')->onDelete('cascade');
            $table->foreign('id_asignatura')->references('id_asignatura')->on('asignatura')->onDelete('cascade');
            $table->foreign('id_docente')->references('id_docente')->on('docente')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('proyecto_asignatura');
    }
};
