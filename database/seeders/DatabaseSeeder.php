<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $this->call([
            // Primero las tablas base
            InstitucionSeeder::class,
            FacultadSeeder::class,
            DepartamentoSeeder::class,
            ProgramaSeeder::class,
            
            // Tipos de proyecto y asignaturas predefinidas
            TipoProyectoSeeder::class,
            AsignaturaSeeder::class,

            // Tipos de usuario y roles
            TipoUsuarioSeeder::class,

            // Usuarios y sus perfiles
            UserSeeder::class,

            // Finalmente los proyectos de prueba
            ProyectoSeeder::class
        ]);
    }
}
