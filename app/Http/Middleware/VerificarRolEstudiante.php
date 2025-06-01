<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class VerificarRolEstudiante
{
    public function handle(Request $request, Closure $next)
    {
        if (!Auth::check() || Auth::user()->tipo_usuario !== 'estudiante') {
            return redirect('/')->with('error', 'Acceso no autorizado.');
        }

        return $next($request);
    }
} 