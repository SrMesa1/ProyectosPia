<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class InstitucionSeeder extends Seeder
{
    public function run(): void
    {
        DB::table('institucion')->insert([
            'nombre' => 'Institución Universitaria Pascual Bravo',
            'created_at' => now(),
            'updated_at' => now(),
        ]);
    }
} 