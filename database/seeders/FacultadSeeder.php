<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class FacultadSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('facultad')->insert([
            'nombre' => 'Ingeniería',
            'id_institucion' => 1,
            'created_at' => now(),
            'updated_at' => now(),
        ]);
    }
} 