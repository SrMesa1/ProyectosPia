<?php

namespace App\Http\Controllers;

use App\Models\Estudiante;
use App\Models\Programa;
use App\Models\Usuario;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class EstudianteController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware(function ($request, $next) {
            if (Auth::user()->id_tipo_usuario !== 1) {
                return redirect('/dashboard')->with('error', 'Acceso no autorizado.');
            }
            return $next($request);
        })->except(['create', 'store']);
    }

    public function dashboard()
    {
        $estudiante = Estudiante::where('id_usuario', Auth::id())->first();
        
        if (!$estudiante) {
            return redirect()->route('estudiante.create')
                ->with('info', 'Por favor, complete su perfil de estudiante.');
        }
        
        return view('estudiante.dashboard', compact('estudiante'));
    }

    public function create()
    {
        // Verificar si ya existe un perfil de estudiante
        $estudiante = Estudiante::where('id_usuario', Auth::id())->first();
        if ($estudiante) {
            return redirect()->route('estudiante.dashboard');
        }
        
        $programas = Programa::all();
        return view('estudiante.create', compact('programas'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'nombre' => 'required|string|max:255',
            'codigo' => 'required|string|max:20|unique:estudiante,codigo',
            'semestre' => 'required|integer|min:1|max:10',
            'id_programa' => 'required|exists:programa,id_programa',
        ]);

        $estudiante = new Estudiante();
        $estudiante->nombre = $request->nombre;
        $estudiante->codigo = $request->codigo;
        $estudiante->semestre = $request->semestre;
        $estudiante->id_programa = $request->id_programa;
        $estudiante->id_usuario = Auth::id();
        $estudiante->save();

        // Actualizar el estado del usuario para indicar que completó su perfil
        $usuario = Usuario::find(Auth::id());
        $usuario->perfil_completado = true;
        $usuario->save();

        return redirect()->route('dashboard')->with('success', 'Perfil de estudiante creado exitosamente.');
    }

    public function show($id)
    {
        $estudiante = Estudiante::findOrFail($id);
        if ($estudiante->id_usuario !== Auth::id()) {
            return redirect()->route('estudiante.dashboard')
                ->with('error', 'No tiene permiso para ver este perfil.');
        }
        return view('estudiante.show', compact('estudiante'));
    }

    public function edit($id)
    {
        $estudiante = Estudiante::findOrFail($id);
        if ($estudiante->id_usuario !== Auth::id()) {
            return redirect()->route('estudiante.dashboard')
                ->with('error', 'No tiene permiso para editar este perfil.');
        }
        $programas = Programa::all();
        return view('estudiante.edit', compact('estudiante', 'programas'));
    }

    public function update(Request $request, $id)
    {
        $estudiante = Estudiante::findOrFail($id);
        if ($estudiante->id_usuario !== Auth::id()) {
            return redirect()->route('estudiante.dashboard')
                ->with('error', 'No tiene permiso para actualizar este perfil.');
        }

        $request->validate([
            'nombre' => 'required|string|max:255',
            'codigo' => 'required|string|unique:estudiante,codigo,'.$id.',id_estudiante',
            'semestre' => 'required|integer|min:1|max:10',
            'id_programa' => 'required|exists:programa,id_programa'
        ]);

        $estudiante->update($request->all());

        return redirect()->route('estudiante.dashboard')
            ->with('success', 'Perfil actualizado exitosamente.');
    }

    public function destroy($id)
    {
        $estudiante = Estudiante::findOrFail($id);
        if ($estudiante->id_usuario !== Auth::id()) {
            return redirect()->route('estudiante.dashboard')
                ->with('error', 'No tiene permiso para eliminar este perfil.');
        }
        
        $estudiante->delete();

        return redirect()->route('dashboard')
            ->with('success', 'Perfil eliminado exitosamente.');
    }
}
