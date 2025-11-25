<?php

namespace App\Http\Controllers;

use App\Models\OrdenProduccion;
use Illuminate\Http\Request;

class OrdenProduccionController extends Controller
{
    // Mostrar todas las órdenes de producción (Historia 001 y 002)
    public function index()
    {
        $ordenes = OrdenProduccion::orderBy('Ord_Prod_Fecha_Inicio', 'desc')->get();
        return view('orden_produccion.index', compact('ordenes'));
    }

    // Mostrar formulario para crear nueva orden (Historia 001)
    public function create()
    {
        return view('orden_produccion.create');
    }

    // Guardar nueva orden de producción
    public function store(Request $request)
    {
        $request->validate([
            'Ord_Prod_Fecha_Inicio' => 'required|date',
            'Ord_Prod_Fecha_Final' => 'required|date|after_or_equal:Ord_Prod_Fecha_Inicio',
            'Ord_Prod_Cantidad' => 'required|integer|min:1',
            'Ord_Prod_Tipo_Producto' => 'required|string|max:100',
            'Ord_Prod_Estado' => 'required|string',
        ]);

        OrdenProduccion::create($request->all());

        return redirect()->route('orden_produccion.index')
            ->with('success', 'Orden de producción creada exitosamente');
    }

    // Mostrar detalles de una orden específica
    public function show($id)
    {
        $orden = OrdenProduccion::with('materiasPrimas')->findOrFail($id);
        return view('orden_produccion.show', compact('orden'));
    }

    // Mostrar formulario para editar orden (Historia 002 - cambiar estado)
    public function edit($id)
    {
        $orden = OrdenProduccion::findOrFail($id);
        return view('orden_produccion.edit', compact('orden'));
    }

    // Actualizar orden de producción (Historia 002 - cambiar estado)
    public function update(Request $request, $id)
    {
        $request->validate([
            'Ord_Prod_Fecha_Inicio' => 'required|date',
            'Ord_Prod_Fecha_Final' => 'required|date|after_or_equal:Ord_Prod_Fecha_Inicio',
            'Ord_Prod_Cantidad' => 'required|integer|min:1',
            'Ord_Prod_Tipo_Producto' => 'required|string|max:100',
            'Ord_Prod_Estado' => 'required|string',
        ]);

        $orden = OrdenProduccion::findOrFail($id);
        $orden->update($request->all());

        return redirect()->route('orden_produccion.index')
            ->with('success', 'Orden de producción actualizada exitosamente');
    }

    // Eliminar orden de producción
    public function destroy($id)
    {
        $orden = OrdenProduccion::findOrFail($id);
        $orden->delete();

        return redirect()->route('orden_produccion.index')
            ->with('success', 'Orden de producción eliminada exitosamente');
    }
}