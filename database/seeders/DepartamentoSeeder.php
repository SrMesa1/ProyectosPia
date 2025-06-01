<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class DepartamentoSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('departamento')->insert([
            'nombre' => 'Sistemas e Informática',
            'id_facultad' => 1,
            'created_at' => now(),
            'updated_at' => now(),
        ]);
    }
} 