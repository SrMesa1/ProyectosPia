<?php

namespace App\Http\Controllers;

use App\Models\Proyecto;
use App\Models\Asignatura;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ProyectoController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        $user = Auth::user();
        $proyectos = [];

        if ($user->tipo_usuario === 'estudiante') {
            $proyectos = Proyecto::where('id_estudiante', $user->estudiante->id_estudiante)
                ->with(['asignatura'])
                ->get();
        } elseif ($user->tipo_usuario === 'docente') {
            $asignaturas = $user->docente->asignaturas()->pluck('id_asignatura');
            $proyectos = Proyecto::whereIn('id_asignatura', $asignaturas)
                ->with(['estudiante', 'asignatura'])
                ->get();
        } elseif ($user->tipo_usuario === 'evaluador') {
            $proyectos = Proyecto::with(['estudiante', 'asignatura'])->get();
        }

        return view('proyecto.index', compact('proyectos'));
    }

    public function create()
    {
        // Verificar que el usuario es un estudiante
        if (Auth::user()->tipo_usuario !== 'estudiante') {
            return redirect()->route('dashboard')
                ->with('error', 'Solo los estudiantes pueden crear proyectos.');
        }

        // Obtener todas las asignaturas disponibles
        $asignaturas = Asignatura::all();
        
        return view('proyecto.create', compact('asignaturas'));
    }

    public function store(Request $request)
    {
        // Verificar que el usuario es un estudiante
        if (Auth::user()->tipo_usuario !== 'estudiante') {
            return redirect()->route('dashboard')
                ->with('error', 'Solo los estudiantes pueden crear proyectos.');
        }

        $request->validate([
            'titulo' => 'required|string|max:255',
            'descripcion' => 'required|string',
            'tipo' => 'required|in:PIA,PA',
            'id_asignatura' => 'required|exists:asignatura,id_asignatura',
            'grupo' => 'required|string|max:10'
        ]);

        // Verificar que el estudiante no tenga ya un proyecto en esta asignatura y grupo
        $existeProyecto = Proyecto::where([
            'id_estudiante' => Auth::user()->estudiante->id_estudiante,
            'id_asignatura' => $request->id_asignatura,
            'grupo' => $request->grupo
        ])->exists();

        if ($existeProyecto) {
            return back()->withErrors([
                'general' => 'Ya tienes un proyecto registrado para esta asignatura y grupo.'
            ])->withInput();
        }

        $proyecto = new Proyecto();
        $proyecto->titulo = $request->titulo;
        $proyecto->descripcion = $request->descripcion;
        $proyecto->tipo = $request->tipo;
        $proyecto->id_estudiante = Auth::user()->estudiante->id_estudiante;
        $proyecto->id_asignatura = $request->id_asignatura;
        $proyecto->grupo = $request->grupo;
        $proyecto->save();

        return redirect()->route('proyecto.index')
            ->with('success', 'Proyecto creado exitosamente.');
    }

    public function show(Proyecto $proyecto)
    {
        $this->authorize('view', $proyecto);
        return view('proyecto.show', compact('proyecto'));
    }

    public function edit(Proyecto $proyecto)
    {
        $this->authorize('update', $proyecto);
        $asignaturas = Asignatura::all();
        return view('proyecto.edit', compact('proyecto', 'asignaturas'));
    }

    public function update(Request $request, Proyecto $proyecto)
    {
        $this->authorize('update', $proyecto);

        $request->validate([
            'titulo' => 'required|string|max:255',
            'descripcion' => 'required|string',
            'tipo' => 'required|in:PIA,PA',
            'id_asignatura' => 'required|exists:asignatura,id_asignatura',
            'grupo' => 'required|string|max:10'
        ]);

        // Verificar que no exista otro proyecto con la misma asignatura y grupo
        $existeProyecto = Proyecto::where([
            'id_estudiante' => $proyecto->id_estudiante,
            'id_asignatura' => $request->id_asignatura,
            'grupo' => $request->grupo
        ])->where('id_proyecto', '!=', $proyecto->id_proyecto)
        ->exists();

        if ($existeProyecto) {
            return back()->withErrors([
                'general' => 'Ya tienes un proyecto registrado para esta asignatura y grupo.'
            ])->withInput();
        }

        $proyecto->update($request->all());

        return redirect()->route('proyecto.show', $proyecto)
            ->with('success', 'Proyecto actualizado exitosamente.');
    }

    public function destroy(Proyecto $proyecto)
    {
        $this->authorize('delete', $proyecto);
        $proyecto->delete();

        return redirect()->route('proyecto.index')
            ->with('success', 'Proyecto eliminado exitosamente.');
    }
}
