<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
   <x-layouts.app :title="__('Detalle del Proveedor')">
    <div class="py-8">
        <div class="mx-auto max-w-4xl sm:px-6 lg:px-8">
            
            <div class="mb-6 flex items-center justify-between">
                <div>
                    <h2 class="text-3xl font-bold text-gray-800 dark:text-gray-100">
                        👤 Proveedor #{{ $proveedor->Proveedor_ID }}
                    </h2>
                    <p class="mt-1 text-sm text-gray-600 dark:text-gray-400">
                        Información completa del proveedor
                    </p>
                </div>
                <div class="flex gap-3">
                    <a href="{{ route('proveedores.edit', $proveedor->Proveedor_ID) }}" 
                       class="inline-flex items-center gap-2 rounded-lg bg-blue-600 px-4 py-2 text-sm font-semibold text-white transition-all hover:bg-blue-700">
                        <svg class="h-4 w-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"/>
                        </svg>
                        Editar
                    </a>
                    <a href="{{ route('proveedores.index') }}" 
                       class="inline-flex items-center gap-2 rounded-lg bg-gray-200 px-4 py-2 text-sm font-semibold text-gray-700 transition-all hover:bg-gray-300 dark:bg-gray-700 dark:text-gray-300 dark:hover:bg-gray-600">
                        <svg class="h-4 w-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"/>
                        </svg>
                        Volver
                    </a>
                </div>
            </div>

            <div class="overflow-hidden rounded-2xl bg-white shadow-2xl dark:bg-gray-800">
                
                <div class="border-b border-gray-200 bg-gradient-to-r from-indigo-50 to-indigo-100 px-6 py-4 dark:border-gray-700 dark:from-gray-700 dark:to-gray-800">
                    <h3 class="text-lg font-bold text-gray-800 dark:text-gray-100">Datos del Proveedor</h3>
                </div>

                <div class="p-6">
                    <div class="space-y-6">
                        
                        <div class="flex items-start gap-4 rounded-xl bg-gray-50 p-4 dark:bg-gray-700">
                            <div class="rounded-lg bg-indigo-100 p-3 dark:bg-indigo-900">
                                <svg class="h-6 w-6 text-indigo-600 dark:text-indigo-300" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 20l4-16m2 16l4-16M6 9h14M4 15h14"/>
                                </svg>
                            </div>
                            <div class="flex-1">
                                <p class="text-sm font-medium text-gray-600 dark:text-gray-400">ID del Proveedor</p>
                                <p class="mt-1 text-2xl font-bold text-gray-900 dark:text-gray-100">#{{ $proveedor->Proveedor_ID }}</p>
                            </div>
                        </div>

                        <div class="flex items-start gap-4 rounded-xl bg-gray-50 p-4 dark:bg-gray-700">
                            <div class="rounded-lg bg-blue-100 p-3 dark:bg-blue-900">
                                <svg class="h-6 w-6 text-blue-600 dark:text-blue-300" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"/>
                                </svg>
                            </div>
                            <div class="flex-1">
                                <p class="text-sm font-medium text-gray-600 dark:text-gray-400">Nombre de la Empresa</p>
                                <p class="mt-1 text-lg font-bold text-gray-900 dark:text-gray-100">{{ $proveedor->Proveedor_Nombre }}</p>
                            </div>
                        </div>

                        <div class="grid gap-6 md:grid-cols-2">
                            
                            <div class="flex items-start gap-4 rounded-xl bg-gray-50 p-4 dark:bg-gray-700">
                                <div class="rounded-lg bg-purple-100 p-3 dark:bg-purple-900">
                                    <svg class="h-6 w-6 text-purple-600 dark:text-purple-300" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/>
                                    </svg>
                                </div>
                                <div class="flex-1">
                                    <p class="text-sm font-medium text-gray-600 dark:text-gray-400">RUC</p>
                                    <p class="mt-1 font-mono text-lg font-bold text-gray-900 dark:text-gray-100">{{ $proveedor->Proveedor_RUC }}</p>
                                </div>
                            </div>

                            <div class="flex items-start gap-4 rounded-xl bg-gray-50 p-4 dark:bg-gray-700">
                                <div class="rounded-lg bg-emerald-100 p-3 dark:bg-emerald-900">
                                    <svg class="h-6 w-6 text-emerald-600 dark:text-emerald-300" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z"/>
                                    </svg>
                                </div>
                                <div class="flex-1">
                                    <p class="text-sm font-medium text-gray-600 dark:text-gray-400">Teléfono</p>
                                    <p class="mt-1 text-lg font-bold text-gray-900 dark:text-gray-100">{{ $proveedor->Proveedor_Telefono }}</p>
                                </div>
                            </div>

                        </div>

                        <div class="flex items-start gap-4 rounded-xl bg-gray-50 p-4 dark:bg-gray-700">
                            <div class="rounded-lg bg-amber-100 p-3 dark:bg-amber-900">
                                <svg class="h-6 w-6 text-amber-600 dark:text-amber-300" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 7h.01M7 3h5c.512 0 1.024.195 1.414.586l7 7a2 2 0 010 2.828l-7 7a2 2 0 01-2.828 0l-7-7A1.994 1.994 0 013 12V7a4 4 0 014-4z"/>
                                </svg>
                            </div>
                            <div class="flex-1">
                                <p class="text-sm font-medium text-gray-600 dark:text-gray-400">Rubro</p>
                                <p class="mt-1 text-lg font-semibold text-gray-900 dark:text-gray-100">{{ $proveedor->Proveedor_Rubro }}</p>
                            </div>
                        </div>

                        <div class="flex items-start gap-4 rounded-xl bg-gray-50 p-4 dark:bg-gray-700">
                            <div class="rounded-lg bg-indigo-100 p-3 dark:bg-indigo-900">
                                <svg class="h-6 w-6 text-indigo-600 dark:text-indigo-300" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"/>
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"/>
                                </svg>
                            </div>
                            <div class="flex-1">
                                <p class="text-sm font-medium text-gray-600 dark:text-gray-400">Dirección</p>
                                <p class="mt-1 text-gray-900 dark:text-gray-100">{{ $proveedor->Proveedor_Direccion }}</p>
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