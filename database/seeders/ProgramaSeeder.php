<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ProgramaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('programa')->insert([
            'nombre' => 'Ingeniería de Sistemas',
            'id_departamento' => 1,
            'created_at' => now(),
            'updated_at' => now(),
        ]);
    }
} 