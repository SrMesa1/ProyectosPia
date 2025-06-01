<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class TipoProyectoSeeder extends Seeder
{
    public function run(): void
    {
        // Asegurarse de que la tabla esté vacía
        DB::table('tipo_proyecto')->truncate();

        // Insertar solo los dos tipos de proyecto permitidos
        DB::table('tipo_proyecto')->insert([
            [
                'nombre' => 'PIA',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'nombre' => 'PA',
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
}