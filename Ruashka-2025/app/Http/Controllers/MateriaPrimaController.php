<?php

namespace App\Http\Controllers;

use App\Models\MateriaPrima;
use App\Models\OrdenProduccion;
use Illuminate\Http\Request;

class MateriaPrimaController extends Controller
{
    // Historia 003: Gestión de inventario - Materia Prima
    public function index()
    {
        $materias = MateriaPrima::with('ordenProduccion')->get();
        return view('materia_prima.index', compact('materias'));
    }

    public function create()
    {
        $ordenes = OrdenProduccion::all();
        return view('materia_prima.create', compact('ordenes'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'Materia_Nombre' => 'required|string|max:50',
            'Materia_Descripcion' => 'required|string|max:500',
            'Materia_Unidad_Medida' => 'required|string|max:50',
            'Materia_Stock' => 'required|integer|min:0',
            'Ord_Produc_ID' => 'required|exists:orden_de_produccion,Ord_Produc_ID',
        ]);

        MateriaPrima::create($request->all());

        return redirect()->route('materia_prima.index')
            ->with('success', 'Materia prima registrada exitosamente');
    }

    public function show($id)
    {
        $materia = MateriaPrima::with('ordenProduccion')->findOrFail($id);
        return view('materia_prima.show', compact('materia'));
    }

    public function edit($id)
    {
        $materia = MateriaPrima::findOrFail($id);
        $ordenes = OrdenProduccion::all();
        return view('materia_prima.edit', compact('materia', 'ordenes'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'Materia_Nombre' => 'required|string|max:50',
            'Materia_Descripcion' => 'required|string|max:500',
            'Materia_Unidad_Medida' => 'required|string|max:50',
            'Materia_Stock' => 'required|integer|min:0',
            'Ord_Produc_ID' => 'required|exists:orden_de_produccion,Ord_Produc_ID',
        ]);

        $materia = MateriaPrima::findOrFail($id);
        $materia->update($request->all());

        return redirect()->route('materia_prima.index')
            ->with('success', 'Materia prima actualizada exitosamente');
    }

    public function destroy($id)
    {
        $materia = MateriaPrima::findOrFail($id);
        $materia->delete();

        return redirect()->route('materia_prima.index')
            ->with('success', 'Materia prima eliminada exitosamente');
    }
}