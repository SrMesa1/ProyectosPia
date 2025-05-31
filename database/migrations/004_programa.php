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
        Schema::create('programa', function (Blueprint $table) {
            $table->id('id_programa');
            $table->string('nombre', 100);
            $table->unsignedBigInteger('id_facultad');
            $table->timestamps();

            $table->foreign('id_facultad')->references('id_facultad')->on('facultad')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('programa');
    }
};
