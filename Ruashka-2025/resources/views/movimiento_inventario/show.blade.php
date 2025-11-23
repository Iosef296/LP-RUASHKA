<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <x-layouts.app :title="__('Detalle de Movimiento')">
    <div class="py-8">
        <div class="mx-auto max-w-5xl sm:px-6 lg:px-8">
            
            <div class="mb-6 flex items-center justify-between">
                <div>
                    <h2 class="text-3xl font-bold text-gray-800 dark:text-gray-100">
                        Movimiento #{{ $movimiento->Movimiento_Inven_ID }}
                    </h2>
                    <p class="mt-1 text-sm text-gray-600 dark:text-gray-400">
                        Detalles del movimiento de inventario
                    </p>
                </div>
                <div class="flex gap-3">
                    <a href="{{ route('movimiento_inventario.edit', $movimiento->Movimiento_Inven_ID) }}" 
                       class="inline-flex items-center gap-2 rounded-lg bg-blue-600 px-4 py-2 text-sm font-semibold text-white transition-all hover:bg-blue-700">
                        <svg class="h-4 w-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"/>
                        </svg>
                        Editar
                    </a>
                    <a href="{{ route('movimiento_inventario.index') }}" 
                       class="inline-flex items-center gap-2 rounded-lg bg-gray-200 px-4 py-2 text-sm font-semibold text-gray-700 transition-all hover:bg-gray-300 dark:bg-gray-700 dark:text-gray-300 dark:hover:bg-gray-600">
                        <svg class="h-4 w-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"/>
                        </svg>
                        Volver
                    </a>
                </div>
            </div>

            <div class="mb-6 overflow-hidden rounded-2xl bg-white shadow-2xl dark:bg-gray-800">
                
                <div class="border-b border-gray-200 bg-gradient-to-r from-gray-50 to-gray-100 px-6 py-4 dark:border-gray-700 dark:from-gray-700 dark:to-gray-800">
                    <div class="flex items-center justify-between">
                        <h3 class="text-lg font-bold text-gray-800 dark:text-gray-100">Información General</h3>
                        @php
                            $tipos = [
                                'E' => ['bg' => 'bg-gradient-to-r from-green-500 to-emerald-600', 'label' => 'Entrada'],
                                'S' => ['bg' => 'bg-gradient-to-r from-red-500 to-rose-600', 'label' => 'Salida'],
                            ];
                            $tipo = $tipos[$movimiento->Movimiento_Inventario_Tipo] ?? ['bg' => 'bg-gray-500', 'label' => $movimiento->Movimiento_Inventario_Tipo];
                        @endphp
                        <span class="inline-flex items-center gap-2 rounded-full px-4 py-2 text-sm font-bold text-white shadow-lg {{ $tipo['bg'] }}">
                            @if($movimiento->Movimiento_Inventario_Tipo == 'E')
                                <svg class="h-4 w-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 16l-4-4m0 0l4-4m-4 4h18"/>
                                </svg>
                            @else
                                <svg class="h-4 w-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 8l4 4m0 0l-4 4m4-4H3"/>
                                </svg>
                            @endif
                            {{ $tipo['label'] }}
                        </span>
                    </div>
                </div>

                <div class="p-6">
                    <div class="grid gap-6 md:grid-cols-2">
                        
                        <div class="flex items-start gap-4 rounded-xl bg-gray-50 p-4 dark:bg-gray-700">
                            <div class="rounded-lg bg-amber-100 p-3 dark:bg-amber-900">
                                <svg class="h-6 w-6 text-amber-600 dark:text-amber-300" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 20l4-16m2 16l4-16M6 9h14M4 15h14"/>
                                </svg>
                            </div>
                            <div>
                                <p class="text-sm font-medium text-gray-600 dark:text-gray-400">ID de Movimiento</p>
                                <p class="mt-1 text-2xl font-bold text-gray-900 dark:text-gray-100">#{{ $movimiento->Movimiento_Inven_ID }}</p>
                            </div>
                        </div>

                        <div class="flex items-start gap-4 rounded-xl bg-gray-50 p-4 dark:bg-gray-700">
                            <div class="rounded-lg bg-blue-100 p-3 dark:bg-blue-900">
                                <svg class="h-6 w-6 text-blue-600 dark:text-blue-300" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                                </svg>
                            </div>
                            <div>
                                <p class="text-sm font-medium text-gray-600 dark:text-gray-400">Fecha</p>
                                <p class="mt-1 text-lg font-bold text-gray-900 dark:text-gray-100">
                                    {{ \Carbon\Carbon::parse($movimiento->Movimiento_Inventario_Fecha)->format('d/m/Y') }}
                                </p>
                            </div>
                        </div>

                        <div class="flex items-start gap-4 rounded-xl bg-gray-50 p-4 dark:bg-gray-700">
                            <div class="rounded-lg bg-purple-100 p-3 dark:bg-purple-900">
                                <svg class="h-6 w-6 text-purple-600 dark:text-purple-300" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4"/>
                                </svg>
                            </div>
                            <div>
                                <p class="text-sm font-medium text-gray-600 dark:text-gray-400">Producto</p>
                                @if($movimiento->producto)
                                    <p class="mt-1 text-lg font-bold text-gray-900 dark:text-gray-100">{{ $movimiento->producto->Producto_Nombre }}</p>
                                    <p class="text-sm text-gray-500 dark:text-gray-400">S/ {{ $movimiento->producto->Producto_Precio_Unit }}</p>
                                @else
                                    <p class="mt-1 text-lg font-semibold text-gray-400">Sin producto</p>
                                @endif
                            </div>
                        </div>

                        <div class="flex items-start gap-4 rounded-xl bg-gray-50 p-4 dark:bg-gray-700">
                            <div class="rounded-lg bg-emerald-100 p-3 dark:bg-emerald-900">
                                <svg class="h-6 w-6 text-emerald-600 dark:text-emerald-300" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/>
                                </svg>
                            </div>
                            <div>
                                <p class="text-sm font-medium text-gray-600 dark:text-gray-400">Motivo</p>
                                @php
                                    $motivos = [
                                        'C' => 'Compra',
                                        'V' => 'Venta',
                                        'P' => 'Producción',
                                        'A' => 'Ajuste',
                                        'D' => 'Devolución',
                                    ];
                                @endphp
                                <p class="mt-1 text-lg font-bold text-gray-900 dark:text-gray-100">
                                    {{ $motivos[$movimiento->Movimiento_Inventario_Motivo] ?? $movimiento->Movimiento_Inventario_Motivo }}
                                </p>
                            </div>
                        </div>

                        <div class="flex items-start gap-4 rounded-xl bg-gray-50 p-4 dark:bg-gray-700">
                            <div class="rounded-lg bg-indigo-100 p-3 dark:bg-indigo-900">
                                <svg class="h-6 w-6 text-indigo-600 dark:text-indigo-300" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"/>
                                </svg>
                            </div>
                            <div>
                                <p class="text-sm font-medium text-gray-600 dark:text-gray-400">Responsable</p>
                                @if($movimiento->rol)
                                    <p class="mt-1 text-lg font-bold text-gray-900 dark:text-gray-100">{{ $movimiento->rol->Rol_Tipo }}</p>
                                    <p class="text-sm text-gray-500 dark:text-gray-400">{{ $movimiento->rol->Rol_Accesos }}</p>
                                @else
                                    <p class="mt-1 text-lg font-semibold text-gray-400">-</p>
                                @endif
                            </div>
                        </div>

                        <div class="flex items-start gap-4 rounded-xl bg-gray-50 p-4 dark:bg-gray-700">
                            <div class="rounded-lg bg-cyan-100 p-3 dark:bg-cyan-900">
                                <svg class="h-6 w-6 text-cyan-600 dark:text-cyan-300" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"/>
                                </svg>
                            </div>
                            <div>
                                <p class="text-sm font-medium text-gray-600 dark:text-gray-400">Sede</p>
                                @if($movimiento->Sede_ID)
                                    <p class="mt-1 text-lg font-bold text-gray-900 dark:text-gray-100">Sede #{{ $movimiento->Sede_ID }}</p>
                                @else
                                    <p class="mt-1 text-lg font-semibold text-gray-400">No especificada</p>
                                @endif
                            </div>
                        </div>

                    </div>
                </div>

            </div>

        </div>
    </div>
</x-layouts.app>
</body>
</html>