<?php

namespace App\Http\Controllers;

use App\Models\Docente;
use App\Models\Asignatura;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DocenteController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware(function ($request, $next) {
            if (Auth::user()->tipo_usuario !== 'docente') {
                return redirect('/dashboard')->with('error', 'Acceso no autorizado.');
            }
            return $next($request);
        })->except(['create', 'store']);
    }

    public function dashboard()
    {
        $docente = Docente::where('correo', Auth::user()->email)->first();
        
        if (!$docente) {
            return redirect()->route('docente.create')
                ->with('info', 'Por favor, complete su perfil de docente.');
        }

        // Obtener los proyectos de las asignaturas que imparte el docente
        $proyectos = $docente->proyectos()
            ->with(['tipoProyecto', 'estudiantes', 'asignaturas'])
            ->orderBy('created_at', 'desc')
            ->get();

        // Obtener las asignaturas que imparte el docente
        $asignaturas = $docente->asignaturas()->get();

        return view('docente.dashboard', compact('docente', 'proyectos', 'asignaturas'));
    }

    public function create()
    {
        // Verificar si ya existe un perfil de docente
        $docente = Docente::where('correo', Auth::user()->email)->first();
        if ($docente) {
            return redirect()->route('docente.dashboard');
        }

        // Obtener la lista de asignaturas disponibles
        $asignaturas = Asignatura::all();
        
        return view('docente.create', compact('asignaturas'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'nombre' => 'required|string|max:255',
            'numero_empleado' => 'required|string|unique:docente,numero_empleado',
            'especialidad' => 'required|string|max:255',
            'asignaturas' => 'required|array|min:1',
            'asignaturas.*.id_asignatura' => 'required|exists:asignatura,id_asignatura',
            'asignaturas.*.grupo' => 'required|string|max:10'
        ]);

        $docente = new Docente();
        $docente->nombre = $request->nombre;
        $docente->numero_empleado = $request->numero_empleado;
        $docente->especialidad = $request->especialidad;
        $docente->correo = Auth::user()->email;
        $docente->save();

        // Asociar las asignaturas con sus grupos
        foreach ($request->asignaturas as $asignatura) {
            $docente->asignaturas()->attach($asignatura['id_asignatura'], [
                'grupo' => $asignatura['grupo']
            ]);
        }

        // Actualizar el estado del usuario para indicar que completó su perfil
        $usuario = User::find(Auth::id());
        $usuario->perfil_completado = true;
        $usuario->save();

        return redirect()->route('docente.dashboard')
            ->with('success', 'Perfil de docente creado exitosamente.');
    }

    public function show($id)
    {
        $docente = Docente::with('asignaturas')->findOrFail($id);
        if ($docente->correo !== Auth::user()->email) {
            return redirect()->route('docente.dashboard')
                ->with('error', 'No tiene permiso para ver este perfil.');
        }
        return view('docente.show', compact('docente'));
    }

    public function edit($id)
    {
        $docente = Docente::with('asignaturas')->findOrFail($id);
        if ($docente->correo !== Auth::user()->email) {
            return redirect()->route('docente.dashboard')
                ->with('error', 'No tiene permiso para editar este perfil.');
        }

        $asignaturas = Asignatura::all();
        return view('docente.edit', compact('docente', 'asignaturas'));
    }

    public function update(Request $request, $id)
    {
        $docente = Docente::findOrFail($id);
        if ($docente->correo !== Auth::user()->email) {
            return redirect()->route('docente.dashboard')
                ->with('error', 'No tiene permiso para actualizar este perfil.');
        }

        $request->validate([
            'nombre' => 'required|string|max:255',
            'numero_empleado' => 'required|string|unique:docente,numero_empleado,'.$id.',id_docente',
            'especialidad' => 'required|string|max:255',
            'asignaturas' => 'required|array|min:1',
            'asignaturas.*.id_asignatura' => 'required|exists:asignatura,id_asignatura',
            'asignaturas.*.grupo' => 'required|string|max:10'
        ]);

        $docente->update([
            'nombre' => $request->nombre,
            'numero_empleado' => $request->numero_empleado,
            'especialidad' => $request->especialidad
        ]);

        // Actualizar las asignaturas
        $docente->asignaturas()->detach();
        foreach ($request->asignaturas as $asignatura) {
            $docente->asignaturas()->attach($asignatura['id_asignatura'], [
                'grupo' => $asignatura['grupo']
            ]);
        }

        return redirect()->route('docente.dashboard')
            ->with('success', 'Perfil actualizado exitosamente.');
    }

    public function destroy($id)
    {
        $docente = Docente::findOrFail($id);
        if ($docente->correo !== Auth::user()->email) {
            return redirect()->route('docente.dashboard')
                ->with('error', 'No tiene permiso para eliminar este perfil.');
        }
        
        $docente->delete();

        return redirect()->route('dashboard')
            ->with('success', 'Perfil eliminado exitosamente.');
    }
}
