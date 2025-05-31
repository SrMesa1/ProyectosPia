<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\EstudianteController;
use App\Http\Controllers\DocenteController;
use App\Http\Controllers\EvaluadorController;
use App\Http\Controllers\UsuarioController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
*/

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('web')->group(function () {
    // Rutas para el registro de usuarios y sus roles
    Route::resource('usuario', UsuarioController::class);

    // Rutas para completar el registro según el tipo de usuario
    Route::get('/estudiante/create', [EstudianteController::class, 'create'])->name('estudiante.create');
    Route::post('/estudiante', [EstudianteController::class, 'store'])->name('estudiante.store');

    Route::get('/docente/create', [DocenteController::class, 'create'])->name('docente.create');
    Route::post('/docente', [DocenteController::class, 'store'])->name('docente.store');

    Route::get('/evaluador/create', [EvaluadorController::class, 'create'])->name('evaluador.create');
    Route::post('/evaluador', [EvaluadorController::class, 'store'])->name('evaluador.store');
});

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
