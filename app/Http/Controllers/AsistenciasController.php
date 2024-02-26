<?php

namespace App\Http\Controllers;

use App\Models\Alumnos;
use App\Models\Asistencias;
use App\Models\Cursos;
use Illuminate\Http\Request;

class AsistenciaController extends Controller
{
    public function index()
    {
        $asistencias = Asistencias::all();
        return view('asistencias.index', compact('asistencias'));
    }

    public function create()
    {
        $alumnos = Alumnos::all();
        $cursos = Cursos::all();
        return view('asistencias.create', compact('alumnos', 'cursos'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'alumno_id' => 'required|exists:alumnos,id',
            'curso_id' => 'required|exists:cursos,id',
            'fecha' => 'required|date',
            'asistencia' => 'required|in:A,T,F',
        ]);

        Asistencias::create($request->all());

        return redirect()->route('asistencias.index')
                        ->with('success','Asistencia registrada exitosamente.');
    }

    public function show(Asistencias $asistencia)
    {
        return view('asistencias.show',compact('asistencia'));
    }

    public function edit(Asistencias $asistencia)
    {
        $alumnos = Alumnos::all();
        $cursos = Cursos::all();
        return view('asistencias.edit', compact('alumno', 'curso', 'asistencia'));
    }

    public function update(Request $request, Asistencias $asistencia)
    {
        $request->validate([
            'alumno_id' => 'required|exists:alumnos,id',
            'curso_id' => 'required|exists:cursos,id',
            'fecha' => 'required|date',
            'asistencia' => 'required|in:A,T,F',
        ]);

        $asistencia->update($request->all());

        return redirect()->route('asistencias.index')
                        ->with('success','Asistencia actualizada exitosamente');
    }

    public function destroy(Asistencias $asistencia)
    {
        $asistencia->delete();

        return redirect()->route('asistencias.index')
                        ->with('success','Asistencia eliminada exitosamente');
    }
}