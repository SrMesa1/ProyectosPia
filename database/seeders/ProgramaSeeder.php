<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ProgramaSeeder extends Seeder
{
    public function run(): void
    {
        DB::table('programa')->insert([
            'nombre' => 'Tecnología en Desarrollo de Software',
            'id_facultad' => 1, // Referencia a la Facultad de Ingeniería
            'created_at' => now(),
            'updated_at' => now(),
        ]);
    }
} 