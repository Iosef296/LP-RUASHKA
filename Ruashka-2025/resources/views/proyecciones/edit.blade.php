<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <x-layouts.app :title="__('Editar Proyección')">
    <div class="py-8">
        <div class="mx-auto max-w-4xl sm:px-6 lg:px-8">
            
            <div class="mb-6 flex items-center justify-between">
                <div>
                    <h2 class="text-3xl font-bold text-gray-800 dark:text-gray-100">
                        ✏️ Editar Proyección #{{ $proyeccion->Proyec_ID }}
                    </h2>
                    <p class="mt-1 text-sm text-gray-600 dark:text-gray-400">
                        Actualiza la información de la proyección
                    </p>
                </div>
                <a href="{{ route('proyecciones.index') }}" 
                   class="inline-flex items-center gap-2 rounded-lg bg-gray-200 px-4 py-2 text-sm font-semibold text-gray-700 transition-all hover:bg-gray-300 dark:bg-gray-700 dark:text-gray-300 dark:hover:bg-gray-600">
                    <svg class="h-4 w-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"/>
                    </svg>
                    Volver
                </a>
            </div>

            <div class="overflow-hidden rounded-2xl bg-white shadow-2xl dark:bg-gray-800">
                
                <div class="border-b border-gray-200 bg-gradient-to-r from-blue-50 to-cyan-50 px-6 py-4 dark:border-gray-700 dark:from-gray-700 dark:to-gray-800">
                    <h3 class="text-lg font-bold text-gray-800 dark:text-gray-100">Información de la Proyección</h3>
                </div>

                <form action="{{ route('proyecciones.update', $proyeccion->Proyec_ID) }}" method="POST" class="p-6">
                    @csrf
                    @method('PUT')

                    <div class="space-y-6">
                        
                        <div>
                            <label for="Proyec_Nombre" class="mb-2 block text-sm font-bold text-gray-700 dark:text-gray-300">
                                📝 Nombre de la Proyección *
                            </label>
                            <input type="text" 
                                   name="Proyec_Nombre" 
                                   id="Proyec_Nombre"
                                   value="{{ old('Proyec_Nombre', $proyeccion->Proyec_Nombre) }}"
                                   class="w-full rounded-lg border border-gray-300 px-4 py-3 transition-all focus:border-blue-500 focus:ring-2 focus:ring-blue-500 dark:border-gray-600 dark:bg-gray-700 dark:text-gray-100 @error('Proyec_Nombre') border-red-500 @enderror"
                                   required>
                            @error('Proyec_Nombre')
                                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>

                        <div>
                            <label for="Proyec_Descripcion" class="mb-2 block text-sm font-bold text-gray-700 dark:text-gray-300">
                                📄 Descripción *
                            </label>
                            <textarea name="Proyec_Descripcion" 
                                      id="Proyec_Descripcion"
                                      rows="4"
                                      class="w-full rounded-lg border border-gray-300 px-4 py-3 transition-all focus:border-blue-500 focus:ring-2 focus:ring-blue-500 dark:border-gray-600 dark:bg-gray-700 dark:text-gray-100 @error('Proyec_Descripcion') border-red-500 @enderror"
                                      required>{{ old('Proyec_Descripcion', $proyeccion->Proyec_Descripcion) }}</textarea>
                            @error('Proyec_Descripcion')
                                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>

                        <div>
                            <label for="Proyec_tipo" class="mb-2 block text-sm font-bold text-gray-700 dark:text-gray-300">
                                🏷️ Tipo de Proyección *
                            </label>
                            <select name="Proyec_tipo" 
                                    id="Proyec_tipo"
                                    class="w-full rounded-lg border border-gray-300 px-4 py-3 transition-all focus:border-blue-500 focus:ring-2 focus:ring-blue-500 dark:border-gray-600 dark:bg-gray-700 dark:text-gray-100 @error('Proyec_tipo') border-red-500 @enderror"
                                    required>
                                <option value="Mensual" {{ old('Proyec_tipo', $proyeccion->Proyec_tipo) == 'Mensual' ? 'selected' : '' }}>Mensual</option>
                                <option value="Trimestral" {{ old('Proyec_tipo', $proyeccion->Proyec_tipo) == 'Trimestral' ? 'selected' : '' }}>Trimestral</option>
                                <option value="Semestral" {{ old('Proyec_tipo', $proyeccion->Proyec_tipo) == 'Semestral' ? 'selected' : '' }}>Semestral</option>
                                <option value="Anual" {{ old('Proyec_tipo', $proyeccion->Proyec_tipo) == 'Anual' ? 'selected' : '' }}>Anual</option>
                            </select>
                            @error('Proyec_tipo')
                                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>

                    </div>

                    <div class="mt-8 flex items-center justify-end gap-4 border-t border-gray-200 pt-6 dark:border-gray-700">
                        <a href="{{ route('proyecciones.index') }}" 
                           class="rounded-lg bg-gray-200 px-6 py-3 font-semibold text-gray-700 transition-all hover:bg-gray-300 dark:bg-gray-700 dark:text-gray-300 dark:hover:bg-gray-600">
                            Cancelar
                        </a>
                        <button type="submit" 
                                class="inline-flex items-center gap-2 rounded-lg bg-gradient-to-r from-blue-600 to-cyan-600 px-6 py-3 font-semibold text-white shadow-lg transition-all hover:scale-105 hover:shadow-xl">
                            <svg class="h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/>
                            </svg>
                            Actualizar Proyección
                        </button>
                    </div>

                </form>

            </div>

        </div>
    </div>
</x-layouts.app>
</body>
</html>