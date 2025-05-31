<?php

namespace App\Http\Controllers;

use App\Models\Docente;
use App\Models\Usuario;
use App\Models\Departamento;
use Illuminate\Http\Request;

class DocenteController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $docentes = Docente::with('departamento')->get();
        return view('docentes.index', compact('docentes'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(Request $request)
    {
        $user_id = $request->query('user_id');
        $departamentos = Departamento::all();
        return view('docente.create', compact('user_id', 'departamentos'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'nombre' => 'required|string|max:255',
            'correo' => 'required|email|unique:docentes,correo',
            'documento' => 'required|string|unique:docentes,documento',
            'id_departamento' => 'required|exists:departamentos,id',
            'user_id' => 'required|exists:usuarios,id'
        ]);

        $docente = Docente::create($request->all());
        
        // Actualizar el usuario con el ID del docente
        $usuario = Usuario::findOrFail($request->user_id);
        $usuario->update(['id_docente' => $docente->id]);

        return redirect()->route('home')->with('success', 'Registro de docente completado exitosamente.');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $docente = Docente::with('departamento')->findOrFail($id);
        return view('docentes.show', compact('docente'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $docente = Docente::findOrFail($id);
        $departamentos = Departamento::all();
        return view('docentes.edit', compact('docente', 'departamentos'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
         $request->validate([
            'nombre' => 'required',
            'correo' => 'required|email|unique:docentes,correo,'.$id,
            'documento' => 'required|unique:docentes,documento,'.$id,
            'id_departamento' => 'required|exists:departamentos,id'
        ]);
        Docente::findOrFail($id)->update($request->all());
        return redirect()->route('docentes.index')->with('success', 'Docente actualizado.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        Docente::destroy($id);
        return redirect()->route('docentes.index')->with('success', 'Docente eliminado.');
    }
}
