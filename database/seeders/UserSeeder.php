<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use App\Models\User;
use App\Models\Estudiante;
use App\Models\Docente;
use App\Models\Evaluador;
use App\Models\Programa;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Usuario Administrador
        User::create([
            'email' => 'admin@example.com',
            'password' => Hash::make('password'),
            'tipo_usuario' => 'admin',
            'perfil_completado' => true
        ]);

        // Usuario Docente
        $docente = User::create([
            'email' => 'docente@example.com',
            'password' => Hash::make('password'),
            'tipo_usuario' => 'docente',
            'perfil_completado' => true
        ]);

        // Crear perfil de docente
        Docente::create([
            'nombres' => 'Juan',
            'apellidos' => 'Pérez',
            'documento' => '12345678',
            'telefono' => '3001234567',
            'id_usuario' => $docente->id,
            'id_programa' => Programa::first()->id_programa
        ]);

        // Usuario Estudiante
        $estudiante = User::create([
            'email' => 'estudiante@example.com',
            'password' => Hash::make('password'),
            'tipo_usuario' => 'estudiante',
            'perfil_completado' => true
        ]);

        // Crear perfil de estudiante
        Estudiante::create([
            'nombres' => 'María',
            'apellidos' => 'González',
            'documento' => '87654321',
            'telefono' => '3007654321',
            'id_usuario' => $estudiante->id,
            'id_programa' => Programa::first()->id_programa,
            'semestre' => 5
        ]);

        // Usuario Evaluador
        $evaluador = User::create([
            'email' => 'evaluador@example.com',
            'password' => Hash::make('password'),
            'tipo_usuario' => 'evaluador',
            'perfil_completado' => true
        ]);

        // Crear perfil de evaluador
        Evaluador::create([
            'nombres' => 'Carlos',
            'apellidos' => 'Rodríguez',
            'documento' => '98765432',
            'telefono' => '3009876543',
            'id_usuario' => $evaluador->id,
            'especialidad' => 'Desarrollo Web',
            'experiencia' => 5
        ]);
    }
} 