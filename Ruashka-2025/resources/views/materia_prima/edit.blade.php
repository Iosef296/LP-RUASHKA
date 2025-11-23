<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <x-layouts.app :title="__('Editar Materia Prima')">
    <div class="py-8">
        <div class="mx-auto max-w-4xl sm:px-6 lg:px-8">
            
            <div class="mb-6 flex items-center justify-between">
                <div>
                    <h2 class="text-3xl font-bold text-gray-800 dark:text-gray-100">
                        Editar Materia Prima #{{ $materia->Materia_ID }}
                    </h2>
                    <p class="mt-1 text-sm text-gray-600 dark:text-gray-400">
                        Actualiza la información de la materia prima
                    </p>
                </div>
                <a href="{{ route('materia_prima.index') }}" 
                   class="inline-flex items-center gap-2 rounded-lg bg-gray-200 px-4 py-2 text-sm font-semibold text-gray-700 transition-all hover:bg-gray-300 dark:bg-gray-700 dark:text-gray-300 dark:hover:bg-gray-600">
                    <svg class="h-4 w-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"/>
                    </svg>
                    Volver
                </a>
            </div>

            <div class="overflow-hidden rounded-2xl bg-white shadow-2xl dark:bg-gray-800">
                
                <div class="border-b border-gray-200 bg-gradient-to-r from-gray-50 to-gray-100 px-6 py-4 dark:border-gray-700 dark:from-gray-700 dark:to-gray-800">
                    <h3 class="text-lg font-bold text-gray-800 dark:text-gray-100">Información de la Materia Prima</h3>
                </div>

                <form action="{{ route('materia_prima.update', $materia->Materia_ID) }}" method="POST" class="p-6">
                    @csrf
                    @method('PUT')

                    <div class="space-y-6">
                        
                        <!-- Nombre -->
                        <div>
                            <label for="Materia_Nombre" class="mb-2 block text-sm font-bold text-gray-700 dark:text-gray-300">
                                🧶 Nombre de la Materia Prima *
                            </label>
                            <input type="text" 
                                   name="Materia_Nombre" 
                                   id="Materia_Nombre"
                                   value="{{ old('Materia_Nombre', $materia->Materia_Nombre) }}"
                                   class="w-full rounded-lg border border-gray-300 px-4 py-3 transition-all focus:border-blue-500 focus:ring-2 focus:ring-blue-500 dark:border-gray-600 dark:bg-gray-700 dark:text-gray-100 @error('Materia_Nombre') border-red-500 @enderror"
                                   required>
                            @error('Materia_Nombre')
                                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- Descripción -->
                        <div>
                            <label for="Materia_Descripcion" class="mb-2 block text-sm font-bold text-gray-700 dark:text-gray-300">
                                📝 Descripción *
                            </label>
                            <textarea name="Materia_Descripcion" 
                                      id="Materia_Descripcion"
                                      rows="4"
                                      class="w-full rounded-lg border border-gray-300 px-4 py-3 transition-all focus:border-blue-500 focus:ring-2 focus:ring-blue-500 dark:border-gray-600 dark:bg-gray-700 dark:text-gray-100 @error('Materia_Descripcion') border-red-500 @enderror"
                                      required>{{ old('Materia_Descripcion', $materia->Materia_Descripcion) }}</textarea>
                            @error('Materia_Descripcion')
                                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- Unidad de Medida -->
                        <div>
                            <label for="Materia_Unidad_Medida" class="mb-2 block text-sm font-bold text-gray-700 dark:text-gray-300">
                                📏 Unidad de Medida *
                            </label>
                            <select name="Materia_Unidad_Medida" 
                                    id="Materia_Unidad_Medida"
                                    class="w-full rounded-lg border border-gray-300 px-4 py-3 transition-all focus:border-blue-500 focus:ring-2 focus:ring-blue-500 dark:border-gray-600 dark:bg-gray-700 dark:text-gray-100 @error('Materia_Unidad_Medida') border-red-500 @enderror"
                                    required>
                                <option value="Kilogramos (kg)" {{ old('Materia_Unidad_Medida', $materia->Materia_Unidad_Medida) == 'Kilogramos (kg)' ? 'selected' : '' }}>Kilogramos (kg)</option>
                                <option value="Gramos (g)" {{ old('Materia_Unidad_Medida', $materia->Materia_Unidad_Medida) == 'Gramos (g)' ? 'selected' : '' }}>Gramos (g)</option>
                                <option value="Metros (m)" {{ old('Materia_Unidad_Medida', $materia->Materia_Unidad_Medida) == 'Metros (m)' ? 'selected' : '' }}>Metros (m)</option>
                                <option value="Unidades (u)" {{ old('Materia_Unidad_Medida', $materia->Materia_Unidad_Medida) == 'Unidades (u)' ? 'selected' : '' }}>Unidades (u)</option>
                                <option value="Ovillos" {{ old('Materia_Unidad_Medida', $materia->Materia_Unidad_Medida) == 'Ovillos' ? 'selected' : '' }}>Ovillos</option>
                                <option value="Madejas" {{ old('Materia_Unidad_Medida', $materia->Materia_Unidad_Medida) == 'Madejas' ? 'selected' : '' }}>Madejas</option>
                            </select>
                            @error('Materia_Unidad_Medida')
                                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- Stock -->
                        <div>
                            <label for="Materia_Stock" class="mb-2 block text-sm font-bold text-gray-700 dark:text-gray-300">
                                📦 Stock Actual *
                            </label>
                            <input type="number" 
                                   name="Materia_Stock" 
                                   id="Materia_Stock"
                                   value="{{ old('Materia_Stock', $materia->Materia_Stock) }}"
                                   min="0"
                                   class="w-full rounded-lg border border-gray-300 px-4 py-3 transition-all focus:border-blue-500 focus:ring-2 focus:ring-blue-500 dark:border-gray-600 dark:bg-gray-700 dark:text-gray-100 @error('Materia_Stock') border-red-500 @enderror"
                                   required>
                            @error('Materia_Stock')
                                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                            @if($materia->Materia_Stock < 10)
                                <p class="mt-1 text-sm text-red-600">⚠️ Stock bajo - Considera reponer pronto</p>
                            @elseif($materia->Materia_Stock < 50)
                                <p class="mt-1 text-sm text-yellow-600">⚡ Stock medio - Monitorea el nivel</p>
                            @else
                                <p class="mt-1 text-sm text-green-600">✓ Stock adecuado</p>
                            @endif
                        </div>

                        <!-- Orden de Producción -->
                        <div>
                            <label for="Ord_Produc_ID" class="mb-2 block text-sm font-bold text-gray-700 dark:text-gray-300">
                                📋 Orden de Producción Asociada *
                            </label>
                            <select name="Ord_Produc_ID" 
                                    id="Ord_Produc_ID"
                                    class="w-full rounded-lg border border-gray-300 px-4 py-3 transition-all focus:border-blue-500 focus:ring-2 focus:ring-blue-500 dark:border-gray-600 dark:bg-gray-700 dark:text-gray-100 @error('Ord_Produc_ID') border-red-500 @enderror"
                                    required>
                                @foreach($ordenes as $orden)
                                    <option value="{{ $orden->Ord_Produc_ID }}" {{ old('Ord_Produc_ID', $materia->Ord_Produc_ID) == $orden->Ord_Produc_ID ? 'selected' : '' }}>
                                        Orden #{{ $orden->Ord_Produc_ID }} - {{ $orden->Ord_Prod_Cantidad }} unidades ({{ $orden->Ord_Prod_Estado }})
                                    </option>
                                @endforeach
                            </select>
                            @error('Ord_Produc_ID')
                                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>

                    </div>

                    <div class="mt-8 flex items-center justify-end gap-4 border-t border-gray-200 pt-6 dark:border-gray-700">
                        <a href="{{ route('materia_prima.index') }}" 
                           class="rounded-lg bg-gray-200 px-6 py-3 font-semibold text-gray-700 transition-all hover:bg-gray-300 dark:bg-gray-700 dark:text-gray-300 dark:hover:bg-gray-600">
                            Cancelar
                        </a>
                        <button type="submit" 
                                class="inline-flex items-center gap-2 rounded-lg bg-gradient-to-r from-blue-600 to-cyan-600 px-6 py-3 font-semibold text-white shadow-lg transition-all hover:scale-105 hover:shadow-xl">
                            <svg class="h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/>
                            </svg>
                            Actualizar Materia Prima
                        </button>
                    </div>

                </form>

            </div>

        </div>
    </div>
</x-layouts.app>
</body>
</html>