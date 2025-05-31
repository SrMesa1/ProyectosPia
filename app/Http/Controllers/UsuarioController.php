<?php

namespace App\Http\Controllers;

use App\Models\Usuario;
use App\Models\TipoUsuario;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\Rules;
use App\Http\Controllers\Controller;

class UsuarioController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('web');
        $this->middleware('auth')->except(['create', 'store']);
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $usuarios = Usuario::with('tipoUsuario')->get();
        return view('usuario.index', compact('usuarios'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $tipos = TipoUsuario::all();
        return view('usuario.create', compact('tipos'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'nombre_usuario' => ['required', 'string', 'max:50', 'unique:usuarios'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:usuarios'],
            'password' => ['required', 'confirmed', Rules\Password::defaults()],
            'id_tipo_usuario' => ['required', 'exists:tipo_usuario,id_tipo_usuario']
        ]);

        $usuario = Usuario::create([
            'nombre_usuario' => $request->nombre_usuario,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'id_tipo_usuario' => $request->id_tipo_usuario
        ]);

        Auth::login($usuario);

        // Redirigir según el tipo de usuario
        switch($request->id_tipo_usuario) {
            case 1: // Estudiante
                return redirect()->route('estudiante.create')->with('user_id', $usuario->id_usuario);
            case 2: // Docente
                return redirect()->route('docente.create')->with('user_id', $usuario->id_usuario);
            case 3: // Evaluador
                return redirect()->route('evaluador.create')->with('user_id', $usuario->id_usuario);
            default:
                return redirect()->route('usuario.index')->with('success', 'Usuario registrado exitosamente.');
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        Usuario::destroy($id);
        return redirect()->route('usuario.index')->with('success', 'Usuario eliminado exitosamente.');
    }
}
