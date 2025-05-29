<?php

namespace App\Http\Controllers;

use App\Models\Proyecto;
use App\Models\TipoProyecto;
use Illuminate\Http\Request;

class ProyectoController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $proyectos = Proyecto::with('tipoProyecto')->get();
        return view('proyectos.index', compact('proyectos'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $tipos = TipoProyecto::all();
        return view('proyectos.create', compact('tipos'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'titulo' => 'required',
            'descripcion' => 'nullable',
            'id_tipo_proyecto' => 'required|exists:tipo_proyectos,id'
        ]);
        Proyecto::create($request->all());
        return redirect()->route('proyectos.index')->with('success', 'Proyecto creado.');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $proyecto = Proyecto::with('tipoProyecto')->findOrFail($id);
        return view('proyectos.show', compact('proyecto'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $proyecto = Proyecto::findOrFail($id);
        $tipos = TipoProyecto::all();
        return view('proyectos.edit', compact('proyecto', 'tipos'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $request->validate([
            'titulo' => 'required',
            'descripcion' => 'nullable',
            'id_tipo_proyecto' => 'required|exists:tipo_proyectos,id'
        ]);
        Proyecto::findOrFail($id)->update($request->all());
        return redirect()->route('proyectos.index')->with('success', 'Proyecto actualizado.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        Proyecto::destroy($id);
        return redirect()->route('proyectos.index')->with('success', 'Proyecto eliminado.');
    }
}
