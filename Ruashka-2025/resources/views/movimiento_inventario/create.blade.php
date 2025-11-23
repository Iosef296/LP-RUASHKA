<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <x-layouts.app :title="__('Nuevo Movimiento')">
    <div class="py-8">
        <div class="mx-auto max-w-4xl sm:px-6 lg:px-8">
            
            <div class="mb-6 flex items-center justify-between">
                <div>
                    <h2 class="text-3xl font-bold text-gray-800 dark:text-gray-100">
                        Nuevo Movimiento de Inventario
                    </h2>
                    <p class="mt-1 text-sm text-gray-600 dark:text-gray-400">
                        Registra una entrada o salida de productos
                    </p>
                </div>
                <a href="{{ route('movimiento_inventario.index') }}" 
                   class="inline-flex items-center gap-2 rounded-lg bg-gray-200 px-4 py-2 text-sm font-semibold text-gray-700 transition-all hover:bg-gray-300 dark:bg-gray-700 dark:text-gray-300 dark:hover:bg-gray-600">
                    <svg class="h-4 w-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"/>
                    </svg>
                    Volver
                </a>
            </div>

            <div class="overflow-hidden rounded-2xl bg-white shadow-2xl dark:bg-gray-800">
                
                <div class="border-b border-gray-200 bg-gradient-to-r from-gray-50 to-gray-100 px-6 py-4 dark:border-gray-700 dark:from-gray-700 dark:to-gray-800">
                    <h3 class="text-lg font-bold text-gray-800 dark:text-gray-100">Información del Movimiento</h3>
                </div>

                <form action="{{ route('movimiento_inventario.store') }}" method="POST" class="p-6">
                    @csrf

                    <div class="space-y-6">
                        
                        <!-- Fecha -->
                        <div>
                            <label for="Movimiento_Inventario_Fecha" class="mb-2 block text-sm font-bold text-gray-700 dark:text-gray-300">
                                📅 Fecha del Movimiento *
                            </label>
                            <input type="date" 
                                   name="Movimiento_Inventario_Fecha" 
                                   id="Movimiento_Inventario_Fecha"
                                   value="{{ old('Movimiento_Inventario_Fecha', date('Y-m-d')) }}"
                                   class="w-full rounded-lg border border-gray-300 px-4 py-3 transition-all focus:border-amber-500 focus:ring-2 focus:ring-amber-500 dark:border-gray-600 dark:bg-gray-700 dark:text-gray-100 @error('Movimiento_Inventario_Fecha') border-red-500 @enderror"
                                   required>
                            @error('Movimiento_Inventario_Fecha')
                                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- Tipo de Movimiento -->
                        <div>
                            <label for="Movimiento_Inventario_Tipo" class="mb-2 block text-sm font-bold text-gray-700 dark:text-gray-300">
                                🔄 Tipo de Movimiento *
                            </label>
                            <select name="Movimiento_Inventario_Tipo" 
                                    id="Movimiento_Inventario_Tipo"
                                    class="w-full rounded-lg border border-gray-300 px-4 py-3 transition-all focus:border-amber-500 focus:ring-2 focus:ring-amber-500 dark:border-gray-600 dark:bg-gray-700 dark:text-gray-100 @error('Movimiento_Inventario_Tipo') border-red-500 @enderror"
                                    required>
                                <option value="">Seleccionar tipo...</option>
                                <option value="E" {{ old('Movimiento_Inventario_Tipo') == 'E' ? 'selected' : '' }}>Entrada (E) - Ingreso al inventario</option>
                                <option value="S" {{ old('Movimiento_Inventario_Tipo') == 'S' ? 'selected' : '' }}>Salida (S) - Retiro del inventario</option>
                            </select>
                            @error('Movimiento_Inventario_Tipo')
                                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- Motivo -->
                        <div>
                            <label for="Movimiento_Inventario_Motivo" class="mb-2 block text-sm font-bold text-gray-700 dark:text-gray-300">
                                📝 Motivo del Movimiento *
                            </label>
                            <select name="Movimiento_Inventario_Motivo" 
                                    id="Movimiento_Inventario_Motivo"
                                    class="w-full rounded-lg border border-gray-300 px-4 py-3 transition-all focus:border-amber-500 focus:ring-2 focus:ring-amber-500 dark:border-gray-600 dark:bg-gray-700 dark:text-gray-100 @error('Movimiento_Inventario_Motivo') border-red-500 @enderror"
                                    required>
                                <option value="">Seleccionar motivo...</option>
                                <option value="C" {{ old('Movimiento_Inventario_Motivo') == 'C' ? 'selected' : '' }}>Compra (C)</option>
                                <option value="V" {{ old('Movimiento_Inventario_Motivo') == 'V' ? 'selected' : '' }}>Venta (V)</option>
                                <option value="P" {{ old('Movimiento_Inventario_Motivo') == 'P' ? 'selected' : '' }}>Producción (P)</option>
                                <option value="A" {{ old('Movimiento_Inventario_Motivo') == 'A' ? 'selected' : '' }}>Ajuste (A)</option>
                                <option value="D" {{ old('Movimiento_Inventario_Motivo') == 'D' ? 'selected' : '' }}>Devolución (D)</option>
                            </select>
                            @error('Movimiento_Inventario_Motivo')
                                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- Producto -->
                        <div>
                            <label for="Producto_ID" class="mb-2 block text-sm font-bold text-gray-700 dark:text-gray-300">
                                📦 Producto *
                            </label>
                            <select name="Producto_ID" 
                                    id="Producto_ID"
                                    class="w-full rounded-lg border border-gray-300 px-4 py-3 transition-all focus:border-amber-500 focus:ring-2 focus:ring-amber-500 dark:border-gray-600 dark:bg-gray-700 dark:text-gray-100 @error('Producto_ID') border-red-500 @enderror"
                                    required>
                                <option value="">Seleccionar producto...</option>
                                @foreach($productos as $producto)
                                    <option value="{{ $producto->Producto_ID }}" {{ old('Producto_ID') == $producto->Producto_ID ? 'selected' : '' }}>
                                        {{ $producto->Producto_Nombre }} - S/ {{ $producto->Producto_Precio_Unit }}
                                    </option>
                                @endforeach
                            </select>
                            @error('Producto_ID')
                                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- Responsable (Rol) -->
                        <div>
                            <label for="Rol_ID" class="mb-2 block text-sm font-bold text-gray-700 dark:text-gray-300">
                                👤 Responsable (Rol) *
                            </label>
                            <select name="Rol_ID" 
                                    id="Rol_ID"
                                    class="w-full rounded-lg border border-gray-300 px-4 py-3 transition-all focus:border-amber-500 focus:ring-2 focus:ring-amber-500 dark:border-gray-600 dark:bg-gray-700 dark:text-gray-100 @error('Rol_ID') border-red-500 @enderror"
                                    required>
                                <option value="">Seleccionar responsable...</option>
                                @foreach($roles as $rol)
                                    <option value="{{ $rol->Rol_ID }}" {{ old('Rol_ID') == $rol->Rol_ID ? 'selected' : '' }}>
                                        {{ $rol->Rol_Tipo }} ({{ $rol->Rol_Accesos }})
                                    </option>
                                @endforeach
                            </select>
                            @error('Rol_ID')
                                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- Sede (Opcional) -->
                        <div>
                            <label for="Sede_ID" class="mb-2 block text-sm font-bold text-gray-700 dark:text-gray-300">
                                🏢 Sede (Opcional)
                            </label>
                            <input type="number" 
                                   name="Sede_ID" 
                                   id="Sede_ID"
                                   value="{{ old('Sede_ID') }}"
                                   placeholder="Ej: 1"
                                   class="w-full rounded-lg border border-gray-300 px-4 py-3 transition-all focus:border-amber-500 focus:ring-2 focus:ring-amber-500 dark:border-gray-600 dark:bg-gray-700 dark:text-gray-100 @error('Sede_ID') border-red-500 @enderror">
                            @error('Sede_ID')
                                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>

                    </div>

                    <div class="mt-8 flex items-center justify-end gap-4 border-t border-gray-200 pt-6 dark:border-gray-700">
                        <a href="{{ route('movimiento_inventario.index') }}" 
                           class="rounded-lg bg-gray-200 px-6 py-3 font-semibold text-gray-700 transition-all hover:bg-gray-300 dark:bg-gray-700 dark:text-gray-300 dark:hover:bg-gray-600">
                            Cancelar
                        </a>
                        <button type="submit" 
                                class="inline-flex items-center gap-2 rounded-lg bg-gradient-to-r from-amber-600 to-orange-600 px-6 py-3 font-semibold text-white shadow-lg transition-all hover:scale-105 hover:shadow-xl">
                            <svg class="h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/>
                            </svg>
                            Guardar Movimiento
                        </button>
                    </div>

                </form>

            </div>

        </div>
    </div>
</x-layouts.app>
</body>
</html>