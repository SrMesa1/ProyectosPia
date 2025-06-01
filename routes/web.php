<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\EstudianteController;
use App\Http\Controllers\DocenteController;
use App\Http\Controllers\EvaluadorController;
use App\Http\Controllers\ProyectoController;
use App\Http\Controllers\EvaluacionController;
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

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    if (Auth::check()) {
        switch (Auth::user()->id_tipo_usuario) {
            case 1: // Estudiante
                return redirect()->route('estudiante.dashboard');
            case 2: // Docente
                return redirect()->route('docente.dashboard');
            case 3: // Evaluador
                return redirect()->route('evaluador.dashboard');
        }
    }
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    // Rutas para estudiantes
    Route::get('/estudiante/create', [EstudianteController::class, 'create'])->name('estudiante.create');
    Route::post('/estudiante', [EstudianteController::class, 'store'])->name('estudiante.store');
});

// Rutas de estudiante
Route::middleware(['auth'])->group(function () {
    Route::get('/estudiante/dashboard', [EstudianteController::class, 'dashboard'])->name('estudiante.dashboard');
    Route::get('/estudiante/{id}/edit', [EstudianteController::class, 'edit'])->name('estudiante.edit');
    Route::put('/estudiante/{id}', [EstudianteController::class, 'update'])->name('estudiante.update');
    Route::get('/estudiante/{id}', [EstudianteController::class, 'show'])->name('estudiante.show');
    Route::delete('/estudiante/{id}', [EstudianteController::class, 'destroy'])->name('estudiante.destroy');

    // Rutas para proyectos
    Route::resource('proyecto', ProyectoController::class);
});

// Rutas de docente
Route::middleware(['auth'])->group(function () {
    Route::get('/docente/dashboard', [DocenteController::class, 'dashboard'])->name('docente.dashboard');
    Route::get('/docente/create', [DocenteController::class, 'create'])->name('docente.create');
    Route::post('/docente', [DocenteController::class, 'store'])->name('docente.store');
    Route::get('/docente/{id}/edit', [DocenteController::class, 'edit'])->name('docente.edit');
    Route::put('/docente/{id}', [DocenteController::class, 'update'])->name('docente.update');
    Route::get('/docente/{id}', [DocenteController::class, 'show'])->name('docente.show');
    Route::delete('/docente/{id}', [DocenteController::class, 'destroy'])->name('docente.destroy');
});

// Rutas de evaluador
Route::middleware(['auth'])->group(function () {
    Route::get('/evaluador/dashboard', [EvaluadorController::class, 'dashboard'])->name('evaluador.dashboard');
    Route::get('/evaluador/create', [EvaluadorController::class, 'create'])->name('evaluador.create');
    Route::post('/evaluador', [EvaluadorController::class, 'store'])->name('evaluador.store');
    Route::get('/evaluador/{id}', [EvaluadorController::class, 'show'])->name('evaluador.show');
    Route::get('/evaluador/{id}/edit', [EvaluadorController::class, 'edit'])->name('evaluador.edit');
    Route::put('/evaluador/{id}', [EvaluadorController::class, 'update'])->name('evaluador.update');
    Route::delete('/evaluador/{id}', [EvaluadorController::class, 'destroy'])->name('evaluador.destroy');
});

// Rutas para evaluaciones
Route::middleware(['auth'])->group(function () {
    Route::get('/evaluacion/create/{id_proyecto}', [EvaluacionController::class, 'create'])->name('evaluacion.create');
    Route::post('/evaluacion/{id_proyecto}', [EvaluacionController::class, 'store'])->name('evaluacion.store');
    Route::get('/evaluacion/{id}/edit', [EvaluacionController::class, 'edit'])->name('evaluacion.edit');
    Route::put('/evaluacion/{id}', [EvaluacionController::class, 'update'])->name('evaluacion.update');
    Route::delete('/evaluacion/{id}', [EvaluacionController::class, 'destroy'])->name('evaluacion.destroy');
});

// Rutas públicas para registro inicial
Route::middleware('web')->group(function () {
    Route::get('/registro/estudiante', [EstudianteController::class, 'create'])
        ->name('registro.estudiante.create');
    Route::post('/registro/estudiante', [EstudianteController::class, 'store'])
        ->name('registro.estudiante.store');

    Route::get('/registro/docente', [DocenteController::class, 'create'])
        ->name('registro.docente.create');
    Route::post('/registro/docente', [DocenteController::class, 'store'])
        ->name('registro.docente.store');

    Route::get('/registro/evaluador', [EvaluadorController::class, 'create'])
        ->name('evaluador.create');
    Route::post('/registro/evaluador', [EvaluadorController::class, 'store'])
        ->name('evaluador.store');
});

require __DIR__.'/auth.php';
