<div class="min-h-screen bg-gray-50 dark:bg-gray-900 py-8 transition-colors">
    <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8">

        <!-- Header -->
        <div class="mb-8">
            <div class="flex items-center gap-3 mb-2">
                <div class="text-3xl">🏢</div>
                <h1 class="text-3xl font-bold text-gray-900 dark:text-white">Agregar Sede</h1>
            </div>
            <p class="text-gray-600 dark:text-gray-400 ml-12">Registra una nueva sede en el sistema</p>
        </div>

        <!-- Formulario Card -->
        <div class="bg-white dark:bg-gray-800 rounded-xl shadow-sm border border-gray-200 dark:border-gray-700 transition-colors">

            <form wire:submit.prevent="store">

                <!-- Card Header -->
                <div class="px-6 py-5 border-b border-gray-200 dark:border-gray-700">
                    <h2 class="text-xl font-semibold text-gray-900 dark:text-white">Información de la Sede</h2>
                    <p class="text-sm text-gray-600 dark:text-gray-400 mt-1">Completa todos los campos requeridos</p>
                </div>

                <!-- Formulario Body -->
                <div class="px-6 py-6 space-y-6">

                    <!-- Información Básica -->
                    <div>
                        <h3 class="text-sm font-semibold text-indigo-600 dark:text-indigo-400 uppercase tracking-wider mb-4">Datos Básicos</h3>

                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                            <!-- Nombre -->
                            <div>
                                <label for="nombre" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">
                                    Nombre de la Sede <span class="text-red-500 dark:text-red-400">*</span>
                                </label>
                                <input type="text"
                                       id="nombre"
                                       wire:model="nombre"
                                       class="w-full px-4 py-2.5 border border-gray-300 dark:border-gray-600 rounded-lg focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 transition-colors text-gray-900 dark:text-white bg-white dark:bg-gray-700"
                                       placeholder="Ej: Sede Central Lima">
                                @error('nombre')
                                    <p class="mt-1 text-sm text-red-600 dark:text-red-400">{{ $message }}</p>
                                @enderror
                            </div>

                            <!-- Código -->
                            <div>
                                <label for="codigo" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">
                                    Código <span class="text-red-500 dark:text-red-400">*</span>
                                </label>
                                <input type="text"
                                       id="codigo"
                                       wire:model="codigo"
                                       class="w-full px-4 py-2.5 border border-gray-300 dark:border-gray-600 rounded-lg focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 transition-colors text-gray-900 dark:text-white bg-white dark:bg-gray-700"
                                       placeholder="Ej: SED-001">
                                @error('codigo')
                                    <p class="mt-1 text-sm text-red-600 dark:text-red-400">{{ $message }}</p>
                                @enderror
                            </div>

                            <!-- Tipo -->
                            <div>
                                <label for="tipo" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">
                                    Tipo de Sede <span class="text-red-500 dark:text-red-400">*</span>
                                </label>
                                <select id="tipo"
                                        wire:model="tipo"
                                        class="w-full px-4 py-2.5 border border-gray-300 dark:border-gray-600 rounded-lg focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 transition-colors text-gray-900 dark:text-white bg-white dark:bg-gray-700">
                                    <option value="">Seleccionar...</option>
                                    <option value="central">Central</option>
                                    <option value="regional">Regional</option>
                                    <option value="sucursal">Sucursal</option>
                                </select>
                                @error('tipo')
                                    <p class="mt-1 text-sm text-red-600 dark:text-red-400">{{ $message }}</p>
                                @enderror
                            </div>

                            <!-- Capacidad -->
                            <div>
                                <label for="capacidad" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">
                                    Capacidad (personas) <span class="text-red-500 dark:text-red-400">*</span>
                                </label>
                                <input type="number"
                                       id="capacidad"
                                       wire:model="capacidad"
                                       min="0"
                                       class="w-full px-4 py-2.5 border border-gray-300 dark:border-gray-600 rounded-lg focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 transition-colors text-gray-900 dark:text-white bg-white dark:bg-gray-700"
                                       placeholder="Ej: 100">
                                @error('capacidad')
                                    <p class="mt-1 text-sm text-red-600 dark:text-red-400">{{ $message }}</p>
                                @enderror
                            </div>

                            <!-- Encargado -->
                            <div>
                                <label for="encargado" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">
                                    Encargado
                                </label>
                                <input type="text"
                                       id="encargado"
                                       wire:model="encargado"
                                       class="w-full px-4 py-2.5 border border-gray-300 dark:border-gray-600 rounded-lg focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 transition-colors text-gray-900 dark:text-white bg-white dark:bg-gray-700"
                                       placeholder="Ej: Juan Pérez">
                                @error('encargado')
                                    <p class="mt-1 text-sm text-red-600 dark:text-red-400">{{ $message }}</p>
                                @enderror
                            </div>

                            <!-- Estado -->
                            <div>
                                <label for="estado" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">
                                    Estado <span class="text-red-500 dark:text-red-400">*</span>
                                </label>
                                <select id="estado"
                                        wire:model="estado"
                                        class="w-full px-4 py-2.5 border border-gray-300 dark:border-gray-600 rounded-lg focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 transition-colors text-gray-900 dark:text-white bg-white dark:bg-gray-700">
                                    <option value="activa">Activa</option>
                                    <option value="inactiva">Inactiva</option>
                                    <option value="mantenimiento">En Mantenimiento</option>
                                </select>
                                @error('estado')
                                    <p class="mt-1 text-sm text-red-600 dark:text-red-400">{{ $message }}</p>
                                @enderror
                            </div>
                        </div>
                    </div>

                    <!-- Ubicación -->
                    <div class="pt-6 border-t border-gray-200 dark:border-gray-700">
                        <h3 class="text-sm font-semibold text-indigo-600 dark:text-indigo-400 uppercase tracking-wider mb-4">Ubicación</h3>

                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                            <!-- Dirección -->
                            <div class="md:col-span-2">
                                <label for="direccion" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">
                                    Dirección <span class="text-red-500 dark:text-red-400">*</span>
                                </label>
                                <input type="text"
                                       id="direccion"
                                       wire:model="direccion"
                                       class="w-full px-4 py-2.5 border border-gray-300 dark:border-gray-600 rounded-lg focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 transition-colors text-gray-900 dark:text-white bg-white dark:bg-gray-700"
                                       placeholder="Ej: Av. Los Incas 1234">
                                @error('direccion')
                                    <p class="mt-1 text-sm text-red-600 dark:text-red-400">{{ $message }}</p>
                                @enderror
                            </div>

                            <!-- Ciudad -->
                            <div>
                                <label for="ciudad" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">
                                    Ciudad <span class="text-red-500 dark:text-red-400">*</span>
                                </label>
                                <input type="text"
                                       id="ciudad"
                                       wire:model="ciudad"
                                       class="w-full px-4 py-2.5 border border-gray-300 dark:border-gray-600 rounded-lg focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 transition-colors text-gray-900 dark:text-white bg-white dark:bg-gray-700"
                                       placeholder="Ej: Lima">
                                @error('ciudad')
                                    <p class="mt-1 text-sm text-red-600 dark:text-red-400">{{ $message }}</p>
                                @enderror
                            </div>

                            <!-- Departamento -->
                            <div>
                                <label for="departamento" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">
                                    Departamento <span class="text-red-500 dark:text-red-400">*</span>
                                </label>
                                <input type="text"
                                       id="departamento"
                                       wire:model="departamento"
                                       class="w-full px-4 py-2.5 border border-gray-300 dark:border-gray-600 rounded-lg focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 transition-colors text-gray-900 dark:text-white bg-white dark:bg-gray-700"
                                       placeholder="Ej: Lima">
                                @error('departamento')
                                    <p class="mt-1 text-sm text-red-600 dark:text-red-400">{{ $message }}</p>
                                @enderror
                            </div>
                        </div>
                    </div>

                    <!-- Contacto -->
                    <div class="pt-6 border-t border-gray-200 dark:border-gray-700">
                        <h3 class="text-sm font-semibold text-indigo-600 dark:text-indigo-400 uppercase tracking-wider mb-4">Información de Contacto</h3>

                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                            <!-- Teléfono -->
                            <div>
                                <label for="telefono" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">
                                    Teléfono <span class="text-red-500 dark:text-red-400">*</span>
                                </label>
                                <input type="tel"
                                       id="telefono"
                                       wire:model="telefono"
                                       class="w-full px-4 py-2.5 border border-gray-300 dark:border-gray-600 rounded-lg focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 transition-colors text-gray-900 dark:text-white bg-white dark:bg-gray-700"
                                       placeholder="Ej: (01) 234-5678">
                                @error('telefono')
                                    <p class="mt-1 text-sm text-red-600 dark:text-red-400">{{ $message }}</p>
                                @enderror
                            </div>

                            <!-- Email -->
                            <div>
                                <label for="email" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">
                                    Correo Electrónico
                                </label>
                                <input type="email"
                                       id="email"
                                       wire:model="email"
                                       class="w-full px-4 py-2.5 border border-gray-300 dark:border-gray-600 rounded-lg focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 transition-colors text-gray-900 dark:text-white bg-white dark:bg-gray-700"
                                       placeholder="sede@empresa.com">
                                @error('email')
                                    <p class="mt-1 text-sm text-red-600 dark:text-red-400">{{ $message }}</p>
                                @enderror
                            </div>
                        </div>
                    </div>

                    <!-- Observaciones -->
                    <div class="pt-6 border-t border-gray-200 dark:border-gray-700">
                        <label for="observaciones" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">
                            Observaciones
                        </label>
                        <textarea id="observaciones"
                                  wire:model="observaciones"
                                  rows="3"
                                  class="w-full px-4 py-2.5 border border-gray-300 dark:border-gray-600 rounded-lg focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 transition-colors text-gray-900 dark:text-white bg-white dark:bg-gray-700"
                                  placeholder="Información adicional sobre la sede..."></textarea>
                        @error('observaciones')
                            <p class="mt-1 text-sm text-red-600 dark:text-red-400">{{ $message }}</p>
                        @enderror
                    </div>

                </div>

                <!-- Card Footer - Botones -->
                <div class="px-6 py-4 bg-gray-50 dark:bg-gray-900/50 border-t border-gray-200 dark:border-gray-700 flex items-center justify-end gap-3">
                    <a href="{{ route('sede.index') }}"
                       class="px-6 py-2.5 border border-gray-300 dark:border-gray-600 text-gray-700 dark:text-gray-300 font-medium rounded-lg hover:bg-gray-50 dark:hover:bg-gray-700 transition-colors">
                        Cancelar
                    </a>
                    <button type="submit"
                            class="bg-indigo-600 hover:bg-indigo-700 dark:bg-indigo-500 dark:hover:bg-indigo-600 text-white font-medium px-6 py-2.5 rounded-lg flex items-center gap-2 transition-colors shadow-sm">
                        <span class="text-lg">+</span>
                        Agregar Sede
                    </button>
                </div>

            </form>

        </div>

    </div>
</div>
