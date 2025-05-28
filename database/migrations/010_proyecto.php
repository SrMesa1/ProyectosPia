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
            $table->string('titulo', 150);
            $table->text('descripcion')->nullable();
            $table->unsignedBigInteger('id_tipo_proyecto');
            $table->timestamps();

            $table->foreign('id_tipo_proyecto')->references('id_tipo_proyecto')->on('tipo_proyecto')->onDelete('cascade');
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
