<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
   <x-layouts.app :title="__('Órdenes de Producción')">
    <div class="py-8">
        <div class="mx-auto max-w-7xl sm:px-6 lg:px-8">
            
            <!-- Header con título y botón -->
            <div class="mb-6 flex items-center justify-between">
                <div>
                    <h2 class="text-3xl font-bold text-gray-800 dark:text-gray-100">
                        📦 Órdenes de Producción
                    </h2>
                    <p class="mt-1 text-sm text-gray-600 dark:text-gray-400">
                        Sistema completo de gestión de órdenes
                    </p>
                </div>
                <div class="flex gap-3">
                    <a href="{{ route('orden_produccion.exportar_pdf') }}" 
                       class="inline-flex items-center gap-2 rounded-xl bg-gradient-to-r from-red-600 to-rose-600 px-4 py-2 font-semibold text-white shadow-lg transition-all duration-300 hover:scale-105">
                        <svg class="h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 10v6m0 0l-3-3m3 3l3-3m2 8H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/>
                        </svg>
                        PDF
                    </a>
                    <a href="{{ route('orden_produccion.create') }}" 
                       class="inline-flex items-center gap-2 rounded-xl bg-gradient-to-r from-indigo-600 to-purple-600 px-6 py-3 font-semibold text-white shadow-lg transition-all duration-300 hover:scale-105 hover:shadow-xl">
                        <svg class="h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/>
                        </svg>
                        Nueva Orden
                    </a>
                </div>
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

            <!-- Dashboard de Estadísticas -->
            <div class="mb-6 grid gap-4 sm:grid-cols-2 lg:grid-cols-5">
                
                <div class="group relative overflow-hidden rounded-2xl bg-gradient-to-br from-blue-500 to-indigo-600 p-6 shadow-xl transition-all duration-300 hover:scale-105">
                    <div class="absolute right-0 top-0 h-24 w-24 translate-x-8 -translate-y-8 transform rounded-full bg-white opacity-10"></div>
                    <div class="relative">
                        <p class="text-sm font-medium text-blue-100">Total Órdenes</p>
                        <p class="mt-2 text-3xl font-bold text-white">{{ $estadisticas['total'] }}</p>
                    </div>
                </div>

                <div class="group relative overflow-hidden rounded-2xl bg-gradient-to-br from-gray-500 to-gray-600 p-6 shadow-xl transition-all duration-300 hover:scale-105">
                    <div class="absolute right-0 top-0 h-24 w-24 translate-x-8 -translate-y-8 transform rounded-full bg-white opacity-10"></div>
                    <div class="relative">
                        <p class="text-sm font-medium text-gray-100">Pendientes</p>
                        <p class="mt-2 text-3xl font-bold text-white">{{ $estadisticas['pendientes'] }}</p>
                    </div>
                </div>

                <div class="group relative overflow-hidden rounded-2xl bg-gradient-to-br from-yellow-500 to-orange-600 p-6 shadow-xl transition-all duration-300 hover:scale-105">
                    <div class="absolute right-0 top-0 h-24 w-24 translate-x-8 -translate-y-8 transform rounded-full bg-white opacity-10"></div>
                    <div class="relative">
                        <p class="text-sm font-medium text-yellow-100">En Proceso</p>
                        <p class="mt-2 text-3xl font-bold text-white">{{ $estadisticas['en_proceso'] }}</p>
                    </div>
                </div>

                <div class="group relative overflow-hidden rounded-2xl bg-gradient-to-br from-green-500 to-emerald-600 p-6 shadow-xl transition-all duration-300 hover:scale-105">
                    <div class="absolute right-0 top-0 h-24 w-24 translate-x-8 -translate-y-8 transform rounded-full bg-white opacity-10"></div>
                    <div class="relative">
                        <p class="text-sm font-medium text-green-100">Completadas</p>
                        <p class="mt-2 text-3xl font-bold text-white">{{ $estadisticas['completadas'] }}</p>
                    </div>
                </div>

                <div class="group relative overflow-hidden rounded-2xl bg-gradient-to-br from-red-500 to-rose-600 p-6 shadow-xl transition-all duration-300 hover:scale-105">
                    <div class="absolute right-0 top-0 h-24 w-24 translate-x-8 -translate-y-8 transform rounded-full bg-white opacity-10"></div>
                    <div class="relative">
                        <p class="text-sm font-medium text-red-100">Canceladas</p>
                        <p class="mt-2 text-3xl font-bold text-white">{{ $estadisticas['canceladas'] }}</p>
                    </div>
                </div>

            </div>

            <!-- Filtros y Búsqueda -->
            <div class="mb-6 rounded-2xl bg-white p-6 shadow-xl dark:bg-gray-800">
                <form method="GET" action="{{ route('orden_produccion.index') }}" class="grid gap-4 md:grid-cols-4">
                    
                    <!-- Búsqueda -->
                    <div class="md:col-span-4">
                        <label class="mb-2 block text-sm font-bold text-gray-700 dark:text-gray-300">
                            🔍 Búsqueda rápida
                        </label>
                        <input type="text" 
                               name="buscar" 
                               value="{{ request('buscar') }}"
                               placeholder="Buscar por ID, producto o cliente..."
                               class="w-full rounded-lg border border-gray-300 px-4 py-3 transition-all focus:border-indigo-500 focus:ring-2 focus:ring-indigo-500 dark:border-gray-600 dark:bg-gray-700 dark:text-gray-100">
                    </div>

                    <!-- Filtro Estado -->
                    <div>
                        <label class="mb-2 block text-sm font-bold text-gray-700 dark:text-gray-300">
                            Estado
                        </label>
                        <select name="estado" 
                                class="w-full rounded-lg border border-gray-300 px-4 py-3 dark:border-gray-600 dark:bg-gray-700 dark:text-gray-100">
                            <option value="">Todos los estados</option>
                            <option value="Pendiente" {{ request('estado') == 'Pendiente' ? 'selected' : '' }}>Pendiente</option>
                            <option value="En Proceso" {{ request('estado') == 'En Proceso' ? 'selected' : '' }}>En Proceso</option>
                            <option value="Completado" {{ request('estado') == 'Completado' ? 'selected' : '' }}>Completado</option>
                            <option value="Cancelado" {{ request('estado') == 'Cancelado' ? 'selected' : '' }}>Cancelado</option>
                        </select>
                    </div>

                    <!-- Filtro Tipo Producto -->
                    <div>
                        <label class="mb-2 block text-sm font-bold text-gray-700 dark:text-gray-300">
                            Tipo de Producto
                        </label>
                        <select name="tipo_producto" 
                                class="w-full rounded-lg border border-gray-300 px-4 py-3 dark:border-gray-600 dark:bg-gray-700 dark:text-gray-100">
                            <option value="">Todos los productos</option>
                            <option value="Chompas" {{ request('tipo_producto') == 'Chompas' ? 'selected' : '' }}>Chompas</option>
                            <option value="Gorros" {{ request('tipo_producto') == 'Gorros' ? 'selected' : '' }}>Gorros</option>
                            <option value="Bufandas" {{ request('tipo_producto') == 'Bufandas' ? 'selected' : '' }}>Bufandas</option>
                            <option value="Guantes" {{ request('tipo_producto') == 'Guantes' ? 'selected' : '' }}>Guantes</option>
                            <option value="Chalinas" {{ request('tipo_producto') == 'Chalinas' ? 'selected' : '' }}>Chalinas</option>
                            <option value="Ponchos" {{ request('tipo_producto') == 'Ponchos' ? 'selected' : '' }}>Ponchos</option>
                        </select>
                    </div>

                    <!-- Ordenar -->
                    <div>
                        <label class="mb-2 block text-sm font-bold text-gray-700 dark:text-gray-300">
                            Ordenar por
                        </label>
                        <select name="ordenar" 
                                class="w-full rounded-lg border border-gray-300 px-4 py-3 dark:border-gray-600 dark:bg-gray-700 dark:text-gray-100">
                            <option value="fecha_desc" {{ request('ordenar') == 'fecha_desc' ? 'selected' : '' }}>Fecha más reciente</option>
                            <option value="fecha_asc" {{ request('ordenar') == 'fecha_asc' ? 'selected' : '' }}>Fecha más antigua</option>
                            <option value="cantidad_desc" {{ request('ordenar') == 'cantidad_desc' ? 'selected' : '' }}>Mayor cantidad</option>
                            <option value="cantidad_asc" {{ request('ordenar') == 'cantidad_asc' ? 'selected' : '' }}>Menor cantidad</option>
                            <option value="prioridad" {{ request('ordenar') == 'prioridad' ? 'selected' : '' }}>Mayor prioridad</option>
                        </select>
                    </div>

                    <!-- Botones -->
                    <div class="flex items-end gap-2">
                        <button type="submit" 
                                class="flex-1 rounded-lg bg-indigo-600 px-4 py-3 font-semibold text-white transition-all hover:bg-indigo-700">
                            Filtrar
                        </button>
                        <a href="{{ route('orden_produccion.index') }}" 
                           class="rounded-lg bg-gray-200 px-4 py-3 font-semibold text-gray-700 transition-all hover:bg-gray-300 dark:bg-gray-700 dark:text-gray-300">
                            Limpiar
                        </a>
                    </div>

                </form>
            </div>

            <!-- Acciones en Lote -->
            <form id="formLote" method="POST" action="{{ route('orden_produccion.cambiar_estado_lote') }}" class="mb-4">
                @csrf
                <div class="flex items-center gap-4 rounded-xl bg-gray-100 p-4 dark:bg-gray-700">
                    <p class="text-sm font-semibold text-gray-700 dark:text-gray-300">
                        Acciones en lote:
                    </p>
                    <select name="nuevo_estado" 
                            class="rounded-lg border border-gray-300 px-4 py-2 text-sm dark:border-gray-600 dark:bg-gray-800 dark:text-gray-100">
                        <option value="">Cambiar estado a...</option>
                        <option value="Pendiente">Pendiente</option>
                        <option value="En Proceso">En Proceso</option>
                        <option value="Completado">Completado</option>
                        <option value="Cancelado">Cancelado</option>
                    </select>
                    <button type="submit" 
                            onclick="return confirm('¿Cambiar el estado de las órdenes seleccionadas?')"
                            class="rounded-lg bg-blue-600 px-4 py-2 text-sm font-semibold text-white transition-all hover:bg-blue-700">
                        Aplicar
                    </button>
                    <span id="contadorSeleccionados" class="text-sm text-gray-600 dark:text-gray-400">
                        0 seleccionadas
                    </span>
                </div>
            </form>

            <!-- Tabla de Órdenes -->
            <div class="overflow-hidden rounded-2xl bg-white shadow-2xl dark:bg-gray-800">
                
                <div class="border-b border-gray-200 bg-gradient-to-r from-gray-50 to-gray-100 px-6 py-5 dark:border-gray-700 dark:from-gray-700 dark:to-gray-800">
                    <h3 class="text-xl font-bold text-gray-800 dark:text-gray-100">
                        Listado de Órdenes ({{ $ordenes->total() }} registros)
                    </h3>
                </div>

                <div class="overflow-x-auto">
                    <table class="min-w-full divide-y divide-gray-200 dark:divide-gray-700">
                        <thead>
                            <tr class="bg-gradient-to-r from-indigo-50 to-purple-50 dark:from-gray-700 dark:to-gray-800">
                                <th class="px-6 py-4">
                                    <input type="checkbox" id="selectAll" class="h-4 w-4 rounded border-gray-300 text-indigo-600 focus:ring-indigo-500">
                                </th>
                                <th class="px-6 py-4 text-left text-xs font-bold uppercase tracking-wider text-indigo-600 dark:text-indigo-400">ID</th>
                                <th class="px-6 py-4 text-left text-xs font-bold uppercase tracking-wider text-indigo-600 dark:text-indigo-400">Tipo Producto</th>
                                <th class="px-6 py-4 text-left text-xs font-bold uppercase tracking-wider text-indigo-600 dark:text-indigo-400">Cliente</th>
                                <th class="px-6 py-4 text-left text-xs font-bold uppercase tracking-wider text-indigo-600 dark:text-indigo-400">Fechas</th>
                                <th class="px-6 py-4 text-left text-xs font-bold uppercase tracking-wider text-indigo-600 dark:text-indigo-400">Cantidad</th>
                                <th class="px-6 py-4 text-left text-xs font-bold uppercase tracking-wider text-indigo-600 dark:text-indigo-400">Costo</th>
                                <th class="px-6 py-4 text-left text-xs font-bold uppercase tracking-wider text-indigo-600 dark:text-indigo-400">Prioridad</th>
                                <th class="px-6 py-4 text-left text-xs font-bold uppercase tracking-wider text-indigo-600 dark:text-indigo-400">Estado</th>
                                <th class="px-6 py-4 text-center text-xs font-bold uppercase tracking-wider text-indigo-600 dark:text-indigo-400">Acciones</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-gray-200 bg-white dark:divide-gray-700 dark:bg-gray-800">
                            @forelse ($ordenes as $orden)
                                <tr class="transition-all duration-200 hover:bg-indigo-50 dark:hover:bg-gray-700">
                                    <td class="px-6 py-4">
                                        <input type="checkbox" 
                                               name="ordenes[]" 
                                               value="{{ $orden->Ord_Produc_ID }}" 
                                               form="formLote"
                                               class="checkboxOrden h-4 w-4 rounded border-gray-300 text-indigo-600 focus:ring-indigo-500">
                                    </td>
                                    <td class="whitespace-nowrap px-6 py-4">
                                        <span class="inline-flex h-8 w-8 items-center justify-center rounded-full bg-indigo-100 text-xs font-bold text-indigo-600 dark:bg-indigo-900 dark:text-indigo-300">
                                            {{ $orden->Ord_Produc_ID }}
                                        </span>
                                    </td>
                                    <td class="px-6 py-4">
                                        <span class="inline-flex items-center gap-1 rounded-full bg-purple-100 px-3 py-1 text-xs font-semibold text-purple-800 dark:bg-purple-900 dark:text-purple-200">
                                            {{ $orden->Ord_Prod_Tipo_Producto }}
                                        </span>
                                    </td>
                                    <td class="px-6 py-4">
                                        <p class="text-sm font-medium text-gray-900 dark:text-gray-100">
                                            {{ $orden->Ord_Prod_Cliente ?? 'Sin cliente' }}
                                        </p>
                                    </td>
                                    <td class="whitespace-nowrap px-6 py-4 text-sm text-gray-700 dark:text-gray-300">
                                        <div class="flex flex-col gap-1">
                                            <span>{{ $orden->Ord_Prod_Fecha_Inicio->format('d/m/Y') }}</span>
                                            <span class="text-xs text-gray-500">→ {{ $orden->Ord_Prod_Fecha_Final->format('d/m/Y') }}</span>
                                        </div>
                                    </td>
                                    <td class="whitespace-nowrap px-6 py-4">
                                        <span class="inline-flex items-center gap-1 rounded-full bg-blue-100 px-3 py-1 text-sm font-semibold text-blue-800 dark:bg-blue-900 dark:text-blue-200">
                                            {{ $orden->Ord_Prod_Cantidad }}
                                        </span>
                                    </td>
                                    <td class="whitespace-nowrap px-6 py-4 text-sm font-semibold text-gray-900 dark:text-gray-100">
                                        S/. {{ number_format($orden->Ord_Prod_Costo_Estimado ?? 0, 2) }}
                                    </td>
                                    <td class="whitespace-nowrap px-6 py-4">
                                        @if($orden->Ord_Prod_Prioridad == 3)
                                            <span class="inline-flex items-center gap-1 rounded-full bg-red-100 px-3 py-1 text-xs font-bold text-red-800 dark:bg-red-900 dark:text-red-200">
                                                🔴 Alta
                                            </span>
                                        @elseif($orden->Ord_Prod_Prioridad == 2)
                                            <span class="inline-flex items-center gap-1 rounded-full bg-yellow-100 px-3 py-1 text-xs font-bold text-yellow-800 dark:bg-yellow-900 dark:text-yellow-200">
                                                🟡 Media
                                            </span>
                                        @else
                                            <span class="inline-flex items-center gap-1 rounded-full bg-green-100 px-3 py-1 text-xs font-bold text-green-800 dark:bg-green-900 dark:text-green-200">
                                                🟢 Baja
                                            </span>
                                        @endif
                                    </td>
                                    <td class="whitespace-nowrap px-6 py-4">
                                        @php
                                            $estados = [
                                                'Completado' => 'bg-gradient-to-r from-green-400 to-emerald-500 text-white',
                                                'En Proceso' => 'bg-gradient-to-r from-yellow-400 to-orange-500 text-white',
                                                'Pendiente' => 'bg-gradient-to-r from-gray-400 to-gray-500 text-white',
                                                'Cancelado' => 'bg-gradient-to-r from-red-400 to-rose-500 text-white',
                                            ];
                                            $estadoClass = $estados[$orden->Ord_Prod_Estado] ?? 'bg-gray-100 text-gray-800';
                                        @endphp
                                        <span class="inline-flex items-center gap-1 rounded-full px-4 py-1.5 text-xs font-bold shadow-sm {{ $estadoClass }}">
                                            <span class="h-2 w-2 animate-pulse rounded-full bg-white"></span>
                                            {{ $orden->Ord_Prod_Estado }}
                                        </span>
                                    </td>
                                    <td class="whitespace-nowrap px-6 py-4">
                                        <div class="flex items-center justify-center gap-2">
                                            <a href="{{ route('orden_produccion.show', $orden->Ord_Produc_ID) }}" 
                                               class="group relative inline-flex h-9 w-9 items-center justify-center rounded-lg bg-indigo-100 text-indigo-600 transition-all duration-200 hover:bg-indigo-600 hover:text-white hover:shadow-lg">
                                                <svg class="h-4 w-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/>
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"/>
                                                </svg>
                                            </a>
                                            
                                           <a href="{{ route('orden_produccion.edit', $orden->Ord_Produc_ID) }}"
   class="group relative inline-flex h-9 w-9 items-center justify-center rounded-lg bg-blue-100 text-blue-600 transition-all duration-200 hover:bg-blue-600 hover:text-white hover:shadow-lg">
    <svg class="h-4 w-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"/>
    </svg>
