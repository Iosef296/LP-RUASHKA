<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <x-layouts.app :title="__('Nueva Materia Prima')">
    <div class="py-8">
        <div class="mx-auto max-w-4xl sm:px-6 lg:px-8">
            
            <div class="mb-6 flex items-center justify-between">
                <div>
                    <h2 class="text-3xl font-bold text-gray-800 dark:text-gray-100">
                        Nueva Materia Prima
                    </h2>
                    <p class="mt-1 text-sm text-gray-600 dark:text-gray-400">
                        Registra nueva lana o insumos para producción
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

                <form action="{{ route('materia_prima.store') }}" method="POST" class="p-6">
                    @csrf

                    <div class="space-y-6">
                        
                        <!-- Nombre -->
                        <div>
                            <label for="Materia_Nombre" class="mb-2 block text-sm font-bold text-gray-700 dark:text-gray-300">
                                🧶 Nombre de la Materia Prima *
                            </label>
                            <input type="text" 
                                   name="Materia_Nombre" 
                                   id="Materia_Nombre"
                                   value="{{ old('Materia_Nombre') }}"
                                   placeholder="Ej: Lana de Alpaca, Lana Merino, Botones"
                                   class="w-full rounded-lg border border-gray-300 px-4 py-3 transition-all focus:border-emerald-500 focus:ring-2 focus:ring-emerald-500 dark:border-gray-600 dark:bg-gray-700 dark:text-gray-100 @error('Materia_Nombre') border-red-500 @enderror"
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
                                      placeholder="Describe las características de la materia prima..."
                                      class="w-full rounded-lg border border-gray-300 px-4 py-3 transition-all focus:border-emerald-500 focus:ring-2 focus:ring-emerald-500 dark:border-gray-600 dark:bg-gray-700 dark:text-gray-100 @error('Materia_Descripcion') border-red-500 @enderror"
                                      required>{{ old('Materia_Descripcion') }}</textarea>
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
                                    class="w-full rounded-lg border border-gray-300 px-4 py-3 transition-all focus:border-emerald-500 focus:ring-2 focus:ring-emerald-500 dark:border-gray-600 dark:bg-gray-700 dark:text-gray-100 @error('Materia_Unidad_Medida') border-red-500 @enderror"
                                    required>
                                <option value="">Seleccionar unidad...</option>
                                <option value="Kilogramos (kg)" {{ old('Materia_Unidad_Medida') == 'Kilogramos (kg)' ? 'selected' : '' }}>Kilogramos (kg)</option>
                                <option value="Gramos (g)" {{ old('Materia_Unidad_Medida') == 'Gramos (g)' ? 'selected' : '' }}>Gramos (g)</option>
                                <option value="Metros (m)" {{ old('Materia_Unidad_Medida') == 'Metros (m)' ? 'selected' : '' }}>Metros (m)</option>
                                <option value="Unidades (u)" {{ old('Materia_Unidad_Medida') == 'Unidades (u)' ? 'selected' : '' }}>Unidades (u)</option>
                                <option value="Ovillos" {{ old('Materia_Unidad_Medida') == 'Ovillos' ? 'selected' : '' }}>Ovillos</option>
                                <option value="Madejas" {{ old('Materia_Unidad_Medida') == 'Madejas' ? 'selected' : '' }}>Madejas</option>
                            </select>
                            @error('Materia_Unidad_Medida')
                                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- Stock Inicial -->
                        <div>
                            <label for="Materia_Stock" class="mb-2 block text-sm font-bold text-gray-700 dark:text-gray-300">
                                📦 Stock Inicial *
                            </label>
                            <input type="number" 
                                   name="Materia_Stock" 
                                   id="Materia_Stock"
                                   value="{{ old('Materia_Stock', 0) }}"
                                   min="0"
                                   placeholder="Ej: 100"
                                   class="w-full rounded-lg border border-gray-300 px-4 py-3 transition-all focus:border-emerald-500 focus:ring-2 focus:ring-emerald-500 dark:border-gray-600 dark:bg-gray-700 dark:text-gray-100 @error('Materia_Stock') border-red-500 @enderror"
                                   required>
                            @error('Materia_Stock')
                                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                            <p class="mt-1 text-xs text-gray-500 dark:text-gray-400">Cantidad inicial disponible en inventario</p>
                        </div>

                        <!-- Orden de Producción -->
                        <div>
                            <label for="Ord_Produc_ID" class="mb-2 block text-sm font-bold text-gray-700 dark:text-gray-300">
                                📋 Orden de Producción Asociada *
                            </label>
                            <select name="Ord_Produc_ID" 
                                    id="Ord_Produc_ID"
                                    class="w-full rounded-lg border border-gray-300 px-4 py-3 transition-all focus:border-emerald-500 focus:ring-2 focus:ring-emerald-500 dark:border-gray-600 dark:bg-gray-700 dark:text-gray-100 @error('Ord_Produc_ID') border-red-500 @enderror"
                                    required>
                                <option value="">Seleccionar orden...</option>
                                @foreach($ordenes as $orden)
                                    <option value="{{ $orden->Ord_Produc_ID }}" {{ old('Ord_Produc_ID') == $orden->Ord_Produc_ID ? 'selected' : '' }}>
                                        Orden #{{ $orden->Ord_Produc_ID }} - {{ $orden->Ord_Prod_Cantidad }} unidades ({{ $orden->Ord_Prod_Estado }})
                                    </option>
                                @endforeach
                            </select>
                            @error('Ord_Produc_ID')
                                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- Info box -->
                        <div class="rounded-lg border border-indigo-200 bg-indigo-50 p-4 dark:border-indigo-800 dark:bg-indigo-900/20">
                            <div class="flex gap-3">
                                <svg class="h-5 w-5 flex-shrink-0 text-indigo-600 dark:text-indigo-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
                                </svg>
                                <div class="text-sm">
                                    <p class="font-medium text-indigo-900 dark:text-indigo-200">Consejo</p>
                                    <p class="mt-1 text-indigo-800 dark:text-indigo-300">
                                        Registra todas las materias primas necesarias (lanas, botones, cierres, etiquetas) 
                                        para llevar un control preciso de tu inventario.
                                    </p>
                                </div>
                            </div>
                        </div>

                    </div>

                    <div class="mt-8 flex items-center justify-end gap-4 border-t border-gray-200 pt-6 dark:border-gray-700">
                        <a href="{{ route('materia_prima.index') }}" 
                           class="rounded-lg bg-gray-200 px-6 py-3 font-semibold text-gray-700 transition-all hover:bg-gray-300 dark:bg-gray-700 dark:text-gray-300 dark:hover:bg-gray-600">
                            Cancelar
                        </a>
                        <button type="submit" 
                                class="inline-flex items-center gap-2 rounded-lg bg-gradient-to-r from-indigo-600 to-purple-600 px-6 py-3 font-semibold text-white shadow-lg transition-all hover:scale-105 hover:shadow-xl">
                            <svg class="h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/>
                            </svg>
                            Guardar Materia Prima
                        </button>
                    </div>

                </form>

            </div>

        </div>
    </div>
</x-layouts.app>
</body>
</html>