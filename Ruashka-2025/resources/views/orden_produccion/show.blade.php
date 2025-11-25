<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <x-layouts.app :title="__('Detalle de Orden')">
    <div class="py-8">
        <div class="mx-auto max-w-5xl sm:px-6 lg:px-8">
            
            <!-- Header -->
            <div class="mb-6 flex items-center justify-between">
                <div>
                    <h2 class="text-3xl font-bold text-gray-800 dark:text-gray-100">
                        📋 Orden de Producción #{{ $orden->Ord_Produc_ID }}
                    </h2>
                    <p class="mt-1 text-sm text-gray-600 dark:text-gray-400">
                        Detalles completos de la orden de producción
                    </p>
                </div>
                <div class="flex gap-3">
                    <a href="{{ route('orden_produccion.edit', $orden->Ord_Produc_ID) }}" 
                       class="inline-flex items-center gap-2 rounded-lg bg-blue-600 px-4 py-2 text-sm font-semibold text-white transition-all hover:bg-blue-700">
                        <svg class="h-4 w-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"/>
                        </svg>
                        Editar
                    </a>
                    <a href="{{ route('orden_produccion.index') }}" 
                       class="inline-flex items-center gap-2 rounded-lg bg-gray-200 px-4 py-2 text-sm font-semibold text-gray-700 transition-all hover:bg-gray-300 dark:bg-gray-700 dark:text-gray-300 dark:hover:bg-gray-600">
                        <svg class="h-4 w-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"/>
                        </svg>
                        Volver
                    </a>
                </div>
            </div>

            <!-- Información principal -->
            <div class="mb-6 overflow-hidden rounded-2xl bg-white shadow-2xl dark:bg-gray-800">
                
                <!-- Header con estado -->
                <div class="flex items-center justify-between border-b border-gray-200 bg-gradient-to-r from-indigo-50 to-purple-50 px-6 py-4 dark:border-gray-700 dark:from-gray-700 dark:to-gray-800">
                    <h3 class="text-lg font-bold text-gray-800 dark:text-gray-100">Información General</h3>
                    @php
                        $estados = [
                            'Completado' => 'bg-gradient-to-r from-green-400 to-emerald-500 text-white',
                            'En Proceso' => 'bg-gradient-to-r from-yellow-400 to-orange-500 text-white',
                            'Pendiente' => 'bg-gradient-to-r from-gray-400 to-gray-500 text-white',
                            'Cancelado' => 'bg-gradient-to-r from-red-400 to-rose-500 text-white',
                        ];
                        $estadoClass = $estados[$orden->Ord_Prod_Estado] ?? 'bg-gray-100 text-gray-800';
                    @endphp
                    <span class="inline-flex items-center gap-2 rounded-full px-4 py-2 text-sm font-bold shadow-lg {{ $estadoClass }}">
                        <span class="h-2 w-2 animate-pulse rounded-full bg-white"></span>
                        {{ $orden->Ord_Prod_Estado }}
                    </span>
                </div>

                <!-- Contenido -->
                <div class="p-6">
                    <div class="grid gap-6 md:grid-cols-2">
                        
                        <!-- ID de Orden -->
                        <div class="flex items-start gap-4 rounded-xl bg-gray-50 p-4 dark:bg-gray-700">
                            <div class="rounded-lg bg-indigo-100 p-3 dark:bg-indigo-900">
                                <svg class="h-6 w-6 text-indigo-600 dark:text-indigo-300" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 20l4-16m2 16l4-16M6 9h14M4 15h14"/>
                                </svg>
                            </div>
                            <div>
                                <p class="text-sm font-medium text-gray-600 dark:text-gray-400">ID de Orden</p>
                                <p class="mt-1 text-2xl font-bold text-gray-900 dark:text-gray-100">#{{ $orden->Ord_Produc_ID }}</p>
                            </div>
                        </div>

                        <!-- Cantidad -->
                        <div class="flex items-start gap-4 rounded-xl bg-gray-50 p-4 dark:bg-gray-700">
                            <div class="rounded-lg bg-blue-100 p-3 dark:bg-blue-900">
                                <svg class="h-6 w-6 text-blue-600 dark:text-blue-300" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4"/>
                                </svg>
                            </div>
                            <div>
                                <p class="text-sm font-medium text-gray-600 dark:text-gray-400">Cantidad</p>
                                <p class="mt-1 text-2xl font-bold text-gray-900 dark:text-gray-100">{{ $orden->Ord_Prod_Cantidad }} unidades</p>
                            </div>
                        </div>

                        <!-- Fecha Inicio -->
                        <div class="flex items-start gap-4 rounded-xl bg-gray-50 p-4 dark:bg-gray-700">
                            <div class="rounded-lg bg-emerald-100 p-3 dark:bg-emerald-900">
                                <svg class="h-6 w-6 text-emerald-600 dark:text-emerald-300" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                                </svg>
                            </div>
                            <div>
                                <p class="text-sm font-medium text-gray-600 dark:text-gray-400">Fecha de Inicio</p>
                                <p class="mt-1 text-lg font-bold text-gray-900 dark:text-gray-100">
                                    {{ \Carbon\Carbon::parse($orden->Ord_Prod_Fecha_Inicio)->format('d/m/Y') }}
                                </p>
                            </div>
                        </div>

                        <!-- Fecha Final -->
                        <div class="flex items-start gap-4 rounded-xl bg-gray-50 p-4 dark:bg-gray-700">
                            <div class="rounded-lg bg-amber-100 p-3 dark:bg-amber-900">
                                <svg class="h-6 w-6 text-amber-600 dark:text-amber-300" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                                </svg>
                            </div>
                            <div>
                                <p class="text-sm font-medium text-gray-600 dark:text-gray-400">Fecha Final</p>
                                <p class="mt-1 text-lg font-bold text-gray-900 dark:text-gray-100">
                                    {{ \Carbon\Carbon::parse($orden->Ord_Prod_Fecha_Final)->format('d/m/Y') }}
                                </p>
                            </div>
                        </div>

                        <!-- Responsable -->
                        

            <!-- Materia Prima utilizada -->
            @if($orden->materiasPrimas && $orden->materiasPrimas->count() > 0)
            <div class="overflow-hidden rounded-2xl bg-white shadow-2xl dark:bg-gray-800">
                <div class="border-b border-gray-200 bg-gradient-to-r from-emerald-50 to-teal-50 px-6 py-4 dark:border-gray-700 dark:from-gray-700 dark:to-gray-800">
                    <h3 class="text-lg font-bold text-gray-800 dark:text-gray-100">🧶 Materia Prima Utilizada</h3>
                </div>
                <div class="p-6">
                    <div class="space-y-3">
                        @foreach($orden->materiasPrimas as $materia)
                        <div class="flex items-center justify-between rounded-lg border border-gray-200 p-4 dark:border-gray-700">
                            <div class="flex items-center gap-3">
                                <div class="rounded-lg bg-emerald-100 p-2 dark:bg-emerald-900">
                                    <svg class="h-5 w-5 text-emerald-600 dark:text-emerald-300" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 012-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10"/>
                                    </svg>
                                </div>
                                <div>
                                    <p class="font-semibold text-gray-900 dark:text-gray-100">{{ $materia->Materia_Nombre }}</p>
                                    <p class="text-sm text-gray-500 dark:text-gray-400">{{ $materia->Materia_Descripcion }}</p>
                                </div>
                            </div>
                            <div class="text-right">
                                <p class="font-bold text-gray-900 dark:text-gray-100">{{ $materia->Materia_Stock }} {{ $materia->Materia_Unidad_Medida }}</p>
                            </div>
                        </div>
                        @endforeach
                    </div>
                </div>
            </div>
            @endif

        </div>
    </div>
</x-layouts.app>
</body>
</html>