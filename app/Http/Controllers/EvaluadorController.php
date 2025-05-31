<?php

namespace App\Http\Controllers;

use App\Models\Evaluador;
use App\Models\Usuario;
use Illuminate\Http\Request;

class EvaluadorController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $evaluadores = Evaluador::all();
        return view('evaluadores.index', compact('evaluadores'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(Request $request)
    {
        $user_id = $request->query('user_id');
        return view('evaluador.create', compact('user_id'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'nombre' => 'required|string|max:255',
            'correo' => 'required|email|unique:evaluadores,correo',
            'documento' => 'required|string|unique:evaluadores,documento',
            'especialidad' => 'required|string|max:255',
            'user_id' => 'required|exists:usuarios,id'
        ]);

        $evaluador = Evaluador::create($request->all());
        
        // Actualizar el usuario con el ID del evaluador
        $usuario = Usuario::findOrFail($request->user_id);
        $usuario->update(['id_evaluador' => $evaluador->id]);

        return redirect()->route('home')->with('success', 'Registro de evaluador completado exitosamente.');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $evaluador = Evaluador::findOrFail($id);
        return view('evaluadores.show', compact('evaluador'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $evaluador = Evaluador::findOrFail($id);
        return view('evaluadores.edit', compact('evaluador'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
         $request->validate([
            'nombre' => 'required',
            'correo' => 'required|email|unique:evaluadores,correo,'.$id,
            'documento' => 'required|unique:evaluadores,documento,'.$id
        ]);
        Evaluador::findOrFail($id)->update($request->all());
        return redirect()->route('evaluadores.index')->with('success', 'Evaluador actualizado.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        Evaluador::destroy($id);
        return redirect()->route('evaluadores.index')->with('success', 'Evaluador eliminado.');
    }
}
