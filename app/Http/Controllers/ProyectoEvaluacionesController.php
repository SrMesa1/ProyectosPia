<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Proyecto;
use App\Models\Evaluador;
use Illuminate\Support\Facades\DB;

class ProyectoEvaluacionesController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $registros = DB::table('proyecto_evaluaciones')
            ->join('proyectos', 'proyecto_evaluaciones.id_proyecto', '=', 'proyectos.id')
            ->join('evaluadores', 'proyecto_evaluaciones.id_evaluador', '=', 'evaluadores.id')
            ->select('proyecto_evaluaciones.*', 'proyectos.titulo', 'evaluadores.nombre')
            ->get();

        return view('proyecto_evaluaciones.index', compact('registros'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $proyectos = Proyecto::all();
        $evaluadores = Evaluador::all();
        return view('proyecto_evaluaciones.create', compact('proyectos', 'evaluadores'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'id_proyecto' => 'required|exists:proyectos,id',
            'id_evaluador' => 'required|exists:evaluadores,id',
            'criterio' => 'required|string|max:100',
            'resultado' => 'nullable|string'
        ]);
        DB::table('proyecto_evaluaciones')->insert($request->only('id_proyecto', 'id_evaluador', 'criterio', 'resultado'));
        return redirect()->route('proyecto-evaluaciones.index')->with('success', 'Evaluación por criterio registrada.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        DB::table('proyecto_evaluaciones')
            ->where('id_proyecto', $id_proyecto)
            ->where('id_evaluador', $id_evaluador)
            ->where('criterio', $criterio)
            ->delete();

        return redirect()->route('proyecto-evaluaciones.index')->with('success', 'Registro eliminado.');
    }
}
