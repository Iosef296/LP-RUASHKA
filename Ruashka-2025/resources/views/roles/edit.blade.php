<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <x-layouts.app :title="__('Editar Rol')">
    <div class="py-8">
        <div class="mx-auto max-w-4xl sm:px-6 lg:px-8">
            
            <div class="mb-6 flex items-center justify-between">
                <div>
                    <h2 class="text-3xl font-bold text-gray-800 dark:text-gray-100">
                        Editar Rol #{{ $rol->Rol_ID }}
                    </h2>
                    <p class="mt-1 text-sm text-gray-600 dark:text-gray-400">
                        Actualiza la información y permisos del rol
                    </p>
                </div>
                <a href="{{ route('roles.index') }}" 
                   class="inline-flex items-center gap-2 rounded-lg bg-gray-200 px-4 py-2 text-sm font-semibold text-gray-700 transition-all hover:bg-gray-300 dark:bg-gray-700 dark:text-gray-300 dark:hover:bg-gray-600">
                    <svg class="h-4 w-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"/>
                    </svg>
                    Volver
                </a>
            </div>

            <div class="overflow-hidden rounded-2xl bg-white shadow-2xl dark:bg-gray-800">
                
                <div class="border-b border-gray-200 bg-gradient-to-r from-gray-50 to-gray-100 px-6 py-4 dark:border-gray-700 dark:from-gray-700 dark:to-gray-800">
                    <h3 class="text-lg font-bold text-gray-800 dark:text-gray-100">Información del Rol</h3>
                </div>

                <form action="{{ route('roles.update', $rol->Rol_ID) }}" method="POST" class="p-6">
                    @csrf
                    @method('PUT')

                    <div class="space-y-6">
                        
                        <div>
                            <label for="Rol_Tipo" class="mb-2 block text-sm font-bold text-gray-700 dark:text-gray-300">
                                👤 Tipo de Rol *
                            </label>
                            <input type="text" 
                                   name="Rol_Tipo" 
                                   id="Rol_Tipo"
                                   value="{{ old('Rol_Tipo', $rol->Rol_Tipo) }}"
                                   class="w-full rounded-lg border border-gray-300 px-4 py-3 transition-all focus:border-blue-500 focus:ring-2 focus:ring-blue-500 dark:border-gray-600 dark:bg-gray-700 dark:text-gray-100 @error('Rol_Tipo') border-red-500 @enderror"
                                   required>
                            @error('Rol_Tipo')
                                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>

                        <div>
                            <label for="Rol_Accesos" class="mb-2 block text-sm font-bold text-gray-700 dark:text-gray-300">
                                🔐 Nivel de Accesos *
                            </label>
                            <select name="Rol_Accesos" 
                                    id="Rol_Accesos"
                                    class="w-full rounded-lg border border-gray-300 px-4 py-3 transition-all focus:border-blue-500 focus:ring-2 focus:ring-blue-500 dark:border-gray-600 dark:bg-gray-700 dark:text-gray-100 @error('Rol_Accesos') border-red-500 @enderror"
                                    required>
                                <option value="Total" {{ old('Rol_Accesos', $rol->Rol_Accesos) == 'Total' ? 'selected' : '' }}>Total - Todos los módulos</option>
                                <option value="Alto" {{ old('Rol_Accesos', $rol->Rol_Accesos) == 'Alto' ? 'selected' : '' }}>Alto - Gestión y reportes</option>
                                <option value="Medio" {{ old('Rol_Accesos', $rol->Rol_Accesos) == 'Medio' ? 'selected' : '' }}>Medio - Operaciones básicas</option>
                                <option value="Bajo" {{ old('Rol_Accesos', $rol->Rol_Accesos) == 'Bajo' ? 'selected' : '' }}>Bajo - Solo lectura</option>
                            </select>
                            @error('Rol_Accesos')
                                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>

                        <div>
                            <label for="Trabajador_ID" class="mb-2 block text-sm font-bold text-gray-700 dark:text-gray-300">
                                👔 ID del Trabajador (Opcional)
                            </label>
                            <input type="number" 
                                   name="Trabajador_ID" 
                                   id="Trabajador_ID"
                                   value="{{ old('Trabajador_ID', $rol->Trabajador_ID) }}"
                                   class="w-full rounded-lg border border-gray-300 px-4 py-3 transition-all focus:border-blue-500 focus:ring-2 focus:ring-blue-500 dark:border-gray-600 dark:bg-gray-700 dark:text-gray-100 @error('Trabajador_ID') border-red-500 @enderror">
                            @error('Trabajador_ID')
                                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>

                    </div>

                    <div class="mt-8 flex items-center justify-end gap-4 border-t border-gray-200 pt-6 dark:border-gray-700">
                        <a href="{{ route('roles.index') }}" 
                           class="rounded-lg bg-gray-200 px-6 py-3 font-semibold text-gray-700 transition-all hover:bg-gray-300 dark:bg-gray-700 dark:text-gray-300 dark:hover:bg-gray-600">
                            Cancelar
                        </a>
                        <button type="submit" 
                                class="inline-flex items-center gap-2 rounded-lg bg-gradient-to-r from-blue-600 to-cyan-600 px-6 py-3 font-semibold text-white shadow-lg transition-all hover:scale-105 hover:shadow-xl">
                            <svg class="h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/>
                            </svg>
                            Actualizar Rol
                        </button>
                    </div>

                </form>

            </div>

        </div>
    </div>
</x-layouts.app>
</body>
</html>