<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <x-layouts.app :title="__('Nueva Orden de Producción')">
    <div class="py-8">
        <div class="mx-auto max-w-4xl sm:px-6 lg:px-8">

            <!-- Header -->
            <div class="mb-6 flex items-center justify-between">
                <div>
                    <h2 class="text-3xl font-bold text-gray-800 dark:text-gray-100">
                        ➕ Nueva Orden de Producción
                    </h2>
                    <p class="mt-1 text-sm text-gray-600 dark:text-gray-400">
                        Registra una nueva orden de producción según la demanda
                    </p>
                </div>

                <a href="{{ route('orden_produccion.index') }}"
                   class="inline-flex items-center gap-2 rounded-lg bg-gray-200 px-4 py-2 text-sm font-semibold text-gray-700 transition-all hover:bg-gray-300 dark:bg-gray-700 dark:text-gray-300 dark:hover:bg-gray-600">

                    <svg class="h-4 w-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                              d="M10 19l-7-7m0 0l7-7m-7 7h18"/>
                    </svg>
                    Volver
                </a>
            </div>

            <!-- Formulario -->
            <div class="overflow-hidden rounded-2xl bg-white shadow-2xl dark:bg-gray-800">

                <!-- Header del formulario -->
                <div
                    class="border-b border-gray-200 bg-gradient-to-r from-indigo-50 to-purple-50 px-6 py-4 dark:border-gray-700 dark:from-gray-700 dark:to-gray-800">
                    <h3 class="text-lg font-bold text-gray-800 dark:text-gray-100">Información de la Orden</h3>
                </div>

                <!-- Form -->
                <form action="{{ route('orden_produccion.store') }}" method="POST" class="p-6">
                    @csrf

                    <div class="space-y-6">

                        <!-- Fechas -->
                        <div class="grid gap-6 md:grid-cols-2">

                            <!-- Fecha Inicio -->
                            <div>
                                <label for="Ord_Prod_Fecha_Inicio"
                                       class="mb-2 block text-sm font-bold text-gray-700 dark:text-gray-300">
                                    📅 Fecha de Inicio *
                                </label>

                                <input type="date" name="Ord_Prod_Fecha_Inicio" id="Ord_Prod_Fecha_Inicio"
                                       value="{{ old('Ord_Prod_Fecha_Inicio') }}"
                                       class="w-full rounded-lg border border-gray-300 px-4 py-3 transition-all focus:border-indigo-500 focus:ring-2 focus:ring-indigo-500 dark:border-gray-600 dark:bg-gray-700 dark:text-gray-100 @error('Ord_Prod_Fecha_Inicio') border-red-500 @enderror"
                                       required>
                                @error('Ord_Prod_Fecha_Inicio')
                                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                @enderror
                            </div>

                            <!-- Fecha Final -->
                            <div>
                                <label for="Ord_Prod_Fecha_Final"
                                       class="mb-2 block text-sm font-bold text-gray-700 dark:text-gray-300">
                                    📅 Fecha Final *
                                </label>

                                <input type="date" name="Ord_Prod_Fecha_Final" id="Ord_Prod_Fecha_Final"
                                       value="{{ old('Ord_Prod_Fecha_Final') }}"
                                       class="w-full rounded-lg border border-gray-300 px-4 py-3 transition-all focus:border-indigo-500 focus:ring-2 focus:ring-indigo-500 dark:border-gray-600 dark:bg-gray-700 dark:text-gray-100 @error('Ord_Prod_Fecha_Final') border-red-500 @enderror"
                                       required>
                                @error('Ord_Prod_Fecha_Final')
                                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                @enderror
                            </div>

                        </div>

                        <!-- Cantidad -->
                        <div>
                            <label for="Ord_Prod_Cantidad"
                                   class="mb-2 block text-sm font-bold text-gray-700 dark:text-gray-300">
                                📦 Cantidad a Producir *
                            </label>

                            <input type="number" name="Ord_Prod_Cantidad" id="Ord_Prod_Cantidad"
                                   value="{{ old('Ord_Prod_Cantidad') }}"
                                   min="1" placeholder="Ej: 100"
                                   class="w-full rounded-lg border border-gray-300 px-4 py-3 transition-all focus:border-indigo-500 focus:ring-2 focus:ring-indigo-500 dark:border-gray-600 dark:bg-gray-700 dark:text-gray-100 @error('Ord_Prod_Cantidad') border-red-500 @enderror"
                                   required>
                            @error('Ord_Prod_Cantidad')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- Tipo de Producto -->
                        <div>
                            <label for="Ord_Prod_Tipo_Producto"
                                   class="mb-2 block text-sm font-bold text-gray-700 dark:text-gray-300">
                                🧶 Tipo de Producto *
                            </label>

                            <select name="Ord_Prod_Tipo_Producto" id="Ord_Prod_Tipo_Producto"
                                    class="w-full rounded-lg border border-gray-300 px-4 py-3 transition-all focus:border-indigo-500 focus:ring-2 focus:ring-indigo-500 dark:border-gray-600 dark:bg-gray-700 dark:text-gray-100 @error('Ord_Prod_Tipo_Producto') border-red-500 @enderror"
                                    required>
                                <option value="">Seleccionar tipo de producto...</option>
                                <option value="Chompas" {{ old('Ord_Prod_Tipo_Producto') == 'Chompas' ? 'selected' : '' }}>Chompas</option>
                                <option value="Gorros" {{ old('Ord_Prod_Tipo_Producto') == 'Gorros' ? 'selected' : '' }}>Gorros</option>
                                <option value="Bufandas" {{ old('Ord_Prod_Tipo_Producto') == 'Bufandas' ? 'selected' : '' }}>Bufandas</option>
                                <option value="Guantes" {{ old('Ord_Prod_Tipo_Producto') == 'Guantes' ? 'selected' : '' }}>Guantes</option>
                                <option value="Chalinas" {{ old('Ord_Prod_Tipo_Producto') == 'Chalinas' ? 'selected' : '' }}>Chalinas</option>
                                <option value="Ponchos" {{ old('Ord_Prod_Tipo_Producto') == 'Ponchos' ? 'selected' : '' }}>Ponchos</option>
                                <option value="Medias" {{ old('Ord_Prod_Tipo_Producto') == 'Medias' ? 'selected' : '' }}>Medias</option>
                                <option value="Chalecos" {{ old('Ord_Prod_Tipo_Producto') == 'Chalecos' ? 'selected' : '' }}>Chalecos</option>
                            </select>
                            @error('Ord_Prod_Tipo_Producto')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- Estado -->
                        <div>
                            <label for="Ord_Prod_Estado"
                                   class="mb-2 block text-sm font-bold text-gray-700 dark:text-gray-300">
                                🔄 Estado de la Orden *
                            </label>

                            <select name="Ord_Prod_Estado" id="Ord_Prod_Estado"
                                    class="w-full rounded-lg border border-gray-300 px-4 py-3 transition-all focus:border-indigo-500 focus:ring-2 focus:ring-indigo-500 dark:border-gray-600 dark:bg-gray-700 dark:text-gray-100 @error('Ord_Prod_Estado') border-red-500 @enderror"
                                    required>
                                <option value="">Seleccionar estado...</option>
                                <option value="Pendiente" {{ old('Ord_Prod_Estado') == 'Pendiente' ? 'selected' : '' }}>Pendiente</option>
                                <option value="En Proceso" {{ old('Ord_Prod_Estado') == 'En Proceso' ? 'selected' : '' }}>En Proceso</option>
                                <option value="Completado" {{ old('Ord_Prod_Estado') == 'Completado' ? 'selected' : '' }}>Completado</option>
                                <option value="Cancelado" {{ old('Ord_Prod_Estado') == 'Cancelado' ? 'selected' : '' }}>Cancelado</option>
                            </select>
                            @error('Ord_Prod_Estado')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- Rol -->
                        <div>
                            <label for="Rol_ID"
                                   class="mb-2 block text-sm font-bold text-gray-700 dark:text-gray-300">
                                👤 Responsable (Rol) *
                            </label>

                            <select name="Rol_ID" id="Rol_ID"
                                    class="w-full rounded-lg border border-gray-300 px-4 py-3 transition-all focus:border-indigo-500 focus:ring-2 focus:ring-indigo-500 dark:border-gray-600 dark:bg-gray-700 dark:text-gray-100 @error('Rol_ID') border-red-500 @enderror"
                                    required>
                                <option value="">Seleccionar rol...</option>
                                @foreach($roles as $rol)
                                    <option value="{{ $rol->Rol_ID }}" {{ old('Rol_ID') == $rol->Rol_ID ? 'selected' : '' }}>
                                        {{ $rol->Rol_Tipo }}
                                    </option>
                                @endforeach
                            </select>
                            @error('Rol_ID')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>

                    </div>

                    <!-- Botones de acción -->
                    <div
                        class="mt-8 flex items-center justify-end gap-4 border-t border-gray-200 pt-6 dark:border-gray-700">

                        <a href="{{ route('orden_produccion.index') }}"
                           class="rounded-lg bg-gray-200 px-6 py-3 font-semibold text-gray-700 transition-all hover:bg-gray-300 dark:bg-gray-700 dark:text-gray-300 dark:hover:bg-gray-600">
                            Cancelar
                        </a>

                        <button type="submit"
                                class="inline-flex items-center gap-2 rounded-lg bg-gradient-to-r from-indigo-600 to-purple-600 px-6 py-3 font-semibold text-white shadow-lg transition-all hover:scale-105 hover:shadow-xl">
                            <svg class="h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                      d="M5 13l4 4L19 7"/>
                            </svg>
                            Guardar Orden
                        </button>
                    </div>

                </form>

            </div>
        </div>
    </div>
</x-layouts.app>


</body>
</html>