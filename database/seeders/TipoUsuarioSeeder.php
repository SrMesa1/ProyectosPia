<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class TipoUsuarioSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Asegurarse de que la tabla esté vacía
        DB::table('tipo_usuario')->truncate();

        // Insertar los tipos de usuario
        DB::table('tipo_usuario')->insert([
            [
                'id_tipo_usuario' => 1,
                'nombre' => 'Estudiante',
                'descripcion' => 'Usuario con rol de estudiante',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'id_tipo_usuario' => 2,
                'nombre' => 'Docente',
                'descripcion' => 'Usuario con rol de docente',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'id_tipo_usuario' => 3,
                'nombre' => 'Evaluador',
                'descripcion' => 'Usuario con rol de evaluador',
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
} 