<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;

class DashboardController extends Controller
{
    public function index()
    {
        $user = Auth::user();
        
        if (!$user) {
            return redirect()->route('login');
        }

        Log::info('Dashboard access', [
            'user_id' => $user->id_usuario,
            'tipo_usuario' => $user->id_tipo_usuario,
            'perfil_completado' => $user->perfil_completado
        ]);

        if (!in_array($user->id_tipo_usuario, [1, 2, 3])) {
            Log::error('Tipo de usuario no válido', ['tipo' => $user->id_tipo_usuario]);
            return view('dashboard')->with('error', 'Tipo de usuario no válido');
        }

        if (!$user->perfil_completado) {
            Log::info('Usuario con perfil incompleto');
            $routes = [
                1 => 'registro.estudiante.create',
                2 => 'registro.docente.create',
                3 => 'registro.evaluador.create'
            ];
            
            return redirect()->route($routes[$user->id_tipo_usuario]);
        }

        Log::info('Usuario con perfil completo, redirigiendo según tipo');
        $dashboards = [
            1 => 'estudiante.dashboard',
            2 => 'docente.dashboard',
            3 => 'evaluador.dashboard'
        ];

        return redirect()->route($dashboards[$user->id_tipo_usuario]);
    }
} 