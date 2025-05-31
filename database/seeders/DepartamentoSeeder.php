<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class DepartamentoSeeder extends Seeder
{
    public function run(): void
    {
        DB::table('departamento')->insert([
            'nombre' => 'Departamento de Sistemas y Desarrollo',
            'id_institucion' => 1, // Referencia a la Institución Pascual Bravo
            'created_at' => now(),
            'updated_at' => now(),
        ]);
    }
} 