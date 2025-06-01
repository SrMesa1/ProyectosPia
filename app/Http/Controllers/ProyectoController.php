<?php

namespace App\Http\Controllers;

use App\Models\Proyecto;
use App\Models\Asignatura;
use App\Models\TipoProyecto;
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

        if ($user->id_tipo_usuario === 1) { // Estudiante
            $proyectos = Proyecto::where('id_estudiante', $user->estudiante->id_estudiante)
                ->with(['asignatura', 'tipoProyecto'])
                ->get();
        } elseif ($user->id_tipo_usuario === 2) { // Docente
            $asignaturas = $user->docente->asignaturas()->pluck('id_asignatura');
            $proyectos = Proyecto::whereIn('id_asignatura', $asignaturas)
                ->with(['estudiante', 'asignatura', 'tipoProyecto'])
                ->get();
        } elseif ($user->id_tipo_usuario === 3) { // Evaluador
            $proyectos = Proyecto::with(['estudiante', 'asignatura', 'tipoProyecto'])->get();
        }

        return view('proyecto.index', compact('proyectos'));
    }

    public function create()
    {
        // Verificar que el usuario es un estudiante
        if (Auth::user()->id_tipo_usuario !== 1) {
            return redirect()->route('dashboard')
                ->with('error', 'Solo los estudiantes pueden crear proyectos.');
        }

        // Obtener todas las asignaturas y tipos de proyecto disponibles
        $asignaturas = Asignatura::all();
        $tipos_proyecto = TipoProyecto::all();
        
        return view('proyecto.create', compact('asignaturas', 'tipos_proyecto'));
    }

    public function store(Request $request)
    {
        // Verificar que el usuario es un estudiante
        if (Auth::user()->id_tipo_usuario !== 1) {
            return redirect()->route('dashboard')
                ->with('error', 'Solo los estudiantes pueden crear proyectos.');
        }

        $request->validate([
            'titulo' => 'required|string|max:255',
            'descripcion' => 'required|string',
            'id_tipo_proyecto' => 'required|exists:tipo_proyecto,id_tipo_proyecto',
            'id_asignatura' => 'required|exists:asignatura,id_asignatura',
            'grupo' => 'required|string|max:10',
            'fecha_inicio' => 'required|date',
            'fecha_fin' => 'required|date|after:fecha_inicio'
        ]);

        // Verificar duración del proyecto según el tipo
        $tipo_proyecto = TipoProyecto::findOrFail($request->id_tipo_proyecto);
        $duracion_semanas = ceil(
            (strtotime($request->fecha_fin) - strtotime($request->fecha_inicio)) / (60 * 60 * 24 * 7)
        );

        if ($duracion_semanas < $tipo_proyecto->duracion_minima || 
            $duracion_semanas > $tipo_proyecto->duracion_maxima) {
            return back()->withErrors([
                'fecha_fin' => "La duración del proyecto debe estar entre {$tipo_proyecto->duracion_minima} y {$tipo_proyecto->duracion_maxima} semanas."
            ])->withInput();
        }

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
        $proyecto->id_tipo_proyecto = $request->id_tipo_proyecto;
        $proyecto->fecha_inicio = $request->fecha_inicio;
        $proyecto->fecha_fin = $request->fecha_fin;
        $proyecto->id_estudiante = Auth::user()->estudiante->id_estudiante;
        $proyecto->id_asignatura = $request->id_asignatura;
        $proyecto->grupo = $request->grupo;
        $proyecto->estado = 'pendiente';
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
        $tipos_proyecto = TipoProyecto::all();
        return view('proyecto.edit', compact('proyecto', 'asignaturas', 'tipos_proyecto'));
    }

    public function update(Request $request, Proyecto $proyecto)
    {
        $this->authorize('update', $proyecto);

        $request->validate([
            'titulo' => 'required|string|max:255',
            'descripcion' => 'required|string',
            'id_tipo_proyecto' => 'required|exists:tipo_proyecto,id_tipo_proyecto',
            'id_asignatura' => 'required|exists:asignatura,id_asignatura',
            'grupo' => 'required|string|max:10',
            'fecha_inicio' => 'required|date',
            'fecha_fin' => 'required|date|after:fecha_inicio',
            'estado' => 'required|in:pendiente,en_curso,completado,cancelado'
        ]);

        // Verificar duración del proyecto según el tipo
        $tipo_proyecto = TipoProyecto::findOrFail($request->id_tipo_proyecto);
        $duracion_semanas = ceil(
            (strtotime($request->fecha_fin) - strtotime($request->fecha_inicio)) / (60 * 60 * 24 * 7)
        );

        if ($duracion_semanas < $tipo_proyecto->duracion_minima || 
            $duracion_semanas > $tipo_proyecto->duracion_maxima) {
            return back()->withErrors([
                'fecha_fin' => "La duración del proyecto debe estar entre {$tipo_proyecto->duracion_minima} y {$tipo_proyecto->duracion_maxima} semanas."
            ])->withInput();
        }

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
