<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Asignatura;

class AsignaturaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $asignaturas = [
            [
                'nombre' => 'Desarrollo Web',
                'codigo' => 'DW001',
                'descripcion' => 'Curso de desarrollo de aplicaciones web'
            ],
            [
                'nombre' => 'Herramientas de Programación',
                'codigo' => 'HP001',
                'descripcion' => 'Curso de herramientas y técnicas de programación'
            ],
            [
                'nombre' => 'Bases de Datos 1',
                'codigo' => 'BD001',
                'descripcion' => 'Curso de fundamentos de bases de datos'
            ]
        ];

        foreach ($asignaturas as $asignatura) {
            Asignatura::create($asignatura);
        }
    }
} 