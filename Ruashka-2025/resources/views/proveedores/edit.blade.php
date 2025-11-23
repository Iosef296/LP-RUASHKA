<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <x-layouts.app :title="__('Editar Proveedor')">
    <div class="py-8">
        <div class="mx-auto max-w-4xl sm:px-6 lg:px-8">
            
            <div class="mb-6 flex items-center justify-between">
                <div>
                    <h2 class="text-3xl font-bold text-gray-800 dark:text-gray-100">
                        ✏️ Editar Proveedor #{{ $proveedor->Proveedor_ID }}
                    </h2>
                    <p class="mt-1 text-sm text-gray-600 dark:text-gray-400">
                        Actualiza la información del proveedor
                    </p>
                </div>
                <a href="{{ route('proveedores.index') }}" 
                   class="inline-flex items-center gap-2 rounded-lg bg-gray-200 px-4 py-2 text-sm font-semibold text-gray-700 transition-all hover:bg-gray-300 dark:bg-gray-700 dark:text-gray-300 dark:hover:bg-gray-600">
                    <svg class="h-4 w-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"/>
                    </svg>
                    Volver
                </a>
            </div>

            <div class="overflow-hidden rounded-2xl bg-white shadow-2xl dark:bg-gray-800">
                
                <div class="border-b border-gray-200 bg-gradient-to-r from-indigo-50 to-purple-50 px-6 py-4 dark:border-gray-700 dark:from-gray-700 dark:to-gray-800">
                    <h3 class="text-lg font-bold text-gray-800 dark:text-gray-100">Información del Proveedor</h3>
                </div>

                <form action="{{ route('proveedores.update', $proveedor->Proveedor_ID) }}" method="POST" class="p-6">
                    @csrf
                    @method('PUT')

                    <div class="space-y-6">
                        
                        <div>
                            <label for="Proveedor_Nombre" class="mb-2 block text-sm font-bold text-gray-700 dark:text-gray-300">
                                🏢 Nombre del Proveedor *
                            </label>
                            <input type="text" 
                                   name="Proveedor_Nombre" 
                                   id="Proveedor_Nombre"
                                   value="{{ old('Proveedor_Nombre', $proveedor->Proveedor_Nombre) }}"
                                   class="w-full rounded-lg border border-gray-300 px-4 py-3 transition-all focus:border-indigo-500 focus:ring-2 focus:ring-indigo-500 dark:border-gray-600 dark:bg-gray-700 dark:text-gray-100 @error('Proveedor_Nombre') border-red-500 @enderror"
                                   required>
                            @error('Proveedor_Nombre')
                                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>

                        <div class="grid gap-6 md:grid-cols-2">
                            
                            <div>
                                <label for="Proveedor_RUC" class="mb-2 block text-sm font-bold text-gray-700 dark:text-gray-300">
                                    🔢 RUC *
                                </label>
                                <input type="text" 
                                       name="Proveedor_RUC" 
                                       id="Proveedor_RUC"
                                       value="{{ old('Proveedor_RUC', $proveedor->Proveedor_RUC) }}"
                                       maxlength="30"
                                       class="w-full rounded-lg border border-gray-300 px-4 py-3 transition-all focus:border-indigo-500 focus:ring-2 focus:ring-indigo-500 dark:border-gray-600 dark:bg-gray-700 dark:text-gray-100 @error('Proveedor_RUC') border-red-500 @enderror"
                                       required>
                                @error('Proveedor_RUC')
                                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                @enderror
                            </div>

                            <div>
                                <label for="Proveedor_Telefono" class="mb-2 block text-sm font-bold text-gray-700 dark:text-gray-300">
                                    📞 Teléfono *
                                </label>
                                <input type="text" 
                                       name="Proveedor_Telefono" 
                                       id="Proveedor_Telefono"
                                       value="{{ old('Proveedor_Telefono', $proveedor->Proveedor_Telefono) }}"
                                       maxlength="12"
                                       class="w-full rounded-lg border border-gray-300 px-4 py-3 transition-all focus:border-indigo-500 focus:ring-2 focus:ring-indigo-500 dark:border-gray-600 dark:bg-gray-700 dark:text-gray-100 @error('Proveedor_Telefono') border-red-500 @enderror"
                                       required>
                                @error('Proveedor_Telefono')
                                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                @enderror
                            </div>

                        </div>

                        <div>
                            <label for="Proveedor_Rubro" class="mb-2 block text-sm font-bold text-gray-700 dark:text-gray-300">
                                🏷️ Rubro *
                            </label>
                            <input type="text" 
                                   name="Proveedor_Rubro" 
                                   id="Proveedor_Rubro"
                                   value="{{ old('Proveedor_Rubro', $proveedor->Proveedor_Rubro) }}"
                                   maxlength="50"
                                   class="w-full rounded-lg border border-gray-300 px-4 py-3 transition-all focus:border-indigo-500 focus:ring-2 focus:ring-indigo-500 dark:border-gray-600 dark:bg-gray-700 dark:text-gray-100 @error('Proveedor_Rubro') border-red-500 @enderror"
                                   required>
                            @error('Proveedor_Rubro')
                                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>

                        <div>
                            <label for="Proveedor_Direccion" class="mb-2 block text-sm font-bold text-gray-700 dark:text-gray-300">
                                📍 Dirección *
                            </label>
                            <textarea name="Proveedor_Direccion" 
                                      id="Proveedor_Direccion"
                                      rows="3"
                                      class="w-full rounded-lg border border-gray-300 px-4 py-3 transition-all focus:border-indigo-500 focus:ring-2 focus:ring-indigo-500 dark:border-gray-600 dark:bg-gray-700 dark:text-gray-100 @error('Proveedor_Direccion') border-red-500 @enderror"
                                      required>{{ old('Proveedor_Direccion', $proveedor->Proveedor_Direccion) }}</textarea>
                            @error('Proveedor_Direccion')
                                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>

                    </div>

                    <div class="mt-8 flex items-center justify-end gap-4 border-t border-gray-200 pt-6 dark:border-gray-700">
                        <a href="{{ route('proveedores.index') }}" 
                           class="rounded-lg bg-gray-200 px-6 py-3 font-semibold text-gray-700 transition-all hover:bg-gray-300 dark:bg-gray-700 dark:text-gray-300 dark:hover:bg-gray-600">
                            Cancelar
                        </a>
                        <button type="submit" 
                                class="inline-flex items-center gap-2 rounded-lg bg-gradient-to-r from-indigo-600 to-purple-600 px-6 py-3 font-semibold text-white shadow-lg transition-all hover:scale-105 hover:shadow-xl">
                            <svg class="h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/>
                            </svg>
                            Actualizar Proveedor
                        </button>
                    </div>

                </form>

            </div>

        </div>
    </div>
</x-layouts.app>

</body>
</html>