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
        Schema::create('proyecto', function (Blueprint $table) {
            $table->id('id_proyecto');
            $table->string('titulo');
            $table->text('descripcion');
            $table->enum('tipo', ['PIA', 'PA']);
            $table->enum('estado', ['pendiente', 'en_revision', 'aprobado', 'rechazado'])->default('pendiente');
            $table->foreignId('id_estudiante')->constrained('estudiante', 'id_estudiante')->onDelete('cascade');
            $table->foreignId('id_asignatura')->constrained('asignatura', 'id_asignatura')->onDelete('cascade');
            $table->string('grupo');
            $table->timestamps();

            // Un estudiante solo puede tener un proyecto por asignatura y grupo
            $table->unique(['id_estudiante', 'id_asignatura', 'grupo']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('proyecto');
    }
}; 