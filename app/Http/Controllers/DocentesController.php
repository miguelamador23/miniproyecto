<?php

namespace App\Http\Controllers;

use App\Models\Docentes;
use Illuminate\Http\Request;

class DocenteController extends Controller
{
    public function index()
    {
        $docentes = Docentes::all();
        return view('docentes.index', compact('docentes'));
    }

    public function create()
    {
        return view('docentes.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'nombre' => 'required|string|max:255',
            'apellido' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:docentes',
        ]);

        Docentes::create($request->all());

        return redirect()->route('docentes.index')
                        ->with('success','Docente creado exitosamente.');
    }

    public function show(Docentes $docente)
    {
        return view('docentes.show',compact('docente'));
    }

    public function edit(Docentes $docente)
    {
        return view('docentes.edit',compact('docente'));
    }

    public function update(Request $request, Docentes $docente)
    {
        $request->validate([
            'nombre' => 'required|string|max:255',
            'apellido' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:docentes,email,'.$docente->id,
        ]);

        $docente->update($request->all());

        return redirect()->route('docentes.index')
                        ->with('success','Docente actualizado exitosamente');
    }

    public function destroy(Docentes $docente)
    {
        $docente->delete();

        return redirect()->route('docentes.index')
                        ->with('success','Docente eliminado exitosamente');
    }
}