</a>

                                            
                                            <form action="{{ route('orden_produccion.destroy', $orden->Ord_Produc_ID) }}" method="POST" class="inline-block">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" 
                                                        onclick="return confirm('¿Estás seguro de eliminar esta orden?')"
                                                        class="group relative inline-flex h-9 w-9 items-center justify-center rounded-lg bg-red-100 text-red-600 transition-all duration-200 hover:bg-red-600 hover:text-white hover:shadow-lg">
                                                    <svg class="h-4 w-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/>
                                                    </svg>
                                                </button>
                                            </form>
                                        </div>
                                    </td>
                                </tr
                    

                                 <!-- Modal de Edición -->
<div x-data="{ open: false }" 
     x-show="open" 
     x-transition
     class="fixed inset-0 z-50 flex items-center justify-center bg-black/50">
     
    <div class="w-full max-w-2xl rounded-2xl bg-white p-6 shadow-lg dark:bg-gray-800">
        <h2 class="text-xl font-bold mb-4">Editar Orden #{{ $orden->Ord_Produc_ID }}</h2>
        <form action="{{ route('orden_produccion.update', $orden->Ord_Produc_ID) }}" method="POST">
            @csrf
            @method('PUT')

            <div class="space-y-4">
                <div class="grid gap-4 md:grid-cols-2">
                    <div>
                        <label class="block mb-2 text-sm font-bold">📅 Fecha Inicio *</label>
                        <input type="date" name="Ord_Prod_Fecha_Inicio" value="{{ $orden->Ord_Prod_Fecha_Inicio->format('Y-m-d') }}" class="w-full rounded-lg border px-4 py-2 dark:bg-gray-700" required>
                    </div>
                    <div>
                        <label class="block mb-2 text-sm font-bold">📅 Fecha Final *</label>
                        <input type="date" name="Ord_Prod_Fecha_Final" value="{{ $orden->Ord_Prod_Fecha_Final->format('Y-m-d') }}" class="w-full rounded-lg border px-4 py-2 dark:bg-gray-700" required>
                    </div>
                </div>

                <div>
                    <label class="block mb-2 text-sm font-bold">🧶 Tipo de Producto *</label>
                    <select name="Ord_Prod_Tipo_Producto" class="w-full rounded-lg border px-4 py-2 dark:bg-gray-700" required>
                        <option value="Chompas" {{ $orden->Ord_Prod_Tipo_Producto == 'Chompas' ? 'selected' : '' }}>Chompas</option>
                        <option value="Gorros" {{ $orden->Ord_Prod_Tipo_Producto == 'Gorros' ? 'selected' : '' }}>Gorros</option>
                        <option value="Bufandas" {{ $orden->Ord_Prod_Tipo_Producto == 'Bufandas' ? 'selected' : '' }}>Bufandas</option>
                        <option value="Guantes" {{ $orden->Ord_Prod_Tipo_Producto == 'Guantes' ? 'selected' : '' }}>Guantes</option>
                        <option value="Chalinas" {{ $orden->Ord_Prod_Tipo_Producto == 'Chalinas' ? 'selected' : '' }}>Chalinas</option>
                        <option value="Ponchos" {{ $orden->Ord_Prod_Tipo_Producto == 'Ponchos' ? 'selected' : '' }}>Ponchos</option>
                    </select>
                </div>

                <div>
                    <label class="block mb-2 text-sm font-bold">👤 Cliente</label>
                    <input type="text" name="Ord_Prod_Cliente" value="{{ $orden->Ord_Prod_Cliente }}" placeholder="Nombre del cliente" class="w-full rounded-lg border px-4 py-2 dark:bg-gray-700">
                </div>

                <div class="grid gap-4 md:grid-cols-2">
                    <div>
                        <label class="block mb-2 text-sm font-bold">📦 Cantidad *</label>
                        <input type="number" name="Ord_Prod_Cantidad" value="{{ $orden->Ord_Prod_Cantidad }}" min="1" class="w-full rounded-lg border px-4 py-2 dark:bg-gray-700" required>
                    </div>
                    <div>
                        <label class="block mb-2 text-sm font-bold">💰 Costo Estimado</label>
                        <input type="number" name="Ord_Prod_Costo_Estimado" value="{{ $orden->Ord_Prod_Costo_Estimado }}" step="0.01" min="0" placeholder="0.00" class="w-full rounded-lg border px-4 py-2 dark:bg-gray-700">
                    </div>
                </div>

                <div class="grid gap-4 md:grid-cols-2">
                    <div>
                        <label class="block mb-2 text-sm font-bold">🔄 Estado *</label>
                        <select name="Ord_Prod_Estado" class="w-full rounded-lg border px-4 py-2 dark:bg-gray-700" required>
                            <option value="Pendiente" {{ $orden->Ord_Prod_Estado == 'Pendiente' ? 'selected' : '' }}>Pendiente</option>
                            <option value="En Proceso" {{ $orden->Ord_Prod_Estado == 'En Proceso' ? 'selected' : '' }}>En Proceso</option>
                            <option value="Completado" {{ $orden->Ord_Prod_Estado == 'Completado' ? 'selected' : '' }}>Completado</option>
                            <option value="Cancelado" {{ $orden->Ord_Prod_Estado == 'Cancelado' ? 'selected' : '' }}>Cancelado</option>
                        </select>
                    </div>
                    <div>
                        <label class="block mb-2 text-sm font-bold">⚡ Prioridad *</label>
                        <select name="Ord_Prod_Prioridad" class="w-full rounded-lg border px-4 py-2 dark:bg-gray-700" required>
                            <option value="1" {{ $orden->Ord_Prod_Prioridad == 1 ? 'selected' : '' }}>🟢 Baja</option>
                            <option value="2" {{ $orden->Ord_Prod_Prioridad == 2 ? 'selected' : '' }}>🟡 Media</option>
                            <option value="3" {{ $orden->Ord_Prod_Prioridad == 3 ? 'selected' : '' }}>🔴 Alta</option>
                        </select>
                    </div>
                </div>

                <div>
                    <label class="block mb-2 text-sm font-bold">📝 Observaciones</label>
                    <textarea name="Ord_Prod_Observaciones" rows="3" placeholder="Notas adicionales..." class="w-full rounded-lg border px-4 py-2 dark:bg-gray-700">{{ $orden->Ord_Prod_Observaciones }}</textarea>
                </div>
            </div>

            <div class="mt-6 flex justify-end gap-4 border-t pt-4">
                <button type="button" @click="open = false" class="rounded-lg bg-gray-200 px-6 py-2 hover:bg-gray-300">
                    Cancelar
                </button>
                <button type="submit" class="rounded-lg bg-blue-600 px-6 py-2 text-white hover:bg-blue-700">
                    Guardar Cambios
                </button>
            </div>
        </form>
    </div>
