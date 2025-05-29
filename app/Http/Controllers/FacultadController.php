<?php

namespace App\Http\Controllers;

use App\Models\Facultad;
use App\Models\Institucion;
use Illuminate\Http\Request;

class FacultadController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
          $facultades = Facultad::with('institucion')->get();
        return view('facultades.index', compact('facultades'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $instituciones = Institucion::all();
        return view('facultades.create', compact('instituciones'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'nombre' => 'required',
            'id_institucion' => 'required|exists:instituciones,id'
        ]);
        Facultad::create($request->all());
        return redirect()->route('facultades.index')->with('success', 'Facultad creada.');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $facultad = Facultad::with('institucion')->findOrFail($id);
        return view('facultades.show', compact('facultad'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $facultad = Facultad::findOrFail($id);
        $instituciones = Institucion::all();
        return view('facultades.edit', compact('facultad', 'instituciones'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $request->validate([
            'nombre' => 'required',
            'id_institucion' => 'required|exists:instituciones,id'
        ]);
        Facultad::findOrFail($id)->update($request->all());
        return redirect()->route('facultades.index')->with('success', 'Facultad actualizada.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        Facultad::destroy($id);
        return redirect()->route('facultades.index')->with('success', 'Facultad eliminada.');
    }
}
