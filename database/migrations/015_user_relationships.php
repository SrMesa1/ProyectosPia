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
        // Agregar campo perfil_completado a usuarios
        Schema::table('usuario', function (Blueprint $table) {
            if (!Schema::hasColumn('usuario', 'perfil_completado')) {
                $table->boolean('perfil_completado')->default(false);
            }
        });

        // Agregar relación con estudiante
        Schema::table('estudiante', function (Blueprint $table) {
            if (!Schema::hasColumn('estudiante', 'id_usuario')) {
                $table->foreignId('id_usuario')->unique()->constrained('usuario', 'id_usuario');
            }
        });

        // Agregar relación con docente
        Schema::table('docente', function (Blueprint $table) {
            if (!Schema::hasColumn('docente', 'id_usuario')) {
                $table->foreignId('id_usuario')->unique()->constrained('usuario', 'id_usuario');
            }
        });

        // Agregar relación con evaluador
        Schema::table('evaluador', function (Blueprint $table) {
            if (!Schema::hasColumn('evaluador', 'id_usuario')) {
                $table->foreignId('id_usuario')->unique()->constrained('usuario', 'id_usuario');
            }
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('evaluador', function (Blueprint $table) {
            $table->dropForeign(['id_usuario']);
            $table->dropColumn('id_usuario');
        });

        Schema::table('docente', function (Blueprint $table) {
            $table->dropForeign(['id_usuario']);
            $table->dropColumn('id_usuario');
        });

        Schema::table('estudiante', function (Blueprint $table) {
            $table->dropForeign(['id_usuario']);
            $table->dropColumn('id_usuario');
        });

        Schema::table('usuario', function (Blueprint $table) {
            $table->dropColumn('perfil_completado');
        });
    }
}; 