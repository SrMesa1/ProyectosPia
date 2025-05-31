<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class FacultadSeeder extends Seeder
{
    public function run(): void
    {
        DB::table('facultad')->insert([
            'nombre' => 'Ingeniería',
            'id_departamento' => 1, // Referencia al Departamento de Sistemas
            'created_at' => now(),
            'updated_at' => now(),
        ]);
    }
} 