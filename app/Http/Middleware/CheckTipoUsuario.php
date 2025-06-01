<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CheckTipoUsuario
{
    public function handle(Request $request, Closure $next, $tipo)
    {
        if (!Auth::check()) {
            return redirect('login');
        }

        $user = Auth::user();
        $tipoId = null;

        switch ($tipo) {
            case 'estudiante':
                $tipoId = 1;
                break;
            case 'docente':
                $tipoId = 2;
                break;
            case 'evaluador':
                $tipoId = 3;
                break;
        }

        if ($user->id_tipo_usuario !== $tipoId) {
            return redirect('dashboard')->with('error', 'No tienes permiso para acceder a esta sección.');
        }

        return $next($request);
    }
} 