<div class="min-h-screen bg-gray-50 dark:bg-gray-900 py-8 transition-colors">
    <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8">

        <!-- Header con botones -->
        <div class="flex items-center justify-between mb-8">
            <div>
                <div class="flex items-center gap-3 mb-2">
                    <div class="text-3xl">🏢</div>
                    <h1 class="text-3xl font-bold text-gray-900 dark:text-white">Detalles de la Sede</h1>
                </div>
                <p class="text-gray-600 dark:text-gray-400 ml-12">Información completa de la sede</p>
            </div>
            <div class="flex gap-3">
                <a href="{{ route('sede.index') }}"
                   class="px-6 py-2.5 border border-gray-300 dark:border-gray-600 text-gray-700 dark:text-gray-300 font-medium rounded-lg hover:bg-gray-50 dark:hover:bg-gray-700 transition-colors">
                    ← Volver
                </a>
            </div>
        </div>

        <!-- Card Principal -->
        <div class="bg-white dark:bg-gray-800 rounded-xl shadow-sm border border-gray-200 dark:border-gray-700 transition-colors">

            <!-- Header de la sede -->
            <div class="px-6 py-6 border-b border-gray-200 dark:border-gray-700 bg-gradient-to-r from-indigo-50 to-white dark:from-indigo-950/30 dark:to-gray-800">
                <div class="flex items-start justify-between">
                    <div>
                        <h2 class="text-2xl font-bold text-gray-900 dark:text-white mb-2">{{ $sede->nombre }}</h2>
                        <div class="flex items-center gap-4 text-sm text-gray-600 dark:text-gray-400">
                            <span class="flex items-center gap-1">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 20l4-16m2 16l4-16M6 9h14M4 15h14"></path>
                                </svg>
                                Código: {{ $sede->codigo }}
                            </span>
                            <span>•</span>
                            <span class="font-medium capitalize">{{ $sede->tipo }}</span>
                        </div>
                    </div>
                    <div>
                        @if($sede->estado == 'activa')
                            <span class="inline-flex items-center px-3 py-1 rounded-full text-sm font-medium bg-green-100 dark:bg-green-900/30 text-green-800 dark:text-green-300">
                                ✓ Activa
                            </span>
                        @elseif($sede->estado == 'inactiva')
                            <span class="inline-flex items-center px-3 py-1 rounded-full text-sm font-medium bg-red-100 dark:bg-red-900/30 text-red-800 dark:text-red-300">
                                ✗ Inactiva
                            </span>
                        @else
                            <span class="inline-flex items-center px-3 py-1 rounded-full text-sm font-medium bg-yellow-100 dark:bg-yellow-900/30 text-yellow-800 dark:text-yellow-300">
                                🔧 Mantenimiento
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
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"></path>
                        </svg>
                        Datos Básicos
                    </h3>

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <div class="bg-gray-50 dark:bg-gray-900/50 rounded-lg p-4">
                            <p class="text-xs font-medium text-gray-500 dark:text-gray-400 uppercase mb-1">Código</p>
                            <p class="text-base font-semibold text-gray-900 dark:text-white">{{ $sede->codigo }}</p>
                        </div>

                        <div class="bg-gray-50 dark:bg-gray-900/50 rounded-lg p-4">
                            <p class="text-xs font-medium text-gray-500 dark:text-gray-400 uppercase mb-1">Tipo de Sede</p>
                            <p class="text-base font-semibold text-gray-900 dark:text-white capitalize">{{ $sede->tipo }}</p>
                        </div>

                        <div class="bg-indigo-50 dark:bg-indigo-950/30 rounded-lg p-4 border-2 border-indigo-200 dark:border-indigo-800">
                            <p class="text-xs font-medium text-indigo-600 dark:text-indigo-400 uppercase mb-1">Capacidad</p>
                            <p class="text-xl font-bold text-indigo-900 dark:text-indigo-300">{{ $sede->capacidad }} personas</p>
                        </div>

                        <div class="bg-gray-50 dark:bg-gray-900/50 rounded-lg p-4">
                            <p class="text-xs font-medium text-gray-500 dark:text-gray-400 uppercase mb-1">Encargado</p>
                            <p class="text-base font-semibold text-gray-900 dark:text-white">{{ $sede->encargado ?? 'Sin asignar' }}</p>
                        </div>
                    </div>
                </div>

                <!-- Ubicación -->
                <div class="pt-6 border-t border-gray-200 dark:border-gray-700 mb-8">
                    <h3 class="text-sm font-semibold text-indigo-600 dark:text-indigo-400 uppercase tracking-wider mb-4 flex items-center gap-2">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"></path>
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"></path>
                        </svg>
                        Ubicación
                    </h3>

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <div class="md:col-span-2 bg-gray-50 dark:bg-gray-900/50 rounded-lg p-4">
                            <p class="text-xs font-medium text-gray-500 dark:text-gray-400 uppercase mb-1">Dirección</p>
                            <p class="text-base font-semibold text-gray-900 dark:text-white">{{ $sede->direccion }}</p>
                        </div>

                        <div class="bg-gray-50 dark:bg-gray-900/50 rounded-lg p-4">
                            <p class="text-xs font-medium text-gray-500 dark:text-gray-400 uppercase mb-1">Ciudad</p>
                            <p class="text-base font-semibold text-gray-900 dark:text-white">{{ $sede->ciudad }}</p>
                        </div>

                        <div class="bg-gray-50 dark:bg-gray-900/50 rounded-lg p-4">
                            <p class="text-xs font-medium text-gray-500 dark:text-gray-400 uppercase mb-1">Departamento</p>
                            <p class="text-base font-semibold text-gray-900 dark:text-white">{{ $sede->departamento }}</p>
                        </div>
                    </div>
                </div>

                <!-- Información de Contacto -->
                <div class="pt-6 border-t border-gray-200 dark:border-gray-700 mb-8">
                    <h3 class="text-sm font-semibold text-indigo-600 dark:text-indigo-400 uppercase tracking-wider mb-4 flex items-center gap-2">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"></path>
                        </svg>
                        Información de Contacto
                    </h3>

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <div class="bg-gray-50 dark:bg-gray-900/50 rounded-lg p-4">
                            <p class="text-xs font-medium text-gray-500 dark:text-gray-400 uppercase mb-1">Teléfono</p>
                            <p class="text-base font-semibold text-gray-900 dark:text-white">{{ $sede->telefono }}</p>
                        </div>

                        @if($sede->email)
                        <div class="bg-gray-50 dark:bg-gray-900/50 rounded-lg p-4">
                            <p class="text-xs font-medium text-gray-500 dark:text-gray-400 uppercase mb-1">Correo Electrónico</p>
                            <p class="text-base font-semibold text-gray-900 dark:text-white">{{ $sede->email }}</p>
                        </div>
                        @endif
                    </div>
                </div>

                <!-- Observaciones -->
                @if($sede->observaciones)
                <div class="pt-6 border-t border-gray-200 dark:border-gray-700">
                    <h3 class="text-sm font-semibold text-indigo-600 dark:text-indigo-400 uppercase tracking-wider mb-4 flex items-center gap-2">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path>
                        </svg>
                        Observaciones
                    </h3>
                    <div class="bg-gray-50 dark:bg-gray-900/50 rounded-lg p-4">
                        <p class="text-gray-900 dark:text-gray-100">{{ $sede->observaciones }}</p>
                    </div>
                </div>
                @endif

            </div>

            <!-- Footer -->
            <div class="px-6 py-4 bg-gray-50 dark:bg-gray-900/50 border-t border-gray-200 dark:border-gray-700 flex items-center justify-between">
                <p class="text-sm text-gray-600 dark:text-gray-400">
                    Registrada: {{ \Carbon\Carbon::parse($sede->created_at)->format('d/m/Y H:i') }}
                </p>
                <p class="text-sm text-gray-600 dark:text-gray-400">
                    Última actualización: {{ \Carbon\Carbon::parse($sede->updated_at)->diffForHumans() }}
                </p>
            </div>

        </div>

    </div>
</div>
