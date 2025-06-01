<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\Usuario;
use App\Providers\RouteServiceProvider;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules;
use Illuminate\View\View;

class RegisteredUserController extends Controller
{
    /**
     * Display the registration view.
     */
    public function create(): View
    {
        return view('auth.register');
    }

    /**
     * Handle an incoming registration request.
     *
     * @throws \Illuminate\Validation\ValidationException
     */
    public function store(Request $request): RedirectResponse
    {
        $request->validate([
            'nombre_usuario' => ['required', 'string', 'max:50', 'unique:usuario,nombre_usuario'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:usuario,email'],
            'password' => ['required', 'confirmed', Rules\Password::defaults()],
            'id_tipo_usuario' => ['required', 'integer', 'exists:tipo_usuario,id_tipo_usuario'],
        ]);

        $usuario = Usuario::create([
            'nombre_usuario' => $request->nombre_usuario,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'id_tipo_usuario' => $request->id_tipo_usuario,
        ]);

        event(new Registered($usuario));

        Auth::login($usuario);

        // Redirigir según el tipo de usuario
        switch($request->id_tipo_usuario) {
            case 1: // Estudiante
                return redirect()->route('registro.estudiante.create');
            case 2: // Docente
                return redirect()->route('registro.docente.create');
            case 3: // Evaluador
                return redirect()->route('registro.evaluador.create');
            default:
                return redirect(RouteServiceProvider::HOME);
        }
    }
}
