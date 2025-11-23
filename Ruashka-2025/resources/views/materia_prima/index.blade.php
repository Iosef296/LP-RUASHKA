<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <x-layouts.app :title="__('Materia Prima')">
     <div class="py-8">
        <div class="mx-auto max-w-7xl sm:px-6 lg:px-8">
            
            <!-- Header con título y botón -->
            <div class="mb-6 flex items-center justify-between">
                <div>
                    <h2 class="text-3xl font-bold text-gray-800 dark:text-gray-100">
                        🧶Materia Prima
                    </h2>
                    <p class="mt-1 text-sm text-gray-600 dark:text-gray-400">
                        Hacer Pedidos de Materia Prima
                    </p>
                </div>
                <a href="{{ route('materia_prima.create') }}" 
                   class="inline-flex items-center gap-2 rounded-xl bg-gradient-to-r from-indigo-600 to-purple-600 px-6 py-3 font-semibold text-white shadow-lg transition-all duration-300 hover:scale-105 hover:shadow-xl">
                    <svg class="h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/>
                    </svg>
                    Nueva Orden
                </a>
            </div>
            
            @if (session('success'))
                <div class="mb-6 animate-fade-in-down">
                    <div class="flex items-center gap-3 rounded-xl bg-gradient-to-r from-indigo-500 to-purple-500 p-4 text-white shadow-lg">
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
                            <h3 class="text-xl font-bold text-gray-800 dark:text-gray-100">Inventario de Materia Prima</h3>
                            <p class="mt-1 text-sm text-gray-600 dark:text-gray-400">Control de lana e insumos para producción</p>
                        </div>
                    </div>
                </div>

                <div class="overflow-x-auto">
                    <table class="min-w-full divide-y divide-gray-200 dark:divide-gray-700">
                        <thead>
                            <tr class="bg-gradient-to-r from-indigo-50 to-purple-50 dark:from-gray-700 dark:to-gray-800">
                                <th class="px-6 py-4 text-left text-xs font-bold uppercase tracking-wider text-indigo-600 dark:text-indigo-400">ID</th>
                                <th class="px-6 py-4 text-left text-xs font-bold uppercase tracking-wider text-indigo-600 dark:text-indigo-400">Nombre</th>
                                <th class="px-6 py-4 text-left text-xs font-bold uppercase tracking-wider text-indigo-600 dark:text-indigo-400">Descripción</th>
                                <th class="px-6 py-4 text-left text-xs font-bold uppercase tracking-wider text-indigo-600 dark:text-indigo-400">Stock</th>
                                <th class="px-6 py-4 text-left text-xs font-bold uppercase tracking-wider text-indigo-600 dark:text-indigo-400">Unidad</th>
                                <th class="px-6 py-4 text-center text-xs font-bold uppercase tracking-wider text-indigo-600 dark:text-indigo-400">Acciones</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-gray-200 bg-white dark:divide-gray-700 dark:bg-gray-800">
                            @forelse ($materias as $materia)
                                <tr class="transition-all duration-200 hover:bg-indigo-50 dark:hover:bg-gray-700">
                                    <td class="whitespace-nowrap px-6 py-4">
                                        <span class="inline-flex h-8 w-8 items-center justify-center rounded-full bg-indigo-100 text-xs font-bold text-indigo-600 dark:bg-indigo-900 dark:text-indigo-300">
                                            {{ $materia->Materia_ID }}
                                        </span>
                                    </td>
                                    <td class="px-6 py-4">
                                        <p class="font-semibold text-gray-900 dark:text-gray-100">{{ $materia->Materia_Nombre }}</p>
                                    </td>
                                    <td class="px-6 py-4">
                                        <p class="text-sm text-gray-700 dark:text-gray-300">{{ Str::limit($materia->Materia_Descripcion, 40) }}</p>
                                    </td>
                                    <td class="whitespace-nowrap px-6 py-4">
                                        @if($materia->Materia_Stock < 10)
                                            <span class="inline-flex items-center gap-1 rounded-full bg-red-100 px-3 py-1 text-sm font-semibold text-red-800 dark:bg-red-900 dark:text-red-200">
                                                ⚠️ {{ $materia->Materia_Stock }}
                                            </span>
                                        @elseif($materia->Materia_Stock < 50)
                                            <span class="inline-flex items-center gap-1 rounded-full bg-yellow-100 px-3 py-1 text-sm font-semibold text-yellow-800 dark:bg-yellow-900 dark:text-yellow-200">
                                                {{ $materia->Materia_Stock }}
                                            </span>
                                        @else
                                            <span class="inline-flex items-center gap-1 rounded-full bg-indigo-100 px-3 py-1 text-sm font-semibold text-indigo-800 dark:bg-indigo-900 dark:text-indigo-200">
                                                ✓ {{ $materia->Materia_Stock }}
                                            </span>
                                        @endif
                                    </td>
                                    <td class="whitespace-nowrap px-6 py-4 text-sm text-gray-700 dark:text-gray-300">
                                        {{ $materia->Materia_Unidad_Medida }}
                                    </td>
                                    <td class="whitespace-nowrap px-6 py-4">
                                        <div class="flex items-center justify-center gap-2">
                                            <a href="{{ route('materia_prima.show', $materia->Materia_ID) }}" 
                                               class="group relative inline-flex h-9 w-9 items-center justify-center rounded-lg bg-indigo-100 text-indigo-600 transition-all duration-200 hover:bg-indigo-600 hover:text-white hover:shadow-lg dark:bg-indigo-900 dark:text-indigo-300">
                                                <svg class="h-4 w-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/>
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"/>
                                                </svg>
                                            </a>
                                            
                                            <a href="{{ route('materia_prima.edit', $materia->Materia_ID) }}" 
                                               class="group relative inline-flex h-9 w-9 items-center justify-center rounded-lg bg-blue-100 text-blue-600 transition-all duration-200 hover:bg-blue-600 hover:text-white hover:shadow-lg dark:bg-blue-900 dark:text-blue-300">
                                                <svg class="h-4 w-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"/>
                                                </svg>
                                            </a>
                                            
                                            <form action="{{ route('materia_prima.destroy', $materia->Materia_ID) }}" method="POST" class="inline-block">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" 
                                                        onclick="return confirm('¿Estás seguro de eliminar esta materia prima?')"
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
                                    <td colspan="6" class="px-6 py-12 text-center">
                                        <div class="flex flex-col items-center justify-center gap-3">
                                            <div class="rounded-full bg-gray-100 p-6 dark:bg-gray-700">
                                                <svg class="h-12 w-12 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 012-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10"/>
                                                </svg>
                                            </div>
                                            <p class="text-lg font-semibold text-gray-700 dark:text-gray-300">No hay materia prima registrada</p>
                                            <p class="text-sm text-gray-500 dark:text-gray-400">Registra tu primera materia prima para comenzar</p>
                                            <a href="{{ route('materia_prima.create') }}" 
                                               class="mt-4 inline-flex items-center gap-2 rounded-lg bg-indigo-600 px-4 py-2 text-sm font-semibold text-white hover:bg-indigo-700">
                                                <svg class="h-4 w-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/>
                                                </svg>
                                                Registrar nueva materia prima
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
                        <span>Total de materias primas: <strong class="text-gray-900 dark:text-gray-100">{{ $materias->count() }}</strong></span>
                        <span>Stock total valorizado</span>
                    </div>
                </div>

            </div>
        </div>
    </div>
</x-layouts.app>

</body>
</html>