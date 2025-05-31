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
            InstitucionSeeder::class,
            DepartamentoSeeder::class,
            FacultadSeeder::class,
            ProgramaSeeder::class,
            AsignaturaSeeder::class,
            TipoUsuarioSeeder::class,
        ]);
    }
}
