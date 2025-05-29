<?php

namespace App\Http\Controllers;

use App\Models\Usuario;
use App\Models\TipoUsuario;
use App\Models\Estudiante;
use App\Models\Docente;
use App\Models\Evaluador;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class UsuarioController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $usuarios = Usuario::with('tipoUsuario')->get();
        return view('usuarios.index', compact('usuarios'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $tipos = TipoUsuario::all();
        return view('usuarios.create', compact('tipos'));

    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'nombre_usuario' => 'required|unique:usuarios',
            'contraseña' => 'required|min:6',
            'id_tipo_usuario' => 'required|exists:tipo_usuarios,id'
        ]);

        $data = [
            'nombre_usuario' => $request->nombre_usuario,
            'contraseña' => Hash::make($request->contraseña),
            'id_tipo_usuario' => $request->id_tipo_usuario
        ];

        if ($request->id_tipo_usuario == 1) {
            $estudiante = Estudiante::create($request->only('nombre', 'correo', 'documento', 'id_programa'));
            $data['id_estudiante'] = $estudiante->id;
        } elseif ($request->id_tipo_usuario == 2) {
            $docente = Docente::create($request->only('nombre', 'correo', 'documento', 'id_departamento'));
            $data['id_docente'] = $docente->id;
        } elseif ($request->id_tipo_usuario == 3) {
            $evaluador = Evaluador::create($request->only('nombre', 'correo', 'documento'));
            $data['id_evaluador'] = $evaluador->id;
        }

        Usuario::create($data);
        return redirect()->route('usuarios.index')->with('success', 'Usuario creado.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        Usuario::destroy($id);
        return redirect()->route('usuarios.index')->with('success', 'Usuario eliminado.');
    }
}
