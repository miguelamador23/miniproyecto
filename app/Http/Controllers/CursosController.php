<?php

namespace App\Http\Controllers;

use App\Models\Cursos;
use Illuminate\Http\Request;

class CursoController extends Controller
{
    public function index()
    {
        $cursos = Cursos::all();
        return view('cursos.index', compact('cursos'));
    }

    public function create()
    {
        return view('cursos.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'nombre' => 'required|string|max:255',
            'descripcion' => 'nullable|string',
        ]);

        Cursos::create($request->all());

        return redirect()->route('cursos.index')
                        ->with('success','Curso creado exitosamente.');
    }

    public function show(Cursos $curso)
    {
        return view('cursos.show',compact('curso'));
    }

    public function edit(Cursos $curso)
    {
        return view('cursos.edit',compact('curso'));
    }

    public function update(Request $request, Cursos $curso)
    {
        $request->validate([
            'nombre' => 'required|string|max:255',
            'descripcion' => 'nullable|string',
        ]);

        $curso->update($request->all());

        return redirect()->route('cursos.index')
                        ->with('success','Curso actualizado exitosamente');
    }

    public function destroy(Cursos $curso)
    {
        $curso->delete();

        return redirect()->route('cursos.index')
                        ->with('success','Curso eliminado exitosamente');
    }
}