</div>


                        @empty
                            <tr>
                                <td colspan="10" class="px-6 py-12 text-center">
                                    <div class="flex flex-col items-center gap-3">
                                        <div class="rounded-full bg-gray-100 p-6">
                                            <svg class="h-12 w-12 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 13V6a2 2 0 00-2-2H6a2 2 0 00-2 2v7m16 0v5a2 2 0 01-2 2H6a2 2 0 01-2-2v-5m16 0h-2.586a1 1 0 00-.707.293l-2.414 2.414a1 1 0 01-.707.293h-3.172a1 1 0 01-.707-.293l-2.414-2.414A1 1 0 006.586 13H4"/>
                                            </svg>
                                        </div>
                                        <p class="text-lg font-semibold">No hay órdenes de producción</p>
                                        <a href="{{ route('orden_produccion.create') }}" class="mt-4 inline-flex items-center gap-2 rounded-lg bg-indigo-600 px-4 py-2 text-sm font-semibold text-white hover:bg-indigo-700">
                                            Crear Primera Orden
                                        </a>
                                    </div>
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

            <!-- Paginación -->
            <div class="border-t border-gray-200 bg-gray-50 px-6 py-4 dark:border-gray-700 dark:bg-gray-700">
                {{ $ordenes->links() }}
            </div>

        </div>
    </div>
</div>

@push('scripts')
<script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>
<script>
    // Select All functionality
    document.getElementById('selectAll').addEventListener('change', function() {
        const checkboxes = document.querySelectorAll('.checkboxOrden');
        checkboxes.forEach(checkbox => checkbox.checked = this.checked);
        actualizarContador();
    });

    // Contador de seleccionados
    document.querySelectorAll('.checkboxOrden').forEach(checkbox => {
        checkbox.addEventListener('change', actualizarContador);
    });

    function actualizarContador() {
        const seleccionados = document.querySelectorAll('.checkboxOrden:checked').length;
        document.getElementById('contadorSeleccionados').textContent = `${seleccionados} seleccionadas`;
    }
</script>
@endpush
</x-layouts.app>

</body>
</html>