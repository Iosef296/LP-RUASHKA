<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <x-layouts.app :title="__('Movimientos de Inventario')">
    <div class="py-8">
        <div class="mx-auto max-w-7xl sm:px-6 lg:px-8">
            
            <!-- Header con título y botón -->
            <div class="mb-6 flex items-center justify-between">
                <div>
                    <h2 class="text-3xl font-bold text-gray-800 dark:text-gray-100">
                        Movimientos de Inventario
                    </h2>
                    <p class="mt-1 text-sm text-gray-600 dark:text-gray-400">
                        Registro de entradas y salidas de productos
                    </p>
                </div>
                <a href="{{ route('movimiento_inventario.create') }}" 
                   class="inline-flex items-center gap-2 rounded-xl bg-gradient-to-r from-amber-600 to-orange-600 px-6 py-3 font-semibold text-white shadow-lg transition-all duration-300 hover:scale-105 hover:shadow-xl">
                    <svg class="h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/>
                    </svg>
                    Nuevo Movimiento
                </a>
            </div>
            
            @if (session('success'))
                <div class="mb-6 animate-fade-in-down">
                    <div class="flex items-center gap-3 rounded-xl bg-gradient-to-r from-green-500 to-emerald-500 p-4 text-white shadow-lg">
                        <svg class="h-6 w-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/>
                        </svg>
                        <span class="font-medium">{{ session('success') }}</span>
                    </div>
                </div>
            @endif

            <div class="overflow-hidden rounded-2xl bg-white shadow-2xl dark:bg-gray-800">
                
                <div class="border-b border-gray-200 bg-gradient-to-r from-gray-50 to-gray-100 px-6 py-5 dark:border-gray-700 dark:from-gray-700 dark:to-gray-800">
                    <div class="flex items-center justify-between">
                        <div>
                            <h3 class="text-xl font-bold text-gray-800 dark:text-gray-100">Listado de Movimientos</h3>
                            <p class="mt-1 text-sm text-gray-600 dark:text-gray-400">Gestiona todos los movimientos de inventario</p>
                        </div>
                    </div>
                </div>

                <div class="overflow-x-auto">
                    <table class="min-w-full divide-y divide-gray-200 dark:divide-gray-700">
                        <thead>
                            <tr class="bg-gradient-to-r from-amber-50 to-orange-50 dark:from-gray-700 dark:to-gray-800">
                                <th class="px-6 py-4 text-left text-xs font-bold uppercase tracking-wider text-amber-600 dark:text-amber-400">ID</th>
                                <th class="px-6 py-4 text-left text-xs font-bold uppercase tracking-wider text-amber-600 dark:text-amber-400">Fecha</th>
                                <th class="px-6 py-4 text-left text-xs font-bold uppercase tracking-wider text-amber-600 dark:text-amber-400">Producto</th>
                                <th class="px-6 py-4 text-left text-xs font-bold uppercase tracking-wider text-amber-600 dark:text-amber-400">Tipo</th>
                                <th class="px-6 py-4 text-left text-xs font-bold uppercase tracking-wider text-amber-600 dark:text-amber-400">Motivo</th>
                                <th class="px-6 py-4 text-left text-xs font-bold uppercase tracking-wider text-amber-600 dark:text-amber-400">Responsable</th>
                                <th class="px-6 py-4 text-center text-xs font-bold uppercase tracking-wider text-amber-600 dark:text-amber-400">Acciones</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-gray-200 bg-white dark:divide-gray-700 dark:bg-gray-800">
                            @forelse ($movimientos as $movimiento)
                                <tr class="transition-all duration-200 hover:bg-amber-50 dark:hover:bg-gray-700">
                                    <td class="whitespace-nowrap px-6 py-4">
                                        <span class="inline-flex h-8 w-8 items-center justify-center rounded-full bg-amber-100 text-xs font-bold text-amber-600 dark:bg-amber-900 dark:text-amber-300">
                                            {{ $movimiento->Movimiento_Inven_ID }}
                                        </span>
                                    </td>
                                    <td class="whitespace-nowrap px-6 py-4">
                                        <div class="flex items-center gap-2">
                                            <svg class="h-4 w-4 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                                            </svg>
                                            <span class="text-sm text-gray-700 dark:text-gray-300">{{ \Carbon\Carbon::parse($movimiento->Movimiento_Inventario_Fecha)->format('d/m/Y') }}</span>
                                        </div>
                                    </td>
                                    <td class="px-6 py-4">
                                        @if($movimiento->producto)
                                            <p class="font-semibold text-gray-900 dark:text-gray-100">{{ $movimiento->producto->Producto_Nombre }}</p>
                                            <p class="text-xs text-gray-500 dark:text-gray-400">ID: {{ $movimiento->Producto_ID }}</p>
                                        @else
                                            <span class="text-gray-400">Sin producto</span>
                                        @endif
                                    </td>
                                    <td class="whitespace-nowrap px-6 py-4">
                                        @php
                                            $tipos = [
                                                'E' => ['bg' => 'bg-green-100 dark:bg-green-900', 'text' => 'text-green-800 dark:text-green-200', 'label' => 'Entrada'],
                                                'S' => ['bg' => 'bg-red-100 dark:bg-red-900', 'text' => 'text-red-800 dark:text-red-200', 'label' => 'Salida'],
                                            ];
                                            $tipo = $tipos[$movimiento->Movimiento_Inventario_Tipo] ?? ['bg' => 'bg-gray-100', 'text' => 'text-gray-800', 'label' => $movimiento->Movimiento_Inventario_Tipo];
                                        @endphp
                                        <span class="inline-flex items-center gap-1 rounded-full px-3 py-1 text-xs font-semibold {{ $tipo['bg'] }} {{ $tipo['text'] }}">
                                            @if($movimiento->Movimiento_Inventario_Tipo == 'E')
                                                <svg class="h-3 w-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 16l-4-4m0 0l4-4m-4 4h18"/>
                                                </svg>
                                            @else
                                                <svg class="h-3 w-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 8l4 4m0 0l-4 4m4-4H3"/>
                                                </svg>
                                            @endif
                                            {{ $tipo['label'] }}
                                        </span>
                                    </td>
                                    <td class="px-6 py-4">
                                        <span class="text-sm text-gray-700 dark:text-gray-300">{{ $movimiento->Movimiento_Inventario_Motivo }}</span>
                                    </td>
                                    <td class="px-6 py-4">
                                        @if($movimiento->rol)
                                            <p class="text-sm text-gray-700 dark:text-gray-300">{{ $movimiento->rol->Rol_Tipo }}</p>
                                        @else
                                            <span class="text-gray-400">-</span>
                                        @endif
                                    </td>
                                    <td class="whitespace-nowrap px-6 py-4">
                                        <div class="flex items-center justify-center gap-2">
                                            <a href="{{ route('movimiento_inventario.show', $movimiento->Movimiento_Inven_ID) }}" 
                                               class="group relative inline-flex h-9 w-9 items-center justify-center rounded-lg bg-amber-100 text-amber-600 transition-all duration-200 hover:bg-amber-600 hover:text-white hover:shadow-lg dark:bg-amber-900 dark:text-amber-300">
                                                <svg class="h-4 w-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/>
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"/>
                                                </svg>
                                            </a>
                                            
                                            <a href="{{ route('movimiento_inventario.edit', $movimiento->Movimiento_Inven_ID) }}" 
                                               class="group relative inline-flex h-9 w-9 items-center justify-center rounded-lg bg-blue-100 text-blue-600 transition-all duration-200 hover:bg-blue-600 hover:text-white hover:shadow-lg dark:bg-blue-900 dark:text-blue-300">
                                                <svg class="h-4 w-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"/>
                                                </svg>
                                            </a>
                                            
                                            <form action="{{ route('movimiento_inventario.destroy', $movimiento->Movimiento_Inven_ID) }}" method="POST" class="inline-block">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" 
                                                        onclick="return confirm('¿Estás seguro de eliminar este movimiento?')"
                                                        class="group relative inline-flex h-9 w-9 items-center justify-center rounded-lg bg-red-100 text-red-600 transition-all duration-200 hover:bg-red-600 hover:text-white hover:shadow-lg dark:bg-red-900 dark:text-red-300">
                                                    <svg class="h-4 w-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/>
                                                    </svg>
                                                </button>
                                            </form>
                                        </div>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="7" class="px-6 py-12 text-center">
                                        <div class="flex flex-col items-center justify-center gap-3">
                                            <div class="rounded-full bg-gray-100 p-6 dark:bg-gray-700">
                                                <svg class="h-12 w-12 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7h12m0 0l-4-4m4 4l-4 4m0 6H4m0 0l4 4m-4-4l4-4"/>
                                                </svg>
                                            </div>
                                            <p class="text-lg font-semibold text-gray-700 dark:text-gray-300">No hay movimientos registrados</p>
                                            <p class="text-sm text-gray-500 dark:text-gray-400">Crea tu primer movimiento para comenzar</p>
                                            <a href="{{ route('movimiento_inventario.create') }}" 
                                               class="mt-4 inline-flex items-center gap-2 rounded-lg bg-amber-600 px-4 py-2 text-sm font-semibold text-white hover:bg-amber-700">
                                                <svg class="h-4 w-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/>
                                                </svg>
                                                Crear Primer Movimiento
                                            </a>
                                        </div>
                                    </td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>

                <div class="border-t border-gray-200 bg-gray-50 px-6 py-4 dark:border-gray-700 dark:bg-gray-700">
                    <div class="flex items-center justify-between text-sm text-gray-600 dark:text-gray-400">
                        <span>Total de movimientos: <strong class="text-gray-900 dark:text-gray-100">{{ $movimientos->count() }}</strong></span>
                    </div>
                </div>

            </div>
        </div>
    </div>
</x-layouts.app>
</body>
</html>