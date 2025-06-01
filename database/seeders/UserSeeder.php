<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use App\Models\User;

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
        User::create([
            'email' => 'docente@example.com',
            'password' => Hash::make('password'),
            'tipo_usuario' => 'docente',
            'perfil_completado' => false
        ]);

        // Usuario Estudiante
        User::create([
            'email' => 'estudiante@example.com',
            'password' => Hash::make('password'),
            'tipo_usuario' => 'estudiante',
            'perfil_completado' => false
        ]);

        // Usuario Evaluador
        User::create([
            'email' => 'evaluador@example.com',
            'password' => Hash::make('password'),
            'tipo_usuario' => 'evaluador',
            'perfil_completado' => false
        ]);
    }
} 