<?php

namespace App\Http\Controllers;

use App\Models\Evaluacion;
use App\Models\Proyecto;
use App\Models\Evaluador;
use Illuminate\Http\Request;

class EvaluacionController extends Controller
{
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
    public function create()
    {
        $proyectos = Proyecto::all();
        $evaluadores = Evaluador::all();
        return view('evaluaciones.create', compact('proyectos', 'evaluadores'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'id_proyecto' => 'required|exists:proyectos,id',
            'id_evaluador' => 'required|exists:evaluadores,id',
            'calificacion' => 'nullable|numeric|min:0|max:100',
            'observaciones' => 'nullable|string',
            'fecha_evaluacion' => 'nullable|date'
        ]);
        Evaluacion::create($request->all());
        return redirect()->route('evaluaciones.index')->with('success', 'Evaluación registrada.');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $evaluacion = Evaluacion::findOrFail($id);
        $proyectos = Proyecto::all();
        $evaluadores = Evaluador::all();
        return view('evaluaciones.edit', compact('evaluacion', 'proyectos', 'evaluadores'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
         $request->validate([
            'id_proyecto' => 'required|exists:proyectos,id',
            'id_evaluador' => 'required|exists:evaluadores,id',
            'calificacion' => 'nullable|numeric|min:0|max:100',
            'observaciones' => 'nullable|string',
            'fecha_evaluacion' => 'nullable|date'
        ]);
        Evaluacion::findOrFail($id)->update($request->all());
        return redirect()->route('evaluaciones.index')->with('success', 'Evaluación actualizada.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
          Evaluacion::destroy($id);
        return redirect()->route('evaluaciones.index')->with('success', 'Evaluación eliminada.');
    }
}
