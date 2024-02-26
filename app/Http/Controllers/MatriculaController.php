<?php

namespace App\Http\Controllers;

use App\Models\Matricula;
use App\Models\Alumnos;
use App\Models\Cursos;
use Illuminate\Http\Request;

class MatriculaController extends Controller
{
    public function index()
    {
        $matriculas = Matricula::all();
        return view('matriculas.index', compact('matriculas'));
    }

    public function create()
    {
        $alumnos = Alumnos::all();
        $cursos = Cursos::all();
        return view('matriculas.create', compact('alumnos', 'cursos'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'alumno_id' => 'required|exists:alumnos,id',
            'curso_id' => 'required|exists:cursos,id',
        ]);

        Matricula::create($request->all());

        return redirect()->route('matriculas.index')
            ->with('success', 'Matrícula registrada exitosamente.');
    }

    public function show(Matricula $matricula)
    {
        return view('matriculas.show', compact('matricula'));
    }

    public function edit(Matricula $matricula)
    {
        $alumnos = Alumnos::all();
        $cursos = Cursos::all();
        return view('matriculas.edit', compact('alumno', 'curso', 'matricula'));
    }

    public function update(Request $request, Matricula $matricula)
    {
        $request->validate([
            'alumno_id' => 'required|exists:alumnos,id',
            'curso_id' => 'required|exists:cursos,id',
        ]);

        $matricula->update($request->all());

        return redirect()->route('matriculas.index')
            ->with('success', 'Matrícula actualizada exitosamente');
    }

    public function destroy(Matricula $matricula)
    {
        $matricula->delete();

        return redirect()->route('matriculas.index')
            ->with('success', 'Matrícula eliminada exitosamente');
    }
}
