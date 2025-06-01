<?php

namespace App\Http\Controllers;

use App\Models\Evaluador;
use App\Models\Proyecto;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class EvaluadorController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware(function ($request, $next) {
            if (Auth::user()->tipo_usuario !== 'evaluador') {
                return redirect('/dashboard')->with('error', 'Acceso no autorizado.');
            }
            return $next($request);
        })->except(['create', 'store']);
    }

    public function dashboard()
    {
        $evaluador = Evaluador::where('correo', Auth::user()->email)->first();
        
        if (!$evaluador) {
            return redirect()->route('evaluador.create')
                ->with('info', 'Por favor, complete su perfil de evaluador.');
        }

        // Obtener todos los proyectos con sus relaciones
        $proyectos = Proyecto::with(['tipoProyecto', 'estudiantes', 'asignaturas', 'evaluaciones'])
            ->orderBy('created_at', 'desc')
            ->get();

        return view('evaluador.dashboard', compact('evaluador', 'proyectos'));
    }

    public function create()
    {
        // Verificar si ya existe un perfil de evaluador
        $evaluador = Evaluador::where('correo', Auth::user()->email)->first();
        if ($evaluador) {
            return redirect()->route('evaluador.dashboard');
        }
        
        return view('evaluador.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'nombre' => 'required|string|max:255',
            'numero_empleado' => 'required|string|unique:evaluador,numero_empleado',
            'especialidad' => 'required|string|max:255',
            'institucion' => 'required|string|max:255'
        ]);

        $evaluador = new Evaluador();
        $evaluador->nombre = $request->nombre;
        $evaluador->numero_empleado = $request->numero_empleado;
        $evaluador->especialidad = $request->especialidad;
        $evaluador->institucion = $request->institucion;
        $evaluador->correo = Auth::user()->email;
        $evaluador->save();

        // Actualizar el estado del usuario para indicar que completó su perfil
        $usuario = User::find(Auth::id());
        $usuario->perfil_completado = true;
        $usuario->save();

        return redirect()->route('evaluador.dashboard')
            ->with('success', 'Perfil de evaluador creado exitosamente.');
    }

    public function show($id)
    {
        $evaluador = Evaluador::findOrFail($id);
        if ($evaluador->correo !== Auth::user()->email) {
            return redirect()->route('evaluador.dashboard')
                ->with('error', 'No tiene permiso para ver este perfil.');
        }
        return view('evaluador.show', compact('evaluador'));
    }

    public function edit($id)
    {
        $evaluador = Evaluador::findOrFail($id);
        if ($evaluador->correo !== Auth::user()->email) {
            return redirect()->route('evaluador.dashboard')
                ->with('error', 'No tiene permiso para editar este perfil.');
        }
        return view('evaluador.edit', compact('evaluador'));
    }

    public function update(Request $request, $id)
    {
        $evaluador = Evaluador::findOrFail($id);
        if ($evaluador->correo !== Auth::user()->email) {
            return redirect()->route('evaluador.dashboard')
                ->with('error', 'No tiene permiso para actualizar este perfil.');
        }

        $request->validate([
            'nombre' => 'required|string|max:255',
            'numero_empleado' => 'required|string|unique:evaluador,numero_empleado,'.$id.',id_evaluador',
            'especialidad' => 'required|string|max:255',
            'institucion' => 'required|string|max:255'
        ]);

        $evaluador->update($request->all());

        return redirect()->route('evaluador.dashboard')
            ->with('success', 'Perfil actualizado exitosamente.');
    }

    public function destroy($id)
    {
        $evaluador = Evaluador::findOrFail($id);
        if ($evaluador->correo !== Auth::user()->email) {
            return redirect()->route('evaluador.dashboard')
                ->with('error', 'No tiene permiso para eliminar este perfil.');
        }
        
        $evaluador->delete();

        return redirect()->route('dashboard')
            ->with('success', 'Perfil eliminado exitosamente.');
    }
}
