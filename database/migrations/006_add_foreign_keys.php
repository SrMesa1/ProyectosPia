<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('departamento', function (Blueprint $table) {
            $table->foreign('id_institucion')->references('id_institucion')->on('institucion')->onDelete('cascade');
        });

        Schema::table('facultad', function (Blueprint $table) {
            $table->foreign('id_departamento')->references('id_departamento')->on('departamento')->onDelete('cascade');
        });

        Schema::table('programa', function (Blueprint $table) {
            $table->foreign('id_facultad')->references('id_facultad')->on('facultad')->onDelete('cascade');
        });

        Schema::table('asignatura', function (Blueprint $table) {
            $table->foreign('id_programa')->references('id_programa')->on('programa')->onDelete('cascade');
        });
    }

    public function down(): void
    {
        Schema::table('asignatura', function (Blueprint $table) {
            $table->dropForeign(['id_programa']);
        });

        Schema::table('programa', function (Blueprint $table) {
            $table->dropForeign(['id_facultad']);
        });

        Schema::table('facultad', function (Blueprint $table) {
            $table->dropForeign(['id_departamento']);
        });

        Schema::table('departamento', function (Blueprint $table) {
            $table->dropForeign(['id_institucion']);
        });
    }
}; 