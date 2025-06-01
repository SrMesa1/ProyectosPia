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
        Schema::create('evaluador', function (Blueprint $table) {
            $table->id('id_evaluador');
            $table->string('nombre');
            $table->string('numero_empleado')->unique();
            $table->string('especialidad');
            $table->string('correo')->unique();
            $table->string('institucion');
            $table->foreignId('id_usuario')->constrained('usuario', 'id_usuario')->onDelete('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('evaluador');
    }
}; 