<?php

namespace App\Http\Controllers;

use App\Models\Institucion;
use Illuminate\Http\Request;

class InstitucionController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $instituciones = Institucion::all();
        return view('instituciones.index', compact('instituciones'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('instituciones.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate(['nombre' => 'required']);
        Institucion::create($request->all());
        return redirect()->route('instituciones.index')->with('success', 'Institución creada.');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $institucion = Institucion::findOrFail($id);
        return view('instituciones.show', compact('institucion'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $institucion = Institucion::findOrFail($id);
        return view('instituciones.edit', compact('institucion'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $request->validate(['nombre' => 'required']);
        Institucion::findOrFail($id)->update($request->all());
        return redirect()->route('instituciones.index')->with('success', 'Institución actualizada.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        Institucion::destroy($id);
        return redirect()->route('instituciones.index')->with('success', 'Institución eliminada.');
    }
}
