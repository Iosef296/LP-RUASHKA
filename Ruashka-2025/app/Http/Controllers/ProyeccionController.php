<?php

namespace App\Http\Controllers;

use App\Models\Proyeccion;
use Illuminate\Http\Request;

class ProyeccionController extends Controller
{
    // Historia 001: Planificación de producción
    public function index()
    {
        $proyecciones = Proyeccion::orderBy('created_at', 'desc')->get();
        return view('proyecciones.index', compact('proyecciones'));
    }

    public function create()
    {
        return view('proyecciones.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'Proyec_Nombre' => 'required|string|max:50',
            'Proyec_Descripcion' => 'required|string|max:100',
            'Proyec_tipo' => 'required|string|max:50',
        ]);

        Proyeccion::create($request->all());

        return redirect()->route('proyecciones.index')
            ->with('success', 'Proyección creada exitosamente');
    }

    public function show($id)
    {
        $proyeccion = Proyeccion::findOrFail($id);
        return view('proyecciones.show', compact('proyeccion'));
    }

    public function edit($id)
    {
        $proyeccion = Proyeccion::findOrFail($id);
        return view('proyecciones.edit', compact('proyeccion'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'Proyec_Nombre' => 'required|string|max:50',
            'Proyec_Descripcion' => 'required|string|max:100',
            'Proyec_tipo' => 'required|string|max:50',
        ]);

        $proyeccion = Proyeccion::findOrFail($id);
        $proyeccion->update($request->all());

        return redirect()->route('proyecciones.index')
            ->with('success', 'Proyección actualizada exitosamente');
    }

    public function destroy($id)
    {
        $proyeccion = Proyeccion::findOrFail($id);
        $proyeccion->delete();

        return redirect()->route('proyecciones.index')
            ->with('success', 'Proyección eliminada exitosamente');
    }
}