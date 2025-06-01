<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\TipoProyecto;

class TipoProyectoSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $tipos = [
            [
                'nombre' => 'PIA',
                'descripcion' => 'Proyecto Integrador Aula',
                'duracion_minima' => 8, // semanas
                'duracion_maxima' => 16 // semanas
            ],
            [
                'nombre' => 'PA',
                'descripcion' => 'Proyecto de Aula',
                'duracion_minima' => 4, // semanas
                'duracion_maxima' => 8 // semanas
            ]
        ];

        foreach ($tipos as $tipo) {
            TipoProyecto::create($tipo);
        }
    }
}