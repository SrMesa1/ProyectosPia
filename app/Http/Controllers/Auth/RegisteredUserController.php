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
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:usuarios'],
            'password' => ['required', 'confirmed', Rules\Password::defaults()],
            'tipo_usuario' => ['required', 'in:1,2,3'],
        ]);

        $usuario = Usuario::create([
            'nombre_usuario' => $request->name,
            'email' => $request->email,
            'contraseña' => Hash::make($request->password),
            'id_tipo_usuario' => $request->tipo_usuario,
        ]);

        event(new Registered($usuario));

        Auth::login($usuario);

        // Redirigir según el tipo de usuario
        switch($request->tipo_usuario) {
            case 1:
                return redirect()->route('estudiante.create', ['user_id' => $usuario->id]);
            case 2:
                return redirect()->route('docente.create', ['user_id' => $usuario->id]);
            case 3:
                return redirect()->route('evaluador.create', ['user_id' => $usuario->id]);
            default:
                return redirect(RouteServiceProvider::HOME);
        }
    }
}
