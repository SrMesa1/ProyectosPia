<?php

namespace App\Http\Controllers;

use App\Models\Estudiante;
use App\Models\Programa;
use Illuminate\Http\Request;

class EstudianteController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $estudiantes = Estudiante::with('programa')->get();
        return view('estudiantes.index', compact('estudiantes'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $programas = Programa::all();
        return view('estudiantes.create', compact('programas'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'nombre' => 'required',
            'correo' => 'required|email|unique:estudiantes',
            'documento' => 'required|unique:estudiantes',
            'id_programa' => 'required|exists:programas,id'
        ]);
        Estudiante::create($request->all());
        return redirect()->route('estudiantes.index')->with('success', 'Estudiante creado.');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $estudiante = Estudiante::with('programa')->findOrFail($id);
        return view('estudiantes.show', compact('estudiante'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $estudiante = Estudiante::findOrFail($id);
        $programas = Programa::all();
        return view('estudiantes.edit', compact('estudiante', 'programas'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $request->validate([
            'nombre' => 'required',
            'correo' => 'required|email|unique:estudiantes,correo,'.$id,
            'documento' => 'required|unique:estudiantes,documento,'.$id,
            'id_programa' => 'required|exists:programas,id'
        ]);
        Estudiante::findOrFail($id)->update($request->all());
        return redirect()->route('estudiantes.index')->with('success', 'Estudiante actualizado.');

    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        Estudiante::destroy($id);
        return redirect()->route('estudiantes.index')->with('success', 'Estudiante eliminado.');
    }
}
