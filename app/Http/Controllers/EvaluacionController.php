<?php

namespace App\Http\Controllers;

use App\Models\Evaluacion;
use App\Models\Evaluador;
use App\Models\Proyecto;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class EvaluacionController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware(function ($request, $next) {
            if (Auth::user()->tipo_usuario !== 'evaluador') {
                return redirect('/dashboard')->with('error', 'Acceso no autorizado.');
            }
            return $next($request);
        });
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $evaluaciones = Evaluacion::with(['proyecto', 'evaluador'])->get();
        return view('evaluaciones.index', compact('evaluaciones'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create($id_proyecto)
    {
        $proyecto = Proyecto::with(['tipoProyecto', 'estudiantes', 'asignaturas'])->findOrFail($id_proyecto);
        $evaluador = Evaluador::where('correo', Auth::user()->email)->first();

        if (!$evaluador) {
            return redirect()->route('evaluador.create')
                ->with('error', 'Debe completar su perfil de evaluador primero.');
        }

        return view('evaluacion.create', compact('proyecto', 'evaluador'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request, $id_proyecto)
    {
        $request->validate([
            'calificacion' => 'required|numeric|min:0|max:5',
            'comentarios' => 'required|string|max:1000',
        ]);

        $proyecto = Proyecto::findOrFail($id_proyecto);
        $evaluador = Evaluador::where('correo', Auth::user()->email)->first();

        $evaluacion = new Evaluacion();
        $evaluacion->id_proyecto = $proyecto->id_proyecto;
        $evaluacion->id_evaluador = $evaluador->id_evaluador;
        $evaluacion->calificacion = $request->calificacion;
        $evaluacion->comentarios = $request->comentarios;
        $evaluacion->fecha_evaluacion = now();
        $evaluacion->save();

        return redirect()->route('evaluador.dashboard')
            ->with('success', 'Evaluación registrada exitosamente.');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $evaluacion = Evaluacion::findOrFail($id);
        $evaluador = Evaluador::where('correo', Auth::user()->email)->first();

        if ($evaluacion->id_evaluador !== $evaluador->id_evaluador) {
            return redirect()->route('evaluador.dashboard')
                ->with('error', 'No tiene permiso para editar esta evaluación.');
        }

        return view('evaluacion.edit', compact('evaluacion'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $evaluacion = Evaluacion::findOrFail($id);
        $evaluador = Evaluador::where('correo', Auth::user()->email)->first();

        if ($evaluacion->id_evaluador !== $evaluador->id_evaluador) {
            return redirect()->route('evaluador.dashboard')
                ->with('error', 'No tiene permiso para actualizar esta evaluación.');
        }

        $request->validate([
            'calificacion' => 'required|numeric|min:0|max:5',
            'comentarios' => 'required|string|max:1000',
        ]);

        $evaluacion->calificacion = $request->calificacion;
        $evaluacion->comentarios = $request->comentarios;
        $evaluacion->fecha_evaluacion = now();
        $evaluacion->save();

        return redirect()->route('evaluador.dashboard')
            ->with('success', 'Evaluación actualizada exitosamente.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $evaluacion = Evaluacion::findOrFail($id);
        $evaluador = Evaluador::where('correo', Auth::user()->email)->first();

        if ($evaluacion->id_evaluador !== $evaluador->id_evaluador) {
            return redirect()->route('evaluador.dashboard')
                ->with('error', 'No tiene permiso para eliminar esta evaluación.');
        }

        $evaluacion->delete();

        return redirect()->route('evaluador.dashboard')
            ->with('success', 'Evaluación eliminada exitosamente.');
    }
}
