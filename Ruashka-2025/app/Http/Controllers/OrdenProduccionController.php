<?php

namespace App\Http\Controllers;

use App\Models\OrdenProduccion;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class OrdenProduccionController extends Controller
{
    // Mostrar todas las órdenes con filtros y estadísticas
    public function index(Request $request)
    {
        // Estadísticas
        $estadisticas = [
            'total' => OrdenProduccion::count(),
            'pendientes' => OrdenProduccion::where('Ord_Prod_Estado', 'Pendiente')->count(),
            'en_proceso' => OrdenProduccion::where('Ord_Prod_Estado', 'En Proceso')->count(),
            'completadas' => OrdenProduccion::where('Ord_Prod_Estado', 'Completado')->count(),
            'canceladas' => OrdenProduccion::where('Ord_Prod_Estado', 'Cancelado')->count(),
        ];

        // Query con filtros
        $ordenes = OrdenProduccion::query()
            ->estado($request->estado)
            ->tipoProducto($request->tipo_producto)
            ->buscar($request->buscar)
            ->when($request->ordenar, function($q) use ($request) {
                if ($request->ordenar == 'fecha_asc') {
                    $q->orderBy('Ord_Prod_Fecha_Inicio', 'asc');
                } elseif ($request->ordenar == 'fecha_desc') {
                    $q->orderBy('Ord_Prod_Fecha_Inicio', 'desc');
                } elseif ($request->ordenar == 'cantidad_asc') {
                    $q->orderBy('Ord_Prod_Cantidad', 'asc');
                } elseif ($request->ordenar == 'cantidad_desc') {
                    $q->orderBy('Ord_Prod_Cantidad', 'desc');
                } elseif ($request->ordenar == 'prioridad') {
                    $q->orderBy('Ord_Prod_Prioridad', 'desc');
                }
            }, function($q) {
                $q->orderBy('Ord_Prod_Fecha_Inicio', 'desc');
            })
            ->paginate(10);

        return view('orden_produccion.index', compact('ordenes', 'estadisticas'));
    }

    public function create()
    {
        return view('orden_produccion.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'Ord_Prod_Fecha_Inicio' => 'required|date',
            'Ord_Prod_Fecha_Final' => 'required|date|after_or_equal:Ord_Prod_Fecha_Inicio',
            'Ord_Prod_Cantidad' => 'required|integer|min:1',
            'Ord_Prod_Tipo_Producto' => 'required|string|max:100',
            'Ord_Prod_Cliente' => 'nullable|string|max:100',
            'Ord_Prod_Costo_Estimado' => 'nullable|numeric|min:0',
            'Ord_Prod_Estado' => 'required|string',
            'Ord_Prod_Prioridad' => 'required|integer|between:1,3',
            'Ord_Prod_Observaciones' => 'nullable|string',
        ]);

        OrdenProduccion::create($request->all());

        return redirect()->route('orden_produccion.index')
            ->with('success', 'Orden de producción creada exitosamente');
    }

    public function show($id)
    {
        $orden = OrdenProduccion::with('materiasPrimas')->findOrFail($id);
        return view('orden_produccion.show', compact('orden'));
    }

    public function edit($id)
    {
        $orden = OrdenProduccion::findOrFail($id);
        return view('orden_produccion.edit', compact('orden'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'Ord_Prod_Fecha_Inicio' => 'required|date',
            'Ord_Prod_Fecha_Final' => 'required|date|after_or_equal:Ord_Prod_Fecha_Inicio',
            'Ord_Prod_Cantidad' => 'required|integer|min:1',
            'Ord_Prod_Tipo_Producto' => 'required|string|max:100',
            'Ord_Prod_Cliente' => 'nullable|string|max:100',
            'Ord_Prod_Costo_Estimado' => 'nullable|numeric|min:0',
            'Ord_Prod_Estado' => 'required|string',
            'Ord_Prod_Prioridad' => 'required|integer|between:1,3',
            'Ord_Prod_Observaciones' => 'nullable|string',
        ]);

        $orden = OrdenProduccion::findOrFail($id);
        $orden->update($request->all());

        return redirect()->route('orden_produccion.index')
            ->with('success', 'Orden de producción actualizada exitosamente');
    }

    public function destroy($id)
    {
        $orden = OrdenProduccion::findOrFail($id);
        $orden->delete();

        return redirect()->route('orden_produccion.index')
            ->with('success', 'Orden de producción eliminada exitosamente');
    }

    // Acción en lote para cambiar estados
    public function cambiarEstadoLote(Request $request)
    {
        $request->validate([
            'ordenes' => 'required|array',
            'nuevo_estado' => 'required|string',
        ]);

        OrdenProduccion::whereIn('Ord_Produc_ID', $request->ordenes)
            ->update(['Ord_Prod_Estado' => $request->nuevo_estado]);

        return redirect()->route('orden_produccion.index')
            ->with('success', count($request->ordenes) . ' órdenes actualizadas');
    }

    // Exportar a PDF
    public function exportarPDF()
    {
        // Implementación básica (requiere biblioteca como DomPDF)
        return response()->download(storage_path('app/ordenes.pdf'));
    }
}