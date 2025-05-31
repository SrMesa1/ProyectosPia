<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class AsignaturaSeeder extends Seeder
{
    public function run(): void
    {
        DB::table('asignatura')->insert([
            'nombre' => 'Desarrollo Web',
            'id_programa' => 1, // Referencia al programa de Tecnología en Desarrollo de Software
            'created_at' => now(),
            'updated_at' => now(),
        ]);
    }
} 