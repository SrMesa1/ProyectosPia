<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class CheckUserType
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next, string $tipo): Response
    {
        if (!$request->user()) {
            return redirect()->route('login');
        }

        $tipoId = match($tipo) {
            'estudiante' => 1,
            'docente' => 2,
            'evaluador' => 3,
            default => null,
        };

        if ($request->user()->id_tipo_usuario !== $tipoId) {
            if ($request->routeIs('dashboard')) {
                return $next($request);
            }
            
            return redirect()->route('dashboard')
                ->with('error', 'No tienes permiso para acceder a esta sección.');
        }

        return $next($request);
    }
} 