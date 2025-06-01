<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\EstudianteController;
use App\Http\Controllers\DocenteController;
use App\Http\Controllers\EvaluadorController;
use App\Http\Controllers\ProyectoController;
use App\Http\Controllers\EvaluacionController;
use App\Http\Controllers\AsignaturaController;
use App\Http\Controllers\ProgramaController;
use App\Http\Controllers\TipoProyectoController;
use App\Http\Controllers\DashboardController;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

// Rutas públicas
Route::get('/', function () {
    return view('welcome');
});

// Rutas de autenticación y registro inicial
Route::middleware('guest')->group(function () {
    Route::get('/registro/estudiante', [EstudianteController::class, 'create'])
        ->name('registro.estudiante.create');
    Route::post('/registro/estudiante', [EstudianteController::class, 'store'])
        ->name('registro.estudiante.store');

    Route::get('/registro/docente', [DocenteController::class, 'create'])
        ->name('registro.docente.create');
    Route::post('/registro/docente', [DocenteController::class, 'store'])
        ->name('registro.docente.store');

    Route::get('/registro/evaluador', [EvaluadorController::class, 'create'])
        ->name('registro.evaluador.create');
    Route::post('/registro/evaluador', [EvaluadorController::class, 'store'])
        ->name('registro.evaluador.store');
});

// Dashboard y perfil
Route::middleware(['auth', 'verified'])->group(function () {
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

// Rutas para estudiantes
Route::middleware(['auth', 'tipo.usuario:estudiante'])->group(function () {
    Route::get('/estudiante/dashboard', [EstudianteController::class, 'dashboard'])->name('estudiante.dashboard');
    Route::get('/estudiante/edit', [EstudianteController::class, 'edit'])->name('estudiante.edit');
    Route::put('/estudiante', [EstudianteController::class, 'update'])->name('estudiante.update');
    Route::resource('proyecto', ProyectoController::class)->except(['index', 'show']);
});

// Rutas para docentes
Route::middleware(['auth', 'tipo.usuario:docente'])->group(function () {
    Route::get('/docente/dashboard', [DocenteController::class, 'dashboard'])->name('docente.dashboard');
    Route::get('/docente/edit', [DocenteController::class, 'edit'])->name('docente.edit');
    Route::put('/docente', [DocenteController::class, 'update'])->name('docente.update');
    Route::get('/docente/proyectos', [ProyectoController::class, 'index'])->name('docente.proyectos');
    Route::resource('asignatura', AsignaturaController::class);
});

// Rutas para evaluadores
Route::middleware(['auth', 'tipo.usuario:evaluador'])->group(function () {
    Route::get('/evaluador/dashboard', [EvaluadorController::class, 'dashboard'])->name('evaluador.dashboard');
    Route::get('/evaluador/edit', [EvaluadorController::class, 'edit'])->name('evaluador.edit');
    Route::put('/evaluador', [EvaluadorController::class, 'update'])->name('evaluador.update');
    Route::get('/evaluacion/create/{id_proyecto}', [EvaluacionController::class, 'create'])->name('evaluacion.create');
    Route::post('/evaluacion/{id_proyecto}', [EvaluacionController::class, 'store'])->name('evaluacion.store');
    Route::get('/evaluacion/{id}/edit', [EvaluacionController::class, 'edit'])->name('evaluacion.edit');
    Route::put('/evaluacion/{id}', [EvaluacionController::class, 'update'])->name('evaluacion.update');
    Route::delete('/evaluacion/{id}', [EvaluacionController::class, 'destroy'])->name('evaluacion.destroy');
});

// Rutas compartidas (accesibles por todos los usuarios autenticados)
Route::middleware(['auth'])->group(function () {
    Route::get('/proyecto/{proyecto}', [ProyectoController::class, 'show'])->name('proyecto.show');
    Route::get('/programa/{programa}', [ProgramaController::class, 'show'])->name('programa.show');
    Route::get('/asignatura/{asignatura}', [AsignaturaController::class, 'show'])->name('asignatura.show');
});

require __DIR__.'/auth.php';
