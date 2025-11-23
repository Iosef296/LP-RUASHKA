<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <x-layouts.app :title="__('Detalle de Rol')">
    <div class="py-8">
        <div class="mx-auto max-w-5xl sm:px-6 lg:px-8">
            
            <div class="mb-6 flex items-center justify-between">
                <div>
                    <h2 class="text-3xl font-bold text-gray-800 dark:text-gray-100">
                        Rol #{{ $rol->Rol_ID }}
                    </h2>
                    <p class="mt-1 text-sm text-gray-600 dark:text-gray-400">
                        Información detallada del rol
                    </p>
                </div>
                <div class="flex gap-3">
                    <a href="{{ route('roles.edit', $rol->Rol_ID) }}" 
                       class="inline-flex items-center gap-2 rounded-lg bg-blue-600 px-4 py-2 text-sm font-semibold text-white transition-all hover:bg-blue-700">
                        <svg class="h-4 w-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"/>
                        </svg>
                        Editar
                    </a>
                    <a href="{{ route('roles.index') }}" 
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
                    <h3 class="text-lg font-bold text-gray-800 dark:text-gray-100">Información General</h3>
                </div>

                <div class="p-6">
                    <div class="grid gap-6 md:grid-cols-2">
                        
                        <div class="flex items-start gap-4 rounded-xl bg-gray-50 p-4 dark:bg-gray-700">
                            <div class="rounded-lg bg-purple-100 p-3 dark:bg-purple-900">
                                <svg class="h-6 w-6 text-purple-600 dark:text-purple-300" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 20l4-16m2 16l4-16M6 9h14M4 15h14"/>
                                </svg>
                            </div>
                            <div>
                                <p class="text-sm font-medium text-gray-600 dark:text-gray-400">ID de Rol</p>
                                <p class="mt-1 text-2xl font-bold text-gray-900 dark:text-gray-100">#{{ $rol->Rol_ID }}</p>
                            </div>
                        </div>

                        <div class="flex items-start gap-4 rounded-xl bg-gray-50 p-4 dark:bg-gray-700">
                            <div class="rounded-lg bg-blue-100 p-3 dark:bg-blue-900">
                                <svg class="h-6 w-6 text-blue-600 dark:text-blue-300" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"/>
                                </svg>
                            </div>
                            <div>
                                <p class="text-sm font-medium text-gray-600 dark:text-gray-400">Tipo de Rol</p>
                                <p class="mt-1 text-xl font-bold text-gray-900 dark:text-gray-100">{{ $rol->Rol_Tipo }}</p>
                            </div>
                        </div>

                        <div class="flex items-start gap-4 rounded-xl bg-gray-50 p-4 dark:bg-gray-700">
                            <div class="rounded-lg bg-emerald-100 p-3 dark:bg-emerald-900">
                                <svg class="h-6 w-6 text-emerald-600 dark:text-emerald-300" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z"/>
                                </svg>
                            </div>
                            <div>
                                <p class="text-sm font-medium text-gray-600 dark:text-gray-400">Nivel de Accesos</p>
                                <span class="mt-1 inline-flex items-center gap-1 rounded-full bg-blue-100 px-3 py-1 text-sm font-semibold text-blue-800 dark:bg-blue-900 dark:text-blue-200">
                                    {{ $rol->Rol_Accesos }}
                                </span>
                            </div>
                        </div>

                        <div class="flex items-start gap-4 rounded-xl bg-gray-50 p-4 dark:bg-gray-700">
                            <div class="rounded-lg bg-amber-100 p-3 dark:bg-amber-900">
                                <svg class="h-6 w-6 text-amber-600 dark:text-amber-300" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 13.255A23.931 23.931 0 0112 15c-3.183 0-6.22-.62-9-1.745M16 6V4a2 2 0 00-2-2h-4a2 2 0 00-2 2v2m4 6h.01M5 20h14a2 2 0 002-2V8a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"/>
                                </svg>
                            </div>
                            <div>
                                <p class="text-sm font-medium text-gray-600 dark:text-gray-400">Trabajador Asignado</p>
                                @if($rol->Trabajador_ID)
                                    <p class="mt-1 text-lg font-bold text-gray-900 dark:text-gray-100">ID: {{ $rol->Trabajador_ID }}</p>
                                @else
                                    <p class="mt-1 text-lg font-semibold text-gray-400 dark:text-gray-500">Sin asignar</p>
                                @endif
                            </div>
                        </div>

                    </div>
                </div>

            </div>

            @if($rol->ordenesProduccion && $rol->ordenesProduccion->count() > 0)
            <div class="overflow-hidden rounded-2xl bg-white shadow-2xl dark:bg-gray-800">
                <div class="border-b border-gray-200 bg-gradient-to-r from-gray-50 to-gray-100 px-6 py-4 dark:border-gray-700 dark:from-gray-700 dark:to-gray-800">
                    <h3 class="text-lg font-bold text-gray-800 dark:text-gray-100">Órdenes de Producción Asignadas</h3>
                    <p class="mt-1 text-sm text-gray-600 dark:text-gray-400">
                        Total: {{ $rol->ordenesProduccion->count() }} órdenes
                    </p>
                </div>
                <div class="p-6">
                    <div class="space-y-3">
                        @foreach($rol->ordenesProduccion as $orden)
                        <div class="flex items-center justify-between rounded-lg border border-gray-200 p-4 transition-all hover:bg-gray-50 dark:border-gray-700 dark:hover:bg-gray-700">
                            <div class="flex items-center gap-3">
                                <div class="rounded-lg bg-indigo-100 p-2 dark:bg-indigo-900">
                                    <svg class="h-5 w-5 text-indigo-600 dark:text-indigo-300" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2"/>
                                    </svg>
                                </div>
                                <div>
                                    <p class="font-semibold text-gray-900 dark:text-gray-100">Orden #{{ $orden->Ord_Produc_ID }}</p>
                                    <p class="text-sm text-gray-500 dark:text-gray-400">
                                        Cantidad: {{ $orden->Ord_Prod_Cantidad }} - Estado: {{ $orden->Ord_Prod_Estado }}
                                    </p>
                                </div>
                            </div>
                            <a href="{{ route('orden_produccion.show', $orden->Ord_Produc_ID) }}" 
                               class="rounded-lg bg-indigo-100 px-3 py-2 text-sm font-semibold text-indigo-600 transition-all hover:bg-indigo-600 hover:text-white dark:bg-indigo-900 dark:text-indigo-300">
                                Ver detalle →
                            </a>
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