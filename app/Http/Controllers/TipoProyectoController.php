<?php

namespace App\Http\Controllers;

use App\Models\TipoProyecto;
use Illuminate\Http\Request;

class TipoProyectoController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index() {
        $tipos = TipoProyecto::all();
        return view('tipo_proyecto.index', compact('tipos'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('tipo_proyecto.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
          $request->validate(['nombre' => 'required']);
        TipoProyecto::create($request->all());
        return redirect()->route('tipo-proyecto.index')->with('success', 'Tipo de proyecto creado.');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
         $tipo = TipoProyecto::findOrFail($id);
        return view('tipo_proyecto.show', compact('tipo'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $tipo = TipoProyecto::findOrFail($id);
        return view('tipo_proyecto.edit', compact('tipo'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $request->validate(['nombre' => 'required']);
        TipoProyecto::findOrFail($id)->update($request->all());
        return redirect()->route('tipo-proyecto.index')->with('success', 'Tipo actualizado.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        TipoProyecto::destroy($id);
        return redirect()->route('tipo-proyecto.index')->with('success', 'Tipo eliminado.');
    }
}
