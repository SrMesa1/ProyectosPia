<?php

namespace App\Http\Controllers;

use App\Models\Departamento;
use App\Models\Facultad;
use Illuminate\Http\Request;

class DepartamentoController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
         $departamentos = Departamento::with('facultad')->get();
        return view('departamentos.index', compact('departamentos'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
         $facultades = Facultad::all();
        return view('departamentos.create', compact('facultades'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
         $request->validate([
            'nombre' => 'required',
            'id_facultad' => 'required|exists:facultads,id'
        ]);
        Departamento::create($request->all());
        return redirect()->route('departamentos.index')->with('success', 'Departamento creado.');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
         $departamento = Departamento::with('facultad')->findOrFail($id);
        return view('departamentos.show', compact('departamento'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $departamento = Departamento::findOrFail($id);
        $facultades = Facultad::all();
        return view('departamentos.edit', compact('departamento', 'facultades'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $request->validate([
            'nombre' => 'required',
            'id_facultad' => 'required|exists:facultads,id'
        ]);
        Departamento::findOrFail($id)->update($request->all());
        return redirect()->route('departamentos.index')->with('success', 'Departamento actualizado.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        Departamento::destroy($id);
        return redirect()->route('departamentos.index')->with('success', 'Departamento eliminado.');
    }
}
