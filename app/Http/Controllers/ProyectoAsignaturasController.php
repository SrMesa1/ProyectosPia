<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Proyecto;
use App\Models\Asignatura;
use App\Models\Docente;
use Illuminate\Support\Facades\DB;

class ProyectoAsignaturasController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $registros = DB::table('proyecto_asignaturas')
            ->join('proyectos', 'proyecto_asignaturas.id_proyecto', '=', 'proyectos.id')
            ->join('asignaturas', 'proyecto_asignaturas.id_asignatura', '=', 'asignaturas.id')
            ->join('docentes', 'proyecto_asignaturas.id_docente', '=', 'docentes.id')
            ->select('proyecto_asignaturas.*', 'proyectos.titulo', 'asignaturas.nombre as asignatura', 'docentes.nombre as docente')
            ->get();

        return view('proyecto_asignaturas.index', compact('registros'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $proyectos = Proyecto::all();
        $asignaturas = Asignatura::all();
        $docentes = Docente::all();
        return view('proyecto_asignaturas.create', compact('proyectos', 'asignaturas', 'docentes'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'id_proyecto' => 'required|exists:proyectos,id',
            'id_asignatura' => 'required|exists:asignaturas,id',
            'grupo' => 'nullable|string',
            'id_docente' => 'required|exists:docentes,id'
        ]);

        DB::table('proyecto_asignaturas')->insert($request->only('id_proyecto', 'id_asignatura', 'grupo', 'id_docente'));
        return redirect()->route('proyecto-asignaturas.index')->with('success', 'Registro guardado.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        DB::table('proyecto_asignaturas')
            ->where('id_proyecto', $id_proyecto)
            ->where('id_asignatura', $id_asignatura)
            ->delete();

        return redirect()->route('proyecto-asignaturas.index')->with('success', 'Registro eliminado.');
    }
}
