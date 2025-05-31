<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class TipoUsuarioSeeder extends Seeder
{
    public function run(): void
    {
        $tipos = [
            [
                'id_tipo_usuario' => 1,
                'nombre' => 'Estudiante',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'id_tipo_usuario' => 2,
                'nombre' => 'Docente',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'id_tipo_usuario' => 3,
                'nombre' => 'Evaluador',
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ];

        DB::table('tipo_usuario')->insert($tipos);
    }
} 