<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <x-layouts.app :title="__('Detalle de Materia Prima')">
    <div class="py-8">
        <div class="mx-auto max-w-5xl sm:px-6 lg:px-8">
            
            <div class="mb-6 flex items-center justify-between">
                <div>
                    <h2 class="text-3xl font-bold text-gray-800 dark:text-gray-100">
                        Materia Prima #{{ $materia->Materia_ID }}
                    </h2>
                    <p class="mt-1 text-sm text-gray-600 dark:text-gray-400">
                        Información detallada de la materia prima
                    </p>
                </div>
                <div class="flex gap-3">
                    <a href="{{ route('materia_prima.edit', $materia->Materia_ID) }}" 
                       class="inline-flex items-center gap-2 rounded-lg bg-blue-600 px-4 py-2 text-sm font-semibold text-white transition-all hover:bg-blue-700">
                        <svg class="h-4 w-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"/>
                        </svg>
                        Editar
                    </a>
                    <a href="{{ route('materia_prima.index') }}" 
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
                        @if($materia->Materia_Stock < 10)
                            <span class="inline-flex items-center gap-2 rounded-full bg-gradient-to-r from-red-500 to-rose-600 px-4 py-2 text-sm font-bold text-white shadow-lg">
                                <svg class="h-4 w-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z"/>
                                </svg>
                                Stock Bajo
                            </span>
                        @elseif($materia->Materia_Stock < 50)
                            <span class="inline-flex items-center gap-2 rounded-full bg-gradient-to-r from-yellow-500 to-orange-600 px-4 py-2 text-sm font-bold text-white shadow-lg">
                                <svg class="h-4 w-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z"/>
                                </svg>
                                Stock Medio
                            </span>
                        @else
                            <span class="inline-flex items-center gap-2 rounded-full bg-gradient-to-r from-green-500 to-emerald-600 px-4 py-2 text-sm font-bold text-white shadow-lg">
                                <svg class="h-4 w-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/>
                                </svg>
                                Stock Adecuado
                            </span>
                        @endif
                    </div>
                </div>

                <div class="p-6">
                    <div class="grid gap-6 md:grid-cols-2">
                        
                        <div class="flex items-start gap-4 rounded-xl bg-gray-50 p-4 dark:bg-gray-700">
                            <div class="rounded-lg bg-emerald-100 p-3 dark:bg-emerald-900">
                                <svg class="h-6 w-6 text-emerald-600 dark:text-emerald-300" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 20l4-16m2 16l4-16M6 9h14M4 15h14"/>
                                </svg>
                            </div>
                            <div>
                                <p class="text-sm font-medium text-gray-600 dark:text-gray-400">ID de Materia Prima</p>
                                <p class="mt-1 text-2xl font-bold text-gray-900 dark:text-gray-100">#{{ $materia->Materia_ID }}</p>
                            </div>
                        </div>

                        <div class="flex items-start gap-4 rounded-xl bg-gray-50 p-4 dark:bg-gray-700">
                            <div class="rounded-lg bg-blue-100 p-3 dark:bg-blue-900">
                                <svg class="h-6 w-6 text-blue-600 dark:text-blue-300" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 7h.01M7 3h5c.512 0 1.024.195 1.414.586l7 7a2 2 0 010 2.828l-7 7a2 2 0 01-2.828 0l-7-7A1.994 1.994 0 013 12V7a4 4 0 014-4z"/>
                                </svg>
                            </div>
                            <div>
                                <p class="text-sm font-medium text-gray-600 dark:text-gray-400">Nombre</p>
                                <p class="mt-1 text-xl font-bold text-gray-900 dark:text-gray-100">{{ $materia->Materia_Nombre }}</p>
                            </div>
                        </div>

                        <div class="flex items-start gap-4 rounded-xl bg-gray-50 p-4 dark:bg-gray-700 md:col-span-2">
                            <div class="rounded-lg bg-purple-100 p-3 dark:bg-purple-900">
                                <svg class="h-6 w-6 text-purple-600 dark:text-purple-300" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/>
                                </svg>
                            </div>
                            <div class="flex-1">
                                <p class="text-sm font-medium text-gray-600 dark:text-gray-400">Descripción</p>
                                <p class="mt-1 text-gray-900 dark:text-gray-100">{{ $materia->Materia_Descripcion }}</p>
                            </div>
                        </div>

                        <div class="flex items-start gap-4 rounded-xl bg-gray-50 p-4 dark:bg-gray-700">
                            <div class="rounded-lg bg-amber-100 p-3 dark:bg-amber-900">
                                <svg class="h-6 w-6 text-amber-600 dark:text-amber-300" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4"/>
                                </svg>
                            </div>
                            <div>
                                <p class="text-sm font-medium text-gray-600 dark:text-gray-400">Stock Disponible</p>
                                @if($materia->Materia_Stock < 10)
                                    <p class="mt-1 text-2xl font-bold text-red-600">{{ $materia->Materia_Stock }}</p>
                                    <p class="text-xs text-red-500">⚠️ Crítico</p>
                                @elseif($materia->Materia_Stock < 50)
                                    <p class="mt-1 text-2xl font-bold text-yellow-600">{{ $materia->Materia_Stock }}</p>
                                    <p class="text-xs text-yellow-500">⚡ Bajo</p>
                                @else
                                    <p class="mt-1 text-2xl font-bold text-green-600">{{ $materia->Materia_Stock }}</p>
                                    <p class="text-xs text-green-500">✓ Normal</p>
                                @endif
                            </div>
                        </div>

                        <div class="flex items-start gap-4 rounded-xl bg-gray-50 p-4 dark:bg-gray-700">
                            <div class="rounded-lg bg-indigo-100 p-3 dark:bg-indigo-900">
                                <svg class="h-6 w-6 text-indigo-600 dark:text-indigo-300" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 6l3 1m0 0l-3 9a5.002 5.002 0 006.001 0M6 7l3 9M6 7l6-2m6 2l3-1m-3 1l-3 9a5.002 5.002 0 006.001 0M18 7l3 9m-3-9l-6-2m0-2v2m0 16V5m0 16H9m3 0h3"/>
                                </svg>
                            </div>
                            <div>
                                <p class="text-sm font-medium text-gray-600 dark:text-gray-400">Unidad de Medida</p>
                                <p class="mt-1 text-lg font-bold text-gray-900 dark:text-gray-100">{{ $materia->Materia_Unidad_Medida }}</p>
                            </div>
                        </div>

                        @if($materia->ordenProduccion)
                        <div class="flex items-start gap-4 rounded-xl bg-gray-50 p-4 dark:bg-gray-700 md:col-span-2">
                            <div class="rounded-lg bg-cyan-100 p-3 dark:bg-cyan-900">
                                <svg class="h-6 w-6 text-cyan-600 dark:text-cyan-300" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2"/>
                                </svg>
                            </div>
                            <div class="flex-1">
                                <p class="text-sm font-medium text-gray-600 dark:text-gray-400">Orden de Producción Asociada</p>
                                <div class="mt-2 flex items-center justify-between rounded-lg border border-gray-200 p-3 dark:border-gray-600">
                                    <div>
                                        <p class="font-semibold text-gray-900 dark:text-gray-100">Orden #{{ $materia->ordenProduccion->Ord_Produc_ID }}</p>
                                        <p class="text-sm text-gray-500 dark:text-gray-400">
                                            Cantidad: {{ $materia->ordenProduccion->Ord_Prod_Cantidad }} - 
                                            Estado: {{ $materia->ordenProduccion->Ord_Prod_Estado }}
                                        </p>
                                    </div>
                                    <a href="{{ route('orden_produccion.show', $materia->ordenProduccion->Ord_Produc_ID) }}" 
                                       class="rounded-lg bg-cyan-100 px-3 py-2 text-sm font-semibold text-cyan-600 transition-all hover:bg-cyan-600 hover:text-white dark:bg-cyan-900 dark:text-cyan-300">
                                        Ver orden →
                                    </a>
                                </div>
                            </div>
                        </div>
                        @endif

                    </div>
                </div>

            </div>

            <!-- Alertas de stock -->
            @if($materia->Materia_Stock < 10)
            <div class="overflow-hidden rounded-2xl border border-red-200 bg-white shadow-lg dark:border-red-800 dark:bg-gray-800">
                <div class="bg-gradient-to-r from-red-50 to-rose-50 px-6 py-4 dark:from-red-900/20 dark:to-rose-900/20">
                    <div class="flex items-center gap-3">
                        <svg class="h-6 w-6 text-red-600 dark:text-red-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z"/>
                        </svg>
                        <div>
                            <p class="font-bold text-red-800 dark:text-red-300">⚠️ Alerta de Stock Crítico</p>
                            <p class="mt-1 text-sm text-red-700 dark:text-red-400">
                                El stock está en nivel crítico ({{ $materia->Materia_Stock }} {{ $materia->Materia_Unidad_Medida }}). 
                                Se recomienda realizar una compra urgente para evitar interrupciones en la producción.
                            </p>
                        </div>
                    </div>
                </div>
            </div>
            @elseif($materia->Materia_Stock < 50)
            <div class="overflow-hidden rounded-2xl border border-yellow-200 bg-white shadow-lg dark:border-yellow-800 dark:bg-gray-800">
                <div class="bg-gradient-to-r from-yellow-50 to-orange-50 px-6 py-4 dark:from-yellow-900/20 dark:to-orange-900/20">
                    <div class="flex items-center gap-3">
                        <svg class="h-6 w-6 text-yellow-600 dark:text-yellow-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z"/>
                        </svg>
                        <div>
                            <p class="font-bold text-yellow-800 dark:text-yellow-300">⚡ Stock Bajo</p>
                            <p class="mt-1 text-sm text-yellow-700 dark:text-yellow-400">
                                El stock está en nivel bajo ({{ $materia->Materia_Stock }} {{ $materia->Materia_Unidad_Medida }}). 
                                Considera planificar una reposición pronto.
                            </p>
                        </div>
                    </div>
                </div>
            </div>
            @endif

        </div>
    </div>
</x-layouts.app>
</body>
</html>