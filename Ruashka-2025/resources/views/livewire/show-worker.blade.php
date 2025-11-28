<div class="min-h-screen bg-gray-50 dark:bg-gray-900 py-8 transition-colors">
    <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8">

        <!-- Header con botones -->
        <div class="flex items-center justify-between mb-8">
            <div>
                <div class="flex items-center gap-3 mb-2">
                    <div class="text-3xl">👷</div>
                    <h1 class="text-3xl font-bold text-gray-900 dark:text-white">Detalles del Trabajador</h1>
                </div>
                <p class="text-gray-600 dark:text-gray-400 ml-12">Información completa del trabajador</p>
            </div>
            <div class="flex gap-3">
                <a href="{{ route('worker.index') }}"
                   class="px-6 py-2.5 border border-gray-300 dark:border-gray-600 text-gray-700 dark:text-gray-300 font-medium rounded-lg hover:bg-gray-50 dark:hover:bg-gray-700 transition-colors">
                    ← Volver
                </a>
                <a href="{{ route('worker.edit', $worker->id) }}"
                   class="bg-indigo-600 hover:bg-indigo-700 dark:bg-indigo-500 dark:hover:bg-indigo-600 text-white font-medium px-6 py-2.5 rounded-lg flex items-center gap-2 transition-colors shadow-sm">
                    ✏️ Editar
                </a>
            </div>
        </div>

        <!-- Card Principal -->
        <div class="bg-white dark:bg-gray-800 rounded-xl shadow-sm border border-gray-200 dark:border-gray-700 transition-colors">

            <!-- Header del trabajador -->
            <div class="px-6 py-6 border-b border-gray-200 dark:border-gray-700 bg-gradient-to-r from-indigo-50 to-white dark:from-indigo-950/30 dark:to-gray-800">
                <div class="flex items-start justify-between">
                    <div>
                        <h2 class="text-2xl font-bold text-gray-900 dark:text-white mb-2">{{ $worker->nombre }}</h2>
                        <div class="flex items-center gap-4 text-sm text-gray-600 dark:text-gray-400">
                            <span class="flex items-center gap-1">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 6H5a2 2 0 00-2 2v9a2 2 0 002 2h14a2 2 0 002-2V8a2 2 0 00-2-2h-5m-4 0V5a2 2 0 114 0v1m-4 0a2 2 0 104 0m-5 8a2 2 0 100-4 2 2 0 000 4zm0 0c1.306 0 2.417.835 2.83 2M9 14a3.001 3.001 0 00-2.83 2M15 11h3m-3 4h2"></path>
                                </svg>
                                ID: #{{ $worker->id }}
                            </span>
                            <span>•</span>
                            <span class="font-medium">{{ $worker->role->nombre ?? 'Sin rol asignado' }}</span>
                        </div>
                    </div>
                    <div>
                        @if($worker->estado == 'activo')
                            <span class="inline-flex items-center px-3 py-1 rounded-full text-sm font-medium bg-green-100 dark:bg-green-900/30 text-green-800 dark:text-green-300">
                                ✓ Activo
                            </span>
                        @elseif($worker->estado == 'inactivo')
                            <span class="inline-flex items-center px-3 py-1 rounded-full text-sm font-medium bg-red-100 dark:bg-red-900/30 text-red-800 dark:text-red-300">
                                ✗ Inactivo
                            </span>
                        @else
                            <span class="inline-flex items-center px-3 py-1 rounded-full text-sm font-medium bg-yellow-100 dark:bg-yellow-900/30 text-yellow-800 dark:text-yellow-300">
                                ⏸ Vacaciones
                            </span>
                        @endif
                    </div>
                </div>
            </div>

            <!-- Contenido -->
            <div class="px-6 py-6">

                <!-- Información Personal -->
                <div class="mb-8">
                    <h3 class="text-sm font-semibold text-indigo-600 dark:text-indigo-400 uppercase tracking-wider mb-4 flex items-center gap-2">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path>
                        </svg>
                        Datos Personales
                    </h3>

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <div class="bg-gray-50 dark:bg-gray-900/50 rounded-lg p-4">
                            <p class="text-xs font-medium text-gray-500 dark:text-gray-400 uppercase mb-1">DNI/Documento</p>
                            <p class="text-base font-semibold text-gray-900 dark:text-white">{{ $worker->dni }}</p>
                        </div>

                        <div class="bg-gray-50 dark:bg-gray-900/50 rounded-lg p-4">
                            <p class="text-xs font-medium text-gray-500 dark:text-gray-400 uppercase mb-1">Correo Electrónico</p>
                            <p class="text-base font-semibold text-gray-900 dark:text-white">{{ $worker->email }}</p>
                        </div>

                        <div class="bg-gray-50 dark:bg-gray-900/50 rounded-lg p-4">
                            <p class="text-xs font-medium text-gray-500 dark:text-gray-400 uppercase mb-1">Teléfono</p>
                            <p class="text-base font-semibold text-gray-900 dark:text-white">{{ $worker->telefono }}</p>
                        </div>

                        <div class="bg-gray-50 dark:bg-gray-900/50 rounded-lg p-4">
                            <p class="text-xs font-medium text-gray-500 dark:text-gray-400 uppercase mb-1">Fecha de Nacimiento</p>
                            <p class="text-base font-semibold text-gray-900 dark:text-white">{{ \Carbon\Carbon::parse($worker->fecha_nacimiento)->format('d/m/Y') }}</p>
                        </div>

                        <div class="bg-gray-50 dark:bg-gray-900/50 rounded-lg p-4">
                            <p class="text-xs font-medium text-gray-500 dark:text-gray-400 uppercase mb-1">Género</p>
                            <p class="text-base font-semibold text-gray-900 dark:text-white capitalize">{{ $worker->genero }}</p>
                        </div>

                        @if($worker->direccion)
                        <div class="bg-gray-50 dark:bg-gray-900/50 rounded-lg p-4">
                            <p class="text-xs font-medium text-gray-500 dark:text-gray-400 uppercase mb-1">Dirección</p>
                            <p class="text-base font-semibold text-gray-900 dark:text-white">{{ $worker->direccion }}</p>
                        </div>
                        @endif
                    </div>
                </div>

                <!-- Información Laboral -->
                <div class="pt-6 border-t border-gray-200 dark:border-gray-700 mb-8">
                    <h3 class="text-sm font-semibold text-indigo-600 dark:text-indigo-400 uppercase tracking-wider mb-4 flex items-center gap-2">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 13.255A23.931 23.931 0 0112 15c-3.183 0-6.22-.62-9-1.745M16 6V4a2 2 0 00-2-2h-4a2 2 0 00-2 2v2m4 6h.01M5 20h14a2 2 0 002-2V8a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"></path>
                        </svg>
                        Información Laboral
                    </h3>

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <div class="bg-gray-50 dark:bg-gray-900/50 rounded-lg p-4">
                            <p class="text-xs font-medium text-gray-500 dark:text-gray-400 uppercase mb-1">Rol/Cargo</p>
                            <p class="text-base font-semibold text-gray-900 dark:text-white">{{ $worker->role->nombre ?? 'Sin rol asignado' }}</p>
                        </div>

                        <div class="bg-gray-50 dark:bg-gray-900/50 rounded-lg p-4">
                            <p class="text-xs font-medium text-gray-500 dark:text-gray-400 uppercase mb-1">Sede</p>
                            <p class="text-base font-semibold text-gray-900 dark:text-white">{{ $worker->sede->nombre ?? 'Sin sede asignada' }}</p>
                            @if($worker->sede)
                                <p class="text-xs text-gray-600 dark:text-gray-400 mt-1">{{ $worker->sede->ciudad }}, {{ $worker->sede->departamento }}</p>
                            @endif
                        </div>

                        <div class="bg-gray-50 dark:bg-gray-900/50 rounded-lg p-4">
                            <p class="text-xs font-medium text-gray-500 dark:text-gray-400 uppercase mb-1">Fecha de Ingreso</p>
                            <p class="text-base font-semibold text-gray-900 dark:text-white">{{ \Carbon\Carbon::parse($worker->fecha_ingreso)->format('d/m/Y') }}</p>
                        </div>

                        <div class="bg-gray-50 dark:bg-gray-900/50 rounded-lg p-4">
                            <p class="text-xs font-medium text-gray-500 dark:text-gray-400 uppercase mb-1">Antigüedad</p>
                            <p class="text-base font-semibold text-gray-900 dark:text-white">
                                {{ \Carbon\Carbon::parse($worker->fecha_ingreso)->diffForHumans(['parts' => 2]) }}
                            </p>
                        </div>

                        <div class="bg-indigo-50 dark:bg-indigo-950/30 rounded-lg p-4 border-2 border-indigo-200 dark:border-indigo-800">
                            <p class="text-xs font-medium text-indigo-600 dark:text-indigo-400 uppercase mb-1">Salario Mensual</p>
                            <p class="text-xl font-bold text-indigo-900 dark:text-indigo-300">S/. {{ number_format($worker->salario, 2) }}</p>
                        </div>

                        <div class="bg-gray-50 dark:bg-gray-900/50 rounded-lg p-4">
                            <p class="text-xs font-medium text-gray-500 dark:text-gray-400 uppercase mb-1">Tipo de Contrato</p>
                            <p class="text-base font-semibold text-gray-900 dark:text-white capitalize">{{ $worker->tipo_contrato }}</p>
                        </div>
                    </div>
                </div>

                <!-- Observaciones -->
                @if($worker->observaciones)
                <div class="pt-6 border-t border-gray-200 dark:border-gray-700">
                    <h3 class="text-sm font-semibold text-indigo-600 dark:text-indigo-400 uppercase tracking-wider mb-4 flex items-center gap-2">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path>
                        </svg>
                        Observaciones
                    </h3>
                    <div class="bg-gray-50 dark:bg-gray-900/50 rounded-lg p-4">
                        <p class="text-gray-900 dark:text-gray-100">{{ $worker->observaciones }}</p>
                    </div>
                </div>
                @endif

            </div>

            <!-- Footer -->
            <div class="px-6 py-4 bg-gray-50 dark:bg-gray-900/50 border-t border-gray-200 dark:border-gray-700 flex items-center justify-between">
                <p class="text-sm text-gray-600 dark:text-gray-400">
                    Registrado: {{ \Carbon\Carbon::parse($worker->created_at)->format('d/m/Y H:i') }}
                </p>
                <p class="text-sm text-gray-600 dark:text-gray-400">
                    Última actualización: {{ \Carbon\Carbon::parse($worker->updated_at)->diffForHumans() }}
                </p>
            </div>

        </div>

    </div>
</div>
