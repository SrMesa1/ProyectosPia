<?php

namespace App\Http\Controllers;

use App\Models\Proyecto;
use App\Models\Estudiante;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ProyectoEstudiantesController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $registros = DB::table('proyecto_estudiantes')
            ->join('proyectos', 'proyecto_estudiantes.id_proyecto', '=', 'proyectos.id')
            ->join('estudiantes', 'proyecto_estudiantes.id_estudiante', '=', 'estudiantes.id')
            ->select('proyecto_estudiantes.*', 'proyectos.titulo', 'estudiantes.nombre')
            ->get();

        return view('proyecto_estudiantes.index', compact('registros'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $proyectos = Proyecto::all();
        $estudiantes = Estudiante::all();
        return view('proyecto_estudiantes.create', compact('proyectos', 'estudiantes'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'id_proyecto' => 'required|exists:proyectos,id',
            'id_estudiante' => 'required|exists:estudiantes,id'
        ]);

        DB::table('proyecto_estudiantes')->insert($request->only('id_proyecto', 'id_estudiante'));
        return redirect()->route('proyecto-estudiantes.index')->with('success', 'Registro guardado.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        DB::table('proyecto_estudiantes')
            ->where('id_proyecto', $id_proyecto)
            ->where('id_estudiante', $id_estudiante)
            ->delete();

        return redirect()->route('proyecto-estudiantes.index')->with('success', 'Registro eliminado.');
    }
}
