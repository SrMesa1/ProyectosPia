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
        // Agregar campos de fecha a proyecto
        Schema::table('proyecto', function (Blueprint $table) {
            if (!Schema::hasColumn('proyecto', 'fecha_inicio')) {
                $table->date('fecha_inicio')->after('descripcion');
                $table->date('fecha_fin')->after('fecha_inicio');
            }
        });

        // Crear tabla pivot proyecto_asignatura
        Schema::create('proyecto_asignatura', function (Blueprint $table) {
            $table->foreignId('id_proyecto')->constrained('proyecto', 'id_proyecto')->onDelete('cascade');
            $table->foreignId('id_asignatura')->constrained('asignatura', 'id_asignatura')->onDelete('cascade');
            $table->string('grupo');
            $table->foreignId('id_docente')->constrained('docente', 'id_docente')->onDelete('cascade');
            $table->primary(['id_proyecto', 'id_asignatura', 'grupo']);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('proyecto_asignatura');

        Schema::table('proyecto', function (Blueprint $table) {
            $table->dropColumn(['fecha_inicio', 'fecha_fin']);
        });
    }
}; 