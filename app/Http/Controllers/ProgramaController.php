<?php

namespace App\Http\Controllers;

use App\Models\Programa;
use App\Models\Departamento;
use Illuminate\Http\Request;

class ProgramaController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
         $programas = Programa::with('departamento')->get();
        return view('programas.index', compact('programas'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $departamentos = Departamento::all();
        return view('programas.create', compact('departamentos'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'nombre' => 'required',
            'id_departamento' => 'required|exists:departamentos,id'
        ]);
        Programa::create($request->all());
        return redirect()->route('programas.index')->with('success', 'Programa creado.');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $programa = Programa::with('departamento')->findOrFail($id);
        return view('programas.show', compact('programa'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $programa = Programa::findOrFail($id);
        $departamentos = Departamento::all();
        return view('programas.edit', compact('programa', 'departamentos'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
         $request->validate([
            'nombre' => 'required',
            'id_departamento' => 'required|exists:departamentos,id'
        ]);
        Programa::findOrFail($id)->update($request->all());
        return redirect()->route('programas.index')->with('success', 'Programa actualizado.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        Programa::destroy($id);
        return redirect()->route('programas.index')->with('success', 'Programa eliminado.');
    }
}
