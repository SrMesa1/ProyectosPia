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
        Schema::table('programa', function (Blueprint $table) {
            $table->foreign('id_departamento')
                ->references('id_departamento')
                ->on('departamento')
                ->onDelete('cascade');
        });

        Schema::table('asignatura', function (Blueprint $table) {
            $table->foreign('id_programa')
                ->references('id_programa')
                ->on('programa')
                ->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('programa', function (Blueprint $table) {
            $table->dropForeign(['id_departamento']);
        });

        Schema::table('asignatura', function (Blueprint $table) {
            $table->dropForeign(['id_programa']);
        });
    }
}; 