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
        Schema::create('proyecto_evaluacion', function (Blueprint $table) {
            $table->unsignedBigInteger('id_proyecto');
            $table->unsignedBigInteger('id_evaluador');
            $table->string('criterio', 100);
            $table->text('resultado')->nullable();
            $table->timestamps();

            $table->primary(['id_proyecto', 'id_evaluador', 'criterio']);

            $table->foreign('id_proyecto')->references('id_proyecto')->on('proyecto')->onDelete('cascade');
            $table->foreign('id_evaluador')->references('id_evaluador')->on('evaluador')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('proyecto_evaluacion');
    }
};
