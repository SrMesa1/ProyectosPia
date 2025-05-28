<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\Usuario;
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
        'nombre_usuario' => ['required', 'string', 'max:50', 'unique:usuario'],
        'contraseña' => ['required', 'confirmed', Rules\Password::defaults()],
        'id_tipo_usuario' => ['required', 'exists:tipo_usuario,id_tipo_usuario'],
    ]);

    $usuario = Usuario::create([
        'nombre_usuario' => $request->nombre_usuario,
        'contraseña' => Hash::make($request->contraseña),
        'id_tipo_usuario' => $request->id_tipo_usuario,
    ]);

    Auth::login($usuario);

    return redirect(RouteServiceProvider::HOME);
}

}
