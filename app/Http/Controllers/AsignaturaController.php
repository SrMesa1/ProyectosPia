<?php

namespace App\Http\Controllers;

use App\Models\Asignatura;
use App\Models\Programa;
use Illuminate\Http\Request;

class AsignaturaController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
          $asignaturas = Asignatura::with('programa')->get();
        return view('asignaturas.index', compact('asignaturas'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
           $programas = Programa::all();
        return view('asignaturas.create', compact('programas'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
          $request->validate([
            'nombre' => 'required',
            'id_programa' => 'required|exists:programas,id'
        ]);
        Asignatura::create($request->all());
        return redirect()->route('asignaturas.index')->with('success', 'Asignatura creada.');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $asignatura = Asignatura::with('programa')->findOrFail($id);
        return view('asignaturas.show', compact('asignatura'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $asignatura = Asignatura::findOrFail($id);
        $programas = Programa::all();
        return view('asignaturas.edit', compact('asignatura', 'programas'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $request->validate([
            'nombre' => 'required',
            'id_programa' => 'required|exists:programas,id'
        ]);
        Asignatura::findOrFail($id)->update($request->all());
        return redirect()->route('asignaturas.index')->with('success', 'Asignatura actualizada.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
         Asignatura::destroy($id);
        return redirect()->route('asignaturas.index')->with('success', 'Asignatura eliminada.');
    }
}
