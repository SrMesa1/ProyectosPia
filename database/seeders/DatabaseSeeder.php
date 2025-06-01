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
            
            // Luego las asignaturas predefinidas
            AsignaturaSeeder::class,

            // Finalmente los usuarios y sus roles
            UserSeeder::class, // Necesitamos crear este seeder
        ]);
    }
}
