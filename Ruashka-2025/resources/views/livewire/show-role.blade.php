<div class="min-h-screen bg-gray-50 dark:bg-gray-900 py-8 transition-colors">
    <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8">

        <!-- Header con botones -->
        <div class="flex items-center justify-between mb-8">
            <div>
                <div class="flex items-center gap-3 mb-2">
                    <div class="text-3xl">🎭</div>
                    <h1 class="text-3xl font-bold text-gray-900 dark:text-white">Detalles del Rol</h1>
                </div>
                <p class="text-gray-600 dark:text-gray-400 ml-12">Información completa del rol</p>
            </div>
            <div class="flex gap-3">
                <a href="{{ route('role.index') }}"
                   class="px-6 py-2.5 border border-gray-300 dark:border-gray-600 text-gray-700 dark:text-gray-300 font-medium rounded-lg hover:bg-gray-50 dark:hover:bg-gray-700 transition-colors">
                    ← Volver
                </a>
            </div>
        </div>

        <!-- Card Principal -->
        <div class="bg-white dark:bg-gray-800 rounded-xl shadow-sm border border-gray-200 dark:border-gray-700 transition-colors">

            <!-- Header del rol -->
            <div class="px-6 py-6 border-b border-gray-200 dark:border-gray-700 bg-gradient-to-r from-indigo-50 to-white dark:from-indigo-950/30 dark:to-gray-800">
                <div class="flex items-start justify-between">
                    <div>
                        <h2 class="text-2xl font-bold text-gray-900 dark:text-white mb-2">{{ $role->nombre }}</h2>
                        <div class="flex items-center gap-4 text-sm text-gray-600 dark:text-gray-400">
                            <span class="flex items-center gap-1">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 20l4-16m2 16l4-16M6 9h14M4 15h14"></path>
                                </svg>
                                Código: {{ $role->codigo }}
                            </span>
                            <span>•</span>
                            <span class="font-medium capitalize">Nivel: {{ $role->nivel }}</span>
                        </div>
                    </div>
                    <div>
                        @if($role->nivel == 'administrador')
                            <span class="inline-flex items-center px-3 py-1 rounded-full text-sm font-medium bg-purple-100 dark:bg-purple-900/30 text-purple-800 dark:text-purple-300">
                                👑 Administrador
                            </span>
                        @elseif($role->nivel == 'avanzado')
                            <span class="inline-flex items-center px-3 py-1 rounded-full text-sm font-medium bg-blue-100 dark:bg-blue-900/30 text-blue-800 dark:text-blue-300">
                                ⭐ Avanzado
                            </span>
                        @elseif($role->nivel == 'intermedio')
                            <span class="inline-flex items-center px-3 py-1 rounded-full text-sm font-medium bg-green-100 dark:bg-green-900/30 text-green-800 dark:text-green-300">
                                ✓ Intermedio
                            </span>
                        @else
                            <span class="inline-flex items-center px-3 py-1 rounded-full text-sm font-medium bg-gray-100 dark:bg-gray-700 text-gray-800 dark:text-gray-300">
                                • Básico
                            </span>
                        @endif
                    </div>
                </div>
            </div>

            <!-- Contenido -->
            <div class="px-6 py-6">

                <!-- Información Básica -->
                <div class="mb-8">
                    <h3 class="text-sm font-semibold text-indigo-600 dark:text-indigo-400 uppercase tracking-wider mb-4 flex items-center gap-2">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                        </svg>
                        Información Básica
                    </h3>

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <div class="bg-gray-50 dark:bg-gray-900/50 rounded-lg p-4">
                            <p class="text-xs font-medium text-gray-500 dark:text-gray-400 uppercase mb-1">Código</p>
                            <p class="text-base font-semibold text-gray-900 dark:text-white">{{ $role->codigo }}</p>
                        </div>

                        <div class="bg-gray-50 dark:bg-gray-900/50 rounded-lg p-4">
                            <p class="text-xs font-medium text-gray-500 dark:text-gray-400 uppercase mb-1">Nivel de Acceso</p>
                            <p class="text-base font-semibold text-gray-900 dark:text-white capitalize">{{ $role->nivel }}</p>
                        </div>

                        <div class="bg-indigo-50 dark:bg-indigo-950/30 rounded-lg p-4 border-2 border-indigo-200 dark:border-indigo-800">
                            <p class="text-xs font-medium text-indigo-600 dark:text-indigo-400 uppercase mb-1">Usuarios con este Rol</p>
                            <p class="text-xl font-bold text-indigo-900 dark:text-indigo-300">{{ $role->usuarios_count }} usuarios</p>
                        </div>

                        <div class="bg-gray-50 dark:bg-gray-900/50 rounded-lg p-4">
                            <p class="text-xs font-medium text-gray-500 dark:text-gray-400 uppercase mb-1">Departamento</p>
                            <p class="text-base font-semibold text-gray-900 dark:text-white capitalize">{{ $role->departamento ?? 'Todos' }}</p>
                        </div>

                        <div class="md:col-span-2 bg-gray-50 dark:bg-gray-900/50 rounded-lg p-4">
                            <p class="text-xs font-medium text-gray-500 dark:text-gray-400 uppercase mb-1">Descripción</p>
                            <p class="text-base font-semibold text-gray-900 dark:text-white">{{ $role->descripcion }}</p>
                        </div>

                        <div class="bg-gray-50 dark:bg-gray-900/50 rounded-lg p-4">
                            <p class="text-xs font-medium text-gray-500 dark:text-gray-400 uppercase mb-1">Estado</p>
                            @if($role->estado == 'activo')
                                <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-sm font-medium bg-green-100 dark:bg-green-900/30 text-green-800 dark:text-green-300">
                                    ✓ Activo
                                </span>
                            @else
                                <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-sm font-medium bg-red-100 dark:bg-red-900/30 text-red-800 dark:text-red-300">
                                    ✗ Inactivo
                                </span>
                            @endif
                        </div>
                    </div>
                </div>

                <!-- Permisos -->
                <div class="pt-6 border-t border-gray-200 dark:border-gray-700 mb-8">
                    <h3 class="text-sm font-semibold text-indigo-600 dark:text-indigo-400 uppercase tracking-wider mb-4 flex items-center gap-2">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z"></path>
                        </svg>
                        Permisos Asignados
                    </h3>

                    @if($role->permisos)
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                            @foreach($role->permisos as $modulo => $acciones)
                                <div class="bg-gray-50 dark:bg-gray-900/50 rounded-lg p-4 border border-gray-200 dark:border-gray-700">
                                    <h4 class="font-semibold text-gray-900 dark:text-white mb-3 capitalize flex items-center gap-2">
                                        @if($modulo == 'trabajadores')
                                            <span>👷</span>
                                        @elseif($modulo == 'sedes')
                                            <span>🏢</span>
                                        @elseif($modulo == 'roles')
                                            <span>🎭</span>
                                        @else
                                            <span>📊</span>
                                        @endif
                                        {{ ucfirst($modulo) }}
                                    </h4>
                                    <div class="space-y-2">
                                        @foreach($acciones as $accion => $valor)
                                            @if($valor)
                                                <div class="flex items-center gap-2">
                                                    <svg class="w-4 h-4 text-green-600 dark:text-green-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                                                    </svg>
                                                    <span class="text-sm text-gray-700 dark:text-gray-300 capitalize">{{ $accion }}</span>
                                                </div>
                                            @endif
                                        @endforeach
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    @else
                        <div class="bg-yellow-50 dark:bg-yellow-900/20 border border-yellow-200 dark:border-yellow-800 rounded-lg p-4">
                            <p class="text-sm text-yellow-800 dark:text-yellow-300">
                                ⚠️ Este rol no tiene permisos asignados aún.
                            </p>
                        </div>
                    @endif
                </div>

                <!-- Observaciones -->
                @if($role->observaciones)
                <div class="pt-6 border-t border-gray-200 dark:border-gray-700">
                    <h3 class="text-sm font-semibold text-indigo-600 dark:text-indigo-400 uppercase tracking-wider mb-4 flex items-center gap-2">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path>
                        </svg>
                        Observaciones
                    </h3>
                    <div class="bg-gray-50 dark:bg-gray-900/50 rounded-lg p-4">
                        <p class="text-gray-900 dark:text-gray-100">{{ $role->observaciones }}</p>
                    </div>
                </div>
                @endif

            </div>

            <!-- Footer -->
            <div class="px-6 py-4 bg-gray-50 dark:bg-gray-900/50 border-t border-gray-200 dark:border-gray-700 flex items-center justify-between">
                <p class="text-sm text-gray-600 dark:text-gray-400">
                    Creado: {{ \Carbon\Carbon::parse($role->created_at)->format('d/m/Y H:i') }}
                </p>
                <p class="text-sm text-gray-600 dark:text-gray-400">
                    Última actualización: {{ \Carbon\Carbon::parse($role->updated_at)->diffForHumans() }}
                </p>
            </div>

        </div>

    </div>
</div>
