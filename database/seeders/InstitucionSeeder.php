<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class InstitucionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('institucion')->insert([
            'nombre' => 'Universidad Francisco de Paula Santander',
            'created_at' => now(),
            'updated_at' => now(),
        ]);
    }
} 