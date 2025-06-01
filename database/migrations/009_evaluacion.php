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
        Schema::create('evaluacion', function (Blueprint $table) {
            $table->id('id_evaluacion');
            $table->foreignId('id_proyecto')->constrained('proyecto', 'id_proyecto')->onDelete('cascade');
            $table->foreignId('id_evaluador')->constrained('evaluador', 'id_evaluador')->onDelete('cascade');
            $table->integer('calificacion');
            $table->text('comentarios')->nullable();
            $table->timestamps();

            // Un evaluador solo puede evaluar un proyecto una vez
            $table->unique(['id_proyecto', 'id_evaluador']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('evaluacion');
    }
}; 