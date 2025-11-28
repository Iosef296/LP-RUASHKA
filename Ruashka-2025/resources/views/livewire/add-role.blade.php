<div class="min-h-screen bg-gray-50 dark:bg-gray-900 py-8 transition-colors">
    <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8">

        <!-- Header -->
        <div class="mb-8">
            <div class="flex items-center gap-3 mb-2">
                <div class="text-3xl">🎭</div>
                <h1 class="text-3xl font-bold text-gray-900 dark:text-white">Agregar Rol</h1>
            </div>
            <p class="text-gray-600 dark:text-gray-400 ml-12">Crea un nuevo rol con sus permisos</p>
        </div>

        <!-- Formulario Card -->
        <div class="bg-white dark:bg-gray-800 rounded-xl shadow-sm border border-gray-200 dark:border-gray-700 transition-colors">

            <form wire:submit.prevent="store">

                <!-- Card Header -->
                <div class="px-6 py-5 border-b border-gray-200 dark:border-gray-700">
                    <h2 class="text-xl font-semibold text-gray-900 dark:text-white">Información del Rol</h2>
                    <p class="text-sm text-gray-600 dark:text-gray-400 mt-1">Define el rol y sus permisos</p>
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
                                    Nombre del Rol <span class="text-red-500 dark:text-red-400">*</span>
                                </label>
                                <input type="text"
                                       id="nombre"
                                       wire:model="nombre"
                                       class="w-full px-4 py-2.5 border border-gray-300 dark:border-gray-600 rounded-lg focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 transition-colors text-gray-900 dark:text-white bg-white dark:bg-gray-700"
                                       placeholder="Ej: Gerente de Operaciones">
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
                                       placeholder="Ej: ROL-001">
                                @error('codigo')
                                    <p class="mt-1 text-sm text-red-600 dark:text-red-400">{{ $message }}</p>
                                @enderror
                            </div>

                            <!-- Descripción -->
                            <div class="md:col-span-2">
                                <label for="descripcion" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">
                                    Descripción <span class="text-red-500 dark:text-red-400">*</span>
                                </label>
                                <textarea id="descripcion"
                                          wire:model="descripcion"
                                          rows="2"
                                          class="w-full px-4 py-2.5 border border-gray-300 dark:border-gray-600 rounded-lg focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 transition-colors text-gray-900 dark:text-white bg-white dark:bg-gray-700"
                                          placeholder="Describe las responsabilidades de este rol..."></textarea>
                                @error('descripcion')
                                    <p class="mt-1 text-sm text-red-600 dark:text-red-400">{{ $message }}</p>
                                @enderror
                            </div>

                            <!-- Nivel -->
                            <div>
                                <label for="nivel" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">
                                    Nivel de Acceso <span class="text-red-500 dark:text-red-400">*</span>
                                </label>
                                <select id="nivel"
                                        wire:model="nivel"
                                        class="w-full px-4 py-2.5 border border-gray-300 dark:border-gray-600 rounded-lg focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 transition-colors text-gray-900 dark:text-white bg-white dark:bg-gray-700">
                                    <option value="">Seleccionar...</option>
                                    <option value="basico">Básico</option>
                                    <option value="intermedio">Intermedio</option>
                                    <option value="avanzado">Avanzado</option>
                                    <option value="administrador">Administrador</option>
                                </select>
                                @error('nivel')
                                    <p class="mt-1 text-sm text-red-600 dark:text-red-400">{{ $message }}</p>
                                @enderror
                            </div>

                            <!-- Departamento -->
                            <div>
                                <label for="departamento" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">
                                    Departamento
                                </label>
                                <select id="departamento"
                                        wire:model="departamento"
                                        class="w-full px-4 py-2.5 border border-gray-300 dark:border-gray-600 rounded-lg focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 transition-colors text-gray-900 dark:text-white bg-white dark:bg-gray-700">
                                    <option value="">Todos los departamentos</option>
                                    <option value="produccion">Producción</option>
                                    <option value="logistica">Logística</option>
                                    <option value="calidad">Control de Calidad</option>
                                    <option value="mantenimiento">Mantenimiento</option>
                                    <option value="administracion">Administración</option>
                                    <option value="rrhh">Recursos Humanos</option>
                                    <option value="ventas">Ventas</option>
                                    <option value="ti">Tecnología</option>
                                </select>
                                @error('departamento')
                                    <p class="mt-1 text-sm text-red-600 dark:text-red-400">{{ $message }}</p>
                                @enderror
                            </div>

                            <!-- Estado -->
                            <div class="md:col-span-2">
                                <label for="estado" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">
                                    Estado <span class="text-red-500 dark:text-red-400">*</span>
                                </label>
                                <select id="estado"
                                        wire:model="estado"
                                        class="w-full px-4 py-2.5 border border-gray-300 dark:border-gray-600 rounded-lg focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 transition-colors text-gray-900 dark:text-white bg-white dark:bg-gray-700">
                                    <option value="activo">Activo</option>
                                    <option value="inactivo">Inactivo</option>
                                </select>
                                @error('estado')
                                    <p class="mt-1 text-sm text-red-600 dark:text-red-400">{{ $message }}</p>
                                @enderror
                            </div>
                        </div>
                    </div>

                    <!-- Permisos -->
                    <div class="pt-6 border-t border-gray-200 dark:border-gray-700">
                        <h3 class="text-sm font-semibold text-indigo-600 dark:text-indigo-400 uppercase tracking-wider mb-4">Permisos del Rol</h3>

                        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                            <!-- Módulo: Trabajadores -->
                            <div class="bg-gray-50 dark:bg-gray-900/50 rounded-lg p-4">
                                <h4 class="font-semibold text-gray-900 dark:text-white mb-3 flex items-center gap-2">
                                    <span>👷</span> Trabajadores
                                </h4>
                                <div class="space-y-2">
                                    <label class="flex items-center">
                                        <input type="checkbox" wire:model="permisos.trabajadores.ver" class="rounded border-gray-300 dark:border-gray-600 text-indigo-600 focus:ring-indigo-500 dark:bg-gray-700">
                                        <span class="ml-2 text-sm text-gray-700 dark:text-gray-300">Ver trabajadores</span>
                                    </label>
                                    <label class="flex items-center">
                                        <input type="checkbox" wire:model="permisos.trabajadores.crear" class="rounded border-gray-300 dark:border-gray-600 text-indigo-600 focus:ring-indigo-500 dark:bg-gray-700">
                                        <span class="ml-2 text-sm text-gray-700 dark:text-gray-300">Crear trabajadores</span>
                                    </label>
                                    <label class="flex items-center">
                                        <input type="checkbox" wire:model="permisos.trabajadores.editar" class="rounded border-gray-300 dark:border-gray-600 text-indigo-600 focus:ring-indigo-500 dark:bg-gray-700">
                                        <span class="ml-2 text-sm text-gray-700 dark:text-gray-300">Editar trabajadores</span>
                                    </label>
                                    <label class="flex items-center">
                                        <input type="checkbox" wire:model="permisos.trabajadores.eliminar" class="rounded border-gray-300 dark:border-gray-600 text-indigo-600 focus:ring-indigo-500 dark:bg-gray-700">
                                        <span class="ml-2 text-sm text-gray-700 dark:text-gray-300">Eliminar trabajadores</span>
                                    </label>
                                </div>
                            </div>

                            <!-- Módulo: Sedes -->
                            <div class="bg-gray-50 dark:bg-gray-900/50 rounded-lg p-4">
                                <h4 class="font-semibold text-gray-900 dark:text-white mb-3 flex items-center gap-2">
                                    <span>🏢</span> Sedes
                                </h4>
                                <div class="space-y-2">
                                    <label class="flex items-center">
                                        <input type="checkbox" wire:model="permisos.sedes.ver" class="rounded border-gray-300 dark:border-gray-600 text-indigo-600 focus:ring-indigo-500 dark:bg-gray-700">
                                        <span class="ml-2 text-sm text-gray-700 dark:text-gray-300">Ver sedes</span>
                                    </label>
                                    <label class="flex items-center">
                                        <input type="checkbox" wire:model="permisos.sedes.crear" class="rounded border-gray-300 dark:border-gray-600 text-indigo-600 focus:ring-indigo-500 dark:bg-gray-700">
                                        <span class="ml-2 text-sm text-gray-700 dark:text-gray-300">Crear sedes</span>
                                    </label>
                                    <label class="flex items-center">
                                        <input type="checkbox" wire:model="permisos.sedes.editar" class="rounded border-gray-300 dark:border-gray-600 text-indigo-600 focus:ring-indigo-500 dark:bg-gray-700">
                                        <span class="ml-2 text-sm text-gray-700 dark:text-gray-300">Editar sedes</span>
                                    </label>
                                    <label class="flex items-center">
                                        <input type="checkbox" wire:model="permisos.sedes.eliminar" class="rounded border-gray-300 dark:border-gray-600 text-indigo-600 focus:ring-indigo-500 dark:bg-gray-700">
                                        <span class="ml-2 text-sm text-gray-700 dark:text-gray-300">Eliminar sedes</span>
                                    </label>
                                </div>
                            </div>

                            <!-- Módulo: Roles -->
                            <div class="bg-gray-50 dark:bg-gray-900/50 rounded-lg p-4">
                                <h4 class="font-semibold text-gray-900 dark:text-white mb-3 flex items-center gap-2">
                                    <span>🎭</span> Roles
                                </h4>
                                <div class="space-y-2">
                                    <label class="flex items-center">
                                        <input type="checkbox" wire:model="permisos.roles.ver" class="rounded border-gray-300 dark:border-gray-600 text-indigo-600 focus:ring-indigo-500 dark:bg-gray-700">
                                        <span class="ml-2 text-sm text-gray-700 dark:text-gray-300">Ver roles</span>
                                    </label>
                                    <label class="flex items-center">
                                        <input type="checkbox" wire:model="permisos.roles.crear" class="rounded border-gray-300 dark:border-gray-600 text-indigo-600 focus:ring-indigo-500 dark:bg-gray-700">
                                        <span class="ml-2 text-sm text-gray-700 dark:text-gray-300">Crear roles</span>
                                    </label>
                                    <label class="flex items-center">
                                        <input type="checkbox" wire:model="permisos.roles.editar" class="rounded border-gray-300 dark:border-gray-600 text-indigo-600 focus:ring-indigo-500 dark:bg-gray-700">
                                        <span class="ml-2 text-sm text-gray-700 dark:text-gray-300">Editar roles</span>
                                    </label>
                                    <label class="flex items-center">
                                        <input type="checkbox" wire:model="permisos.roles.eliminar" class="rounded border-gray-300 dark:border-gray-600 text-indigo-600 focus:ring-indigo-500 dark:bg-gray-700">
                                        <span class="ml-2 text-sm text-gray-700 dark:text-gray-300">Eliminar roles</span>
                                    </label>
                                </div>
                            </div>

                            <!-- Módulo: Reportes -->
                            <div class="bg-gray-50 dark:bg-gray-900/50 rounded-lg p-4">
                                <h4 class="font-semibold text-gray-900 dark:text-white mb-3 flex items-center gap-2">
                                    <span>📊</span> Reportes
                                </h4>
                                <div class="space-y-2">
                                    <label class="flex items-center">
                                        <input type="checkbox" wire:model="permisos.reportes.ver" class="rounded border-gray-300 dark:border-gray-600 text-indigo-600 focus:ring-indigo-500 dark:bg-gray-700">
                                        <span class="ml-2 text-sm text-gray-700 dark:text-gray-300">Ver reportes</span>
                                    </label>
                                    <label class="flex items-center">
                                        <input type="checkbox" wire:model="permisos.reportes.generar" class="rounded border-gray-300 dark:border-gray-600 text-indigo-600 focus:ring-indigo-500 dark:bg-gray-700">
                                        <span class="ml-2 text-sm text-gray-700 dark:text-gray-300">Generar reportes</span>
                                    </label>
                                    <label class="flex items-center">
                                        <input type="checkbox" wire:model="permisos.reportes.exportar" class="rounded border-gray-300 dark:border-gray-600 text-indigo-600 focus:ring-indigo-500 dark:bg-gray-700">
                                        <span class="ml-2 text-sm text-gray-700 dark:text-gray-300">Exportar reportes</span>
                                    </label>
                                </div>
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
                                  placeholder="Información adicional sobre el rol..."></textarea>
                        @error('observaciones')
                            <p class="mt-1 text-sm text-red-600 dark:text-red-400">{{ $message }}</p>
                        @enderror
                    </div>

                </div>

                <!-- Card Footer - Botones -->
                <div class="px-6 py-4 bg-gray-50 dark:bg-gray-900/50 border-t border-gray-200 dark:border-gray-700 flex items-center justify-end gap-3">
                    <a href="{{ route('role.index') }}"
                       class="px-6 py-2.5 border border-gray-300 dark:border-gray-600 text-gray-700 dark:text-gray-300 font-medium rounded-lg hover:bg-gray-50 dark:hover:bg-gray-700 transition-colors">
                        Cancelar
                    </a>
                    <button type="submit"
                            class="bg-indigo-600 hover:bg-indigo-700 dark:bg-indigo-500 dark:hover:bg-indigo-600 text-white font-medium px-6 py-2.5 rounded-lg flex items-center gap-2 transition-colors shadow-sm">
                        <span class="text-lg">+</span>
                        Crear Rol
                    </button>
                </div>

            </form>

        </div>

    </div>
</div>
