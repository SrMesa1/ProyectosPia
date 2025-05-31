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
        Schema::create('usuarios', function (Blueprint $table) {
            $table->id('id_usuario');
            $table->string('nombre_usuario', 50)->unique();
            $table->string('email')->unique();
            $table->string('password');
            $table->rememberToken();
            $table->unsignedBigInteger('id_estudiante')->nullable();
            $table->unsignedBigInteger('id_docente')->nullable();
            $table->unsignedBigInteger('id_evaluador')->nullable();
            $table->unsignedBigInteger('id_tipo_usuario');
            $table->timestamps();

            $table->foreign('id_estudiante')->references('id_estudiante')->on('estudiante')->onDelete('set null');
            $table->foreign('id_docente')->references('id_docente')->on('docente')->onDelete('set null');
            $table->foreign('id_evaluador')->references('id_evaluador')->on('evaluador')->onDelete('set null');
            $table->foreign('id_tipo_usuario')->references('id_tipo_usuario')->on('tipo_usuario')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('usuarios');
    }
};
