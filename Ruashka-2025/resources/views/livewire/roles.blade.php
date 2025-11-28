<div class="min-h-screen bg-gray-50 dark:bg-gray-900 py-8 transition-colors">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">

        <!-- Header -->
        <div class="flex items-center justify-between mb-8">
            <div>
                <div class="flex items-center gap-3 mb-2">
                    <div class="text-3xl">🎭</div>
                    <h1 class="text-3xl font-bold text-gray-900 dark:text-white">Roles</h1>
                </div>
                <p class="text-gray-600 dark:text-gray-400 ml-12">Gestión de roles y permisos del sistema</p>
            </div>
            <a href="{{ route('role.create') }}" class="bg-indigo-600 hover:bg-indigo-700 dark:bg-indigo-500 dark:hover:bg-indigo-600 text-white font-medium px-6 py-3 rounded-lg flex items-center gap-2 transition-colors shadow-sm">
                <span class="text-xl">+</span>
                Nuevo Rol
            </a>
        </div>

        <!-- Mensaje de éxito -->
        @if (session()->has('message'))
            <div class="mb-6 bg-green-50 dark:bg-green-900/30 border border-green-200 dark:border-green-800 text-green-800 dark:text-green-300 px-4 py-3 rounded-lg">
                {{ session('message') }}
            </div>
        @endif

        <!-- Card Principal -->
        <div class="bg-white dark:bg-gray-800 rounded-xl shadow-sm border border-gray-200 dark:border-gray-700 transition-colors">

            <!-- Card Header -->
            <div class="px-6 py-5 border-b border-gray-200 dark:border-gray-700">
                <h2 class="text-xl font-semibold text-gray-900 dark:text-white">Listado de Roles</h2>
                <p class="text-sm text-gray-600 dark:text-gray-400 mt-1">Gestiona todos los roles del sistema</p>
            </div>

            @if(isset($roles) && count($roles) > 0)
                <!-- Table Header -->
                <div class="px-6 py-4 bg-gray-50 dark:bg-gray-900/50 border-b border-gray-200 dark:border-gray-700">
                    <div class="grid grid-cols-12 gap-4">
                        <div class="col-span-1">
                            <span class="text-xs font-semibold text-indigo-600 dark:text-indigo-400 uppercase tracking-wider">Código</span>
                        </div>
                        <div class="col-span-2">
                            <span class="text-xs font-semibold text-indigo-600 dark:text-indigo-400 uppercase tracking-wider">Nombre</span>
                        </div>
                        <div class="col-span-3">
                            <span class="text-xs font-semibold text-indigo-600 dark:text-indigo-400 uppercase tracking-wider">Descripción</span>
                        </div>
                        <div class="col-span-2">
                            <span class="text-xs font-semibold text-indigo-600 dark:text-indigo-400 uppercase tracking-wider">Nivel</span>
                        </div>
                        <div class="col-span-1">
                            <span class="text-xs font-semibold text-indigo-600 dark:text-indigo-400 uppercase tracking-wider">Usuarios</span>
                        </div>
                        <div class="col-span-1">
                            <span class="text-xs font-semibold text-indigo-600 dark:text-indigo-400 uppercase tracking-wider">Estado</span>
                        </div>
                        <div class="col-span-2">
                            <span class="text-xs font-semibold text-indigo-600 dark:text-indigo-400 uppercase tracking-wider">Acciones</span>
                        </div>
                    </div>
                </div>

                <!-- Table Body -->
                <div class="divide-y divide-gray-200 dark:divide-gray-700">
                    @foreach($roles as $role)
                        <div class="transition-colors">
                            <!-- Fila Normal -->
                            <div class="px-6 py-4 hover:bg-gray-50 dark:hover:bg-gray-700/50" wire:key="role-{{ $role->id }}">
                                <div class="grid grid-cols-12 gap-4 items-center">
                                    <div class="col-span-1">
                                        <span class="text-sm font-medium text-gray-900 dark:text-gray-100">{{ $role->codigo }}</span>
                                    </div>

                                    <div class="col-span-2">
                                        <span class="text-sm text-gray-900 dark:text-gray-100 font-semibold">{{ $role->nombre }}</span>
                                    </div>

                                    <div class="col-span-3">
                                        <span class="text-sm text-gray-600 dark:text-gray-400">{{ Str::limit($role->descripcion, 50) ?? 'Sin descripción' }}</span>
                                    </div>

                                    <div class="col-span-2">
                                        @if($role->nivel == 'administrador')
                                            <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-purple-100 dark:bg-purple-900/30 text-purple-800 dark:text-purple-300">
                                                👑 Administrador
                                            </span>
                                        @elseif($role->nivel == 'avanzado')
                                            <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-blue-100 dark:bg-blue-900/30 text-blue-800 dark:text-blue-300">
                                                ⭐ Avanzado
                                            </span>
                                        @elseif($role->nivel == 'intermedio')
                                            <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-green-100 dark:bg-green-900/30 text-green-800 dark:text-green-300">
                                                ✓ Intermedio
                                            </span>
                                        @else
                                            <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-gray-100 dark:bg-gray-700 text-gray-800 dark:text-gray-300">
                                                • Básico
                                            </span>
                                        @endif
                                    </div>

                                    <div class="col-span-1">
                                        <span class="text-sm font-semibold text-indigo-600 dark:text-indigo-400">{{ $role->usuarios_count }}</span>
                                    </div>

                                    <div class="col-span-1">
                                        @if($role->estado == 'activo')
                                            <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-green-100 dark:bg-green-900/30 text-green-800 dark:text-green-300">
                                                Activo
                                            </span>
                                        @else
                                            <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-red-100 dark:bg-red-900/30 text-red-800 dark:text-red-300">
                                                Inactivo
                                            </span>
                                        @endif
                                    </div>

                                    <div class="col-span-2 flex items-center gap-2">
                                        <a href="{{ route('role.show', $role->id) }}"
                                           class="text-indigo-600 dark:text-indigo-400 hover:text-indigo-900 dark:hover:text-indigo-300 font-medium text-sm transition-colors"
                                           title="Ver detalles">
                                            👁️ Ver
                                        </a>
                                        <button wire:click="editRole({{ $role->id }})"
                                                class="text-blue-600 dark:text-blue-400 hover:text-blue-900 dark:hover:text-blue-300 font-medium text-sm transition-colors"
                                                title="Editar">
                                            ✏️ Editar
                                        </button>
                                        <button wire:click="deleteRole({{ $role->id }})"
                                                wire:confirm="¿Estás seguro de eliminar este rol?"
                                                class="text-red-600 dark:text-red-400 hover:text-red-900 dark:hover:text-red-300 font-medium text-sm transition-colors"
                                                title="Eliminar">
                                            🗑️ Eliminar
                                        </button>
                                    </div>
                                </div>
                            </div>

                            <!-- Panel de Edición -->
                            @if($editingRoleId == $role->id)
                                <div class="px-6 py-6 bg-indigo-50 dark:bg-indigo-950/30 border-t border-b border-indigo-200 dark:border-indigo-800">
                                    <div class="flex items-center justify-between mb-4">
                                        <h3 class="text-lg font-semibold text-gray-900 dark:text-white">✏️ Editando: {{ $role->nombre }}</h3>
                                        <button wire:click="cancelEdit" class="text-gray-600 dark:text-gray-400 hover:text-gray-900 dark:hover:text-white">
                                            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                                            </svg>
                                        </button>
                                    </div>

                                    <form wire:submit.prevent="updateRole" class="space-y-6">
                                        <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
                                            <div>
                                                <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">Nombre</label>
                                                <input type="text" wire:model="editForm.nombre" class="w-full px-3 py-2 border border-gray-300 dark:border-gray-600 rounded-lg focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 text-gray-900 dark:text-white bg-white dark:bg-gray-700">
                                            </div>
                                            <div>
                                                <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">Código</label>
                                                <input type="text" wire:model="editForm.codigo" class="w-full px-3 py-2 border border-gray-300 dark:border-gray-600 rounded-lg focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 text-gray-900 dark:text-white bg-white dark:bg-gray-700">
                                            </div>
                                            <div>
                                                <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">Nivel</label>
                                                <select wire:model="editForm.nivel" class="w-full px-3 py-2 border border-gray-300 dark:border-gray-600 rounded-lg focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 text-gray-900 dark:text-white bg-white dark:bg-gray-700">
                                                    <option value="basico">Básico</option>
                                                    <option value="intermedio">Intermedio</option>
                                                    <option value="avanzado">Avanzado</option>
                                                    <option value="administrador">Administrador</option>
                                                </select>
                                            </div>
                                            <div class="md:col-span-2">
                                                <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">Descripción</label>
                                                <input type="text" wire:model="editForm.descripcion" class="w-full px-3 py-2 border border-gray-300 dark:border-gray-600 rounded-lg focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 text-gray-900 dark:text-white bg-white dark:bg-gray-700">
                                            </div>
                                            <div>
                                                <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">Estado</label>
                                                <select wire:model="editForm.estado" class="w-full px-3 py-2 border border-gray-300 dark:border-gray-600 rounded-lg focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 text-gray-900 dark:text-white bg-white dark:bg-gray-700">
                                                    <option value="activo">Activo</option>
                                                    <option value="inactivo">Inactivo</option>
                                                </select>
                                            </div>
                                        </div>

                                        <div class="flex justify-end gap-3 pt-4 border-t border-indigo-200 dark:border-indigo-800">
                                            <button type="button" wire:click="cancelEdit" class="px-4 py-2 border border-gray-300 dark:border-gray-600 text-gray-700 dark:text-gray-300 font-medium rounded-lg hover:bg-gray-50 dark:hover:bg-gray-700 transition-colors">
                                                Cancelar
                                            </button>
                                            <button type="submit" class="px-4 py-2 bg-indigo-600 hover:bg-indigo-700 dark:bg-indigo-500 dark:hover:bg-indigo-600 text-white font-medium rounded-lg transition-colors">
                                                💾 Guardar Cambios
                                            </button>
                                        </div>
                                    </form>
                                </div>
                            @endif
                        </div>
                    @endforeach
                </div>

                <!-- Footer -->
                <div class="px-6 py-4 bg-gray-50 dark:bg-gray-900/50 border-t border-gray-200 dark:border-gray-700">
                    <p class="text-sm text-gray-600 dark:text-gray-400">
                        Total de roles: <span class="font-semibold text-gray-900 dark:text-white">{{ count($roles) }}</span>
                    </p>
                </div>

            @else
                <!-- Empty State -->
                <div class="px-6 py-20 text-center">
                    <div class="flex justify-center mb-6">
                        <div class="w-24 h-24 bg-gray-100 dark:bg-gray-700 rounded-full flex items-center justify-center">
                            <span class="text-5xl">🎭</span>
                        </div>
                    </div>
                    <h3 class="text-xl font-semibold text-gray-900 dark:text-white mb-2">No hay roles registrados</h3>
                    <p class="text-gray-600 dark:text-gray-400 mb-6">Agrega tu primer rol para comenzar</p>
                    <a href="{{ route('role.create') }}" class="bg-indigo-600 hover:bg-indigo-700 dark:bg-indigo-500 dark:hover:bg-indigo-600 text-white font-medium px-6 py-3 rounded-lg inline-flex items-center gap-2 transition-colors shadow-sm">
                        <span class="text-lg">+</span>
                        Agregar Primer Rol
                    </a>
                </div>
            @endif

        </div>

    </div>
</div>
