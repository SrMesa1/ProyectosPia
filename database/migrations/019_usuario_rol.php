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
        Schema::create('usuario_rol', function (Blueprint $table) {
            $table->foreignId('id_usuario')->constrained('usuario', 'id_usuario')->onDelete('cascade');
            $table->foreignId('id_rol')->constrained('rol', 'id_rol')->onDelete('cascade');
            $table->timestamps();

            $table->primary(['id_usuario', 'id_rol']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('usuario_rol');
    }
};
