<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Proyecto;
use App\Models\Estudiante;
use App\Models\Asignatura;
use Carbon\Carbon;

class ProyectoSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $estudiante = Estudiante::first();
        $asignatura = Asignatura::first();

        // Crear un proyecto PIA
        Proyecto::create([
            'titulo' => 'Sistema de Gestión de Proyectos',
            'descripcion' => 'Desarrollo de un sistema web para la gestión de proyectos académicos',
            'tipo' => 'PIA',
            'estado' => 'en_curso',
            'fecha_inicio' => Carbon::now(),
            'fecha_fin' => Carbon::now()->addWeeks(12),
            'id_estudiante' => $estudiante->id_estudiante,
            'id_asignatura' => $asignatura->id_asignatura,
            'grupo' => 'G01'
        ]);

        // Crear un proyecto PA
        Proyecto::create([
            'titulo' => 'Aplicación de Chat en Tiempo Real',
            'descripcion' => 'Desarrollo de una aplicación de chat usando WebSockets',
            'tipo' => 'PA',
            'estado' => 'pendiente',
            'fecha_inicio' => Carbon::now()->addWeeks(1),
            'fecha_fin' => Carbon::now()->addWeeks(6),
            'id_estudiante' => $estudiante->id_estudiante,
            'id_asignatura' => $asignatura->id_asignatura,
            'grupo' => 'G02'
        ]);
    }
} 