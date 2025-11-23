<div class="min-h-screen bg-gray-50 dark:bg-gray-900 py-8 transition-colors">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">

        <!-- Header -->
        <div class="flex items-center justify-between mb-8">
            <div>
                <div class="flex items-center gap-3 mb-2">
                    <div class="text-3xl">👷</div>
                    <h1 class="text-3xl font-bold text-gray-900 dark:text-white">Trabajadores</h1>
                </div>
                <p class="text-gray-600 dark:text-gray-400 ml-12">Gestión de personal de la empresa</p>
            </div>
            <a href="{{ route('worker.create') }}" class="bg-indigo-600 hover:bg-indigo-700 dark:bg-indigo-500 dark:hover:bg-indigo-600 text-white font-medium px-6 py-3 rounded-lg flex items-center gap-2 transition-colors shadow-sm">
                <span class="text-xl">+</span>
                Nuevo Trabajador
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
                <h2 class="text-xl font-semibold text-gray-900 dark:text-white">Listado de Trabajadores</h2>
                <p class="text-sm text-gray-600 dark:text-gray-400 mt-1">Gestiona todos tus trabajadores</p>
            </div>

            @if(isset($workers) && count($workers) > 0)
                <!-- Table Header -->
                <div class="px-6 py-4 bg-gray-50 dark:bg-gray-900/50 border-b border-gray-200 dark:border-gray-700">
                    <div class="grid grid-cols-12 gap-4">
                        <div class="col-span-1">
                            <span class="text-xs font-semibold text-indigo-600 dark:text-indigo-400 uppercase tracking-wider">ID</span>
                        </div>
                        <div class="col-span-2">
                            <span class="text-xs font-semibold text-indigo-600 dark:text-indigo-400 uppercase tracking-wider">Nombre</span>
                        </div>
                        <div class="col-span-2">
                            <span class="text-xs font-semibold text-indigo-600 dark:text-indigo-400 uppercase tracking-wider">DNI</span>
                        </div>
                        <div class="col-span-2">
                            <span class="text-xs font-semibold text-indigo-600 dark:text-indigo-400 uppercase tracking-wider">Cargo</span>
                        </div>
                        <div class="col-span-2">
                            <span class="text-xs font-semibold text-indigo-600 dark:text-indigo-400 uppercase tracking-wider">Sede</span>
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
                    @foreach($workers as $worker)
                        <div class="transition-colors">
                            <!-- Fila Normal -->
                            <div class="px-6 py-4 hover:bg-gray-50 dark:hover:bg-gray-700/50" wire:key="worker-{{ $worker->id }}">
                                <div class="grid grid-cols-12 gap-4 items-center">
                                    <!-- ID -->
                                    <div class="col-span-1">
                                        <span class="text-sm font-medium text-gray-900 dark:text-gray-100">{{ $worker->id }}</span>
                                    </div>

                                    <!-- Nombre -->
                                    <div class="col-span-2">
                                        <span class="text-sm text-gray-900 dark:text-gray-100">{{ $worker->nombre }}</span>
                                    </div>

                                    <!-- DNI -->
                                    <div class="col-span-2">
                                        <span class="text-sm text-gray-600 dark:text-gray-400">{{ $worker->dni }}</span>
                                    </div>

                                    <!-- Cargo/Rol -->
                                    <div class="col-span-2">
                                        <span class="text-sm text-gray-900 dark:text-gray-100">{{ $worker->role->nombre ?? 'Sin rol' }}</span>
                                    </div>

                                    <!-- Sede -->
                                    <div class="col-span-2">
                                        <span class="text-sm text-gray-600 dark:text-gray-400">{{ $worker->sede->nombre ?? 'Sin sede' }}</span>
                                    </div>

                                    <!-- Estado -->
                                    <div class="col-span-1">
                                        @if($worker->estado == 'activo')
                                            <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-green-100 dark:bg-green-900/30 text-green-800 dark:text-green-300">
                                                Activo
                                            </span>
                                        @elseif($worker->estado == 'inactivo')
                                            <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-red-100 dark:bg-red-900/30 text-red-800 dark:text-red-300">
                                                Inactivo
                                            </span>
                                        @else
                                            <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-yellow-100 dark:bg-yellow-900/30 text-yellow-800 dark:text-yellow-300">
                                                Vacaciones
                                            </span>
                                        @endif
                                    </div>

                                    <!-- Acciones -->
                                    <div class="col-span-2 flex items-center gap-2">
                                        <a href="{{ route('worker.show', $worker->id) }}"
                                           class="text-indigo-600 dark:text-indigo-400 hover:text-indigo-900 dark:hover:text-indigo-300 font-medium text-sm transition-colors"
                                           title="Ver detalles">
                                            👁️ Ver
                                        </a>
                                        <button wire:click="editWorker({{ $worker->id }})"
                                                class="text-blue-600 dark:text-blue-400 hover:text-blue-900 dark:hover:text-blue-300 font-medium text-sm transition-colors"
                                                title="Editar">
                                            ✏️ Editar
                                        </button>
                                        <button wire:click="deleteWorker({{ $worker->id }})"
                                                wire:confirm="¿Estás seguro de eliminar este trabajador?"
                                                class="text-red-600 dark:text-red-400 hover:text-red-900 dark:hover:text-red-300 font-medium text-sm transition-colors"
                                                title="Eliminar">
                                            🗑️ Eliminar
                                        </button>
                                    </div>
                                </div>
                            </div>

                            <!-- Panel de Edición -->
                            @if($editingWorkerId == $worker->id)
                                <div class="px-6 py-6 bg-indigo-50 dark:bg-indigo-950/30 border-t border-b border-indigo-200 dark:border-indigo-800">
                                    <div class="flex items-center justify-between mb-4">
                                        <h3 class="text-lg font-semibold text-gray-900 dark:text-white">✏️ Editando: {{ $worker->nombre }}</h3>
                                        <button wire:click="cancelEdit" class="text-gray-600 dark:text-gray-400 hover:text-gray-900 dark:hover:text-white">
                                            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                                            </svg>
                                        </button>
                                    </div>

                                    <form wire:submit.prevent="updateWorker" class="space-y-6">
                                        <!-- Datos Personales -->
                                        <div>
                                            <h4 class="text-sm font-semibold text-indigo-600 dark:text-indigo-400 uppercase tracking-wider mb-4">Datos Personales</h4>
                                            <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
                                                <div>
                                                    <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">Nombre Completo</label>
                                                    <input type="text" wire:model="editForm.nombre" class="w-full px-3 py-2 border border-gray-300 dark:border-gray-600 rounded-lg focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 text-gray-900 dark:text-white bg-white dark:bg-gray-700">
                                                    @error('editForm.nombre') <p class="text-xs text-red-600 dark:text-red-400 mt-1">{{ $message }}</p> @enderror
                                                </div>
                                                <div>
                                                    <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">DNI</label>
                                                    <input type="text" wire:model="editForm.dni" class="w-full px-3 py-2 border border-gray-300 dark:border-gray-600 rounded-lg focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 text-gray-900 dark:text-white bg-white dark:bg-gray-700">
                                                    @error('editForm.dni') <p class="text-xs text-red-600 dark:text-red-400 mt-1">{{ $message }}</p> @enderror
                                                </div>
                                                <div>
                                                    <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">Email</label>
                                                    <input type="email" wire:model="editForm.email" class="w-full px-3 py-2 border border-gray-300 dark:border-gray-600 rounded-lg focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 text-gray-900 dark:text-white bg-white dark:bg-gray-700">
                                                    @error('editForm.email') <p class="text-xs text-red-600 dark:text-red-400 mt-1">{{ $message }}</p> @enderror
                                                </div>
                                                <div>
                                                    <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">Teléfono</label>
                                                    <input type="tel" wire:model="editForm.telefono" class="w-full px-3 py-2 border border-gray-300 dark:border-gray-600 rounded-lg focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 text-gray-900 dark:text-white bg-white dark:bg-gray-700">
                                                    @error('editForm.telefono') <p class="text-xs text-red-600 dark:text-red-400 mt-1">{{ $message }}</p> @enderror
                                                </div>
                                                <div>
                                                    <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">Género</label>
                                                    <select wire:model="editForm.genero" class="w-full px-3 py-2 border border-gray-300 dark:border-gray-600 rounded-lg focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 text-gray-900 dark:text-white bg-white dark:bg-gray-700">
                                                        <option value="">Seleccionar...</option>
                                                        <option value="masculino">Masculino</option>
                                                        <option value="femenino">Femenino</option>
                                                        <option value="otro">Otro</option>
                                                    </select>
                                                </div>
                                            </div>
                                        </div>

                                        <!-- Información Laboral -->
                                        <div>
                                            <h4 class="text-sm font-semibold text-indigo-600 dark:text-indigo-400 uppercase tracking-wider mb-4">Información Laboral</h4>
                                            <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
                                                <div>
                                                    <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">Rol/Cargo</label>
                                                    <select wire:model="editForm.role_id" class="w-full px-3 py-2 border border-gray-300 dark:border-gray-600 rounded-lg focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 text-gray-900 dark:text-white bg-white dark:bg-gray-700">
                                                        <option value="">Seleccionar...</option>
                                                        @foreach($roles as $role)
                                                            <option value="{{ $role->id }}">{{ $role->nombre }}</option>
                                                        @endforeach
                                                    </select>
                                                    @error('editForm.role_id') <p class="text-xs text-red-600 dark:text-red-400 mt-1">{{ $message }}</p> @enderror
                                                </div>
                                                <div>
                                                    <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">Sede</label>
                                                    <select wire:model="editForm.sede_id" class="w-full px-3 py-2 border border-gray-300 dark:border-gray-600 rounded-lg focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 text-gray-900 dark:text-white bg-white dark:bg-gray-700">
                                                        <option value="">Seleccionar...</option>
                                                        @foreach($sedes as $sede)
                                                            <option value="{{ $sede->id }}">{{ $sede->nombre }}</option>
                                                        @endforeach
                                                    </select>
                                                    @error('editForm.sede_id') <p class="text-xs text-red-600 dark:text-red-400 mt-1">{{ $message }}</p> @enderror
                                                </div>
                                                <div>
                                                    <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">Salario (S/.)</label>
                                                    <input type="number" wire:model="editForm.salario" step="50" class="w-full px-3 py-2 border border-gray-300 dark:border-gray-600 rounded-lg focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 text-gray-900 dark:text-white bg-white dark:bg-gray-700">
                                                    @error('editForm.salario') <p class="text-xs text-red-600 dark:text-red-400 mt-1">{{ $message }}</p> @enderror
                                                </div>
                                                <div>
                                                    <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">Tipo de Contrato</label>
                                                    <select wire:model="editForm.tipo_contrato" class="w-full px-3 py-2 border border-gray-300 dark:border-gray-600 rounded-lg focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 text-gray-900 dark:text-white bg-white dark:bg-gray-700">
                                                        <option value="">Seleccionar...</option>
                                                        <option value="indefinido">Indefinido</option>
                                                        <option value="temporal">Temporal</option>
                                                        <option value="practicas">Prácticas</option>
                                                    </select>
                                                </div>
                                                <div>
                                                    <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">Estado</label>
                                                    <select wire:model="editForm.estado" class="w-full px-3 py-2 border border-gray-300 dark:border-gray-600 rounded-lg focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 text-gray-900 dark:text-white bg-white dark:bg-gray-700">
                                                        <option value="activo">Activo</option>
                                                        <option value="inactivo">Inactivo</option>
                                                        <option value="vacaciones">En Vacaciones</option>
                                                    </select>
                                                </div>
                                            </div>
                                        </div>

                                        <!-- Botones -->
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
                    <div class="flex items-center justify-between">
                        <p class="text-sm text-gray-600 dark:text-gray-400">
                            Total de trabajadores: <span class="font-semibold text-gray-900 dark:text-white">{{ count($workers) }}</span>
                        </p>
                    </div>
                </div>

            @else
                <!-- Empty State -->
                <div class="px-6 py-20 text-center">
                    <div class="flex justify-center mb-6">
                        <div class="w-24 h-24 bg-gray-100 dark:bg-gray-700 rounded-full flex items-center justify-center">
                            <svg class="w-12 h-12 text-gray-400 dark:text-gray-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z"></path>
                            </svg>
                        </div>
                    </div>
                    <h3 class="text-xl font-semibold text-gray-900 dark:text-white mb-2">No hay trabajadores registrados</h3>
                    <p class="text-gray-600 dark:text-gray-400 mb-6">Agrega tu primer trabajador para comenzar</p>
                    <a href="{{ route('worker.create') }}" class="bg-indigo-600 hover:bg-indigo-700 dark:bg-indigo-500 dark:hover:bg-indigo-600 text-white font-medium px-6 py-3 rounded-lg inline-flex items-center gap-2 transition-colors shadow-sm">
                        <span class="text-lg">+</span>
                        Agregar Primer Trabajador
                    </a>
                </div>
            @endif

        </div>

    </div>
</div>
