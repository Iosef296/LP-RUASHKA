<div class="min-h-screen py-8 transition-colors">
    <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8">

        <style>
            input[type="number"]::-webkit-inner-spin-button,
            input[type="number"]::-webkit-outer-spin-button {
                -webkit-appearance: none;
                margin: 0;
            }
            input[type="number"] {
                -moz-appearance: textfield;
            }
        </style>

        <!-- Header -->
        <div class="mb-8">
            <div class="flex items-center gap-3 mb-2">
                <div class="text-3xl">✏️</div>
                <h1 class="text-3xl font-bold text-gray-900 dark:text-white">Editar Trabajador</h1>
            </div>
            <p class="text-gray-600 dark:text-gray-400 ml-12">Actualiza la información del trabajador</p>
        </div>

        <!-- Mensaje de éxito -->
        @if (session()->has('message'))
            <div class="mb-6 bg-green-50 dark:bg-green-900/30 border border-green-200 dark:border-green-800 text-green-800 dark:text-green-200 px-4 py-3 rounded-lg">
                {{ session('message') }}
            </div>
        @endif

        <!-- Formulario Card -->
        <div class="bg-white dark:bg-gray-800 rounded-xl shadow-md border border-gray-200 dark:border-gray-700 transition-colors">

            <form wire:submit.prevent="update">

                <!-- Card Header -->
                <div class="px-6 py-5 border-b border-gray-200 dark:border-gray-700 bg-gradient-to-r from-indigo-50 to-white dark:from-indigo-950/20 dark:to-gray-800">
                    <h2 class="text-xl font-semibold text-gray-900 dark:text-white">Información del Trabajador</h2>
                    <p class="text-sm text-gray-600 dark:text-gray-400 mt-1">Modifica los campos necesarios</p>
                </div>

                <!-- Formulario Body -->
                <div class="px-6 py-6 space-y-6">

                    <!-- Información Personal -->
                    <div>
                        <h3 class="text-sm font-semibold text-indigo-600 dark:text-indigo-400 uppercase tracking-wider mb-4">Datos Personales</h3>

                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">

                            <!-- Nombre -->
                            <div>
                                <label for="nombre" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">
                                    Nombre Completo <span class="text-red-500">*</span>
                                </label>
                                <input type="text"
                                       id="nombre"
                                       wire:model="nombre"
                                       class="w-full px-4 py-2.5 border border-gray-300 dark:border-gray-600 rounded-lg bg-white dark:bg-gray-900/50 text-gray-900 dark:text-white focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 transition-colors"
                                       placeholder="Ej: Juan Pérez García">
                                @error('nombre')
                                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                @enderror
                            </div>

                            <!-- DNI -->
                            <div>
                                <label for="dni" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">
                                    DNI/Documento <span class="text-red-500">*</span>
                                </label>
                                <input type="text"
                                       id="dni"
                                       wire:model="dni"
                                       class="w-full px-4 py-2.5 border border-gray-300 dark:border-gray-600 rounded-lg bg-white dark:bg-gray-900/50 text-gray-900 dark:text-white focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 transition-colors"
                                       placeholder="Ej: 12345678">
                                @error('dni')
                                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                @enderror
                            </div>

                            <!-- Email -->
                            <div>
                                <label for="email" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">
                                    Correo Electrónico <span class="text-red-500">*</span>
                                </label>
                                <input type="email"
                                       id="email"
                                       wire:model="email"
                                       class="w-full px-4 py-2.5 border border-gray-300 dark:border-gray-600 rounded-lg bg-white dark:bg-gray-900/50 text-gray-900 dark:text-white focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 transition-colors"
                                       placeholder="correo@ejemplo.com">
                                @error('email')
                                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                @enderror
                            </div>

                            <!-- Teléfono -->
                            <div>
                                <label for="telefono" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">
                                    Teléfono <span class="text-red-500">*</span>
                                </label>
                                <input type="tel"
                                       id="telefono"
                                       wire:model="telefono"
                                       class="w-full px-4 py-2.5 border border-gray-300 dark:border-gray-600 rounded-lg bg-white dark:bg-gray-900/50 text-gray-900 dark:text-white focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 transition-colors"
                                       placeholder="Ej: 987654321">
                                @error('telefono')
                                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                @enderror
                            </div>

                            <!-- Fecha de Nacimiento -->
                            <div>
                                <label for="fecha_nacimiento" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">
                                    Fecha de Nacimiento <span class="text-red-500">*</span>
                                </label>
                                <input type="date"
                                       id="fecha_nacimiento"
                                       wire:model="fecha_nacimiento"
                                       class="w-full px-4 py-2.5 border border-gray-300 dark:border-gray-600 rounded-lg bg-white dark:bg-gray-900/50 text-gray-900 dark:text-white focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 transition-colors [color-scheme:light] dark:[color-scheme:dark]">
                                @error('fecha_nacimiento')
                                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                @enderror
                            </div>

                            <!-- Género -->
                            <div>
                                <label for="genero" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">
                                    Género <span class="text-red-500">*</span>
                                </label>
                                <select id="genero"
                                        wire:model="genero"
                                        class="w-full px-4 py-2.5 border border-gray-300 dark:border-gray-600 rounded-lg bg-white dark:bg-gray-900/50 text-gray-900 dark:text-white focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 transition-colors">
                                    <option value="">Seleccionar...</option>
                                    <option value="masculino">Masculino</option>
                                    <option value="femenino">Femenino</option>
                                    <option value="otro">Otro</option>
                                </select>
                                @error('genero')
                                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                @enderror
                            </div>
                        </div>

                        <!-- Dirección -->
                        <div class="mt-6">
                            <label for="direccion" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">
                                Dirección
                            </label>
                            <input type="text"
                                   id="direccion"
                                   wire:model="direccion"
                                   class="w-full px-4 py-2.5 border border-gray-300 dark:border-gray-600 rounded-lg bg-white dark:bg-gray-900/50 text-gray-900 dark:text-white focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 transition-colors"
                                   placeholder="Ej: Av. Principal 123, Lima">
                            @error('direccion')
                                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>
                    </div>

                    <!-- Información Laboral -->
                    <div class="pt-6 border-t border-gray-200 dark:border-gray-700">
                        <h3 class="text-sm font-semibold text-indigo-600 dark:text-indigo-400 uppercase tracking-wider mb-4">Información Laboral</h3>

                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">

                                 <!-- Cargo -->
                        <div>
                            <label for="cargo" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">
                                Cargo <span class="text-red-500 dark:text-red-400">*</span>
                            </label>

                            <select id="cargo"
                                    wire:model="cargo"
                                    class="w-full px-4 py-2.5 border border-gray-300 dark:border-gray-600 rounded-lg
                                        focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 transition-colors
                                        text-gray-900 dark:text-white bg-white dark:bg-gray-700">
                                <option value="">Seleccionar...</option>
                                <option value="operario">Vendedor</option>
                                <option value="supervisor">Supervisor de Tienda</option>
                                <option value="jefe_area">Jefe de Produccion</option>
                                <option value="analista">Trabajador de Producción</option>
                                <option value="tecnico">Técnico de Mantenimiento</option>
                            </select>

                            @error('cargo')
                                <p class="mt-1 text-sm text-red-600 dark:text-red-400">{{ $message }}</p>
                            @enderror
                        </div>
                            <!-- Fecha Ingreso -->
                            <div>
                                <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">
                                    Fecha de Ingreso <span class="text-red-500">*</span>
                                </label>
                                <input type="date"
                                    wire:model="fecha_ingreso"
                                    class="w-full px-4 py-2.5 border border-gray-300 dark:border-gray-600 bg-white dark:bg-gray-900/50 rounded-lg text-gray-900 dark:text-white focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 transition-colors [color-scheme:light] dark:[color-scheme:dark]">
                            </div>

                            <!-- Salario -->
                            <div>
                                <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">
                                    Salario (S/.) <span class="text-red-500">*</span>
                                </label>
                                <div class="relative">
                                    <input type="number"
                                        wire:model="salario"
                                        step="50" min="0"
                                        class="w-full px-4 py-2.5 pr-20 border border-gray-300 dark:border-gray-600 rounded-lg bg-white dark:bg-gray-900/50 text-gray-900 dark:text-white focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500"
                                        placeholder="Ej: 1500.00">

                                    <div class="absolute inset-y-0 right-0 flex flex-col border-l border-gray-300 dark:border-gray-700">
                                        <button type="button"
                                            wire:click="incrementSalario"
                                            class="flex-1 px-3 text-indigo-600 dark:text-indigo-400 hover:bg-indigo-600 hover:text-white transition-colors border-b border-gray-300 dark:border-gray-700">
                                            ▲
                                        </button>
                                        <button type="button"
                                            wire:click="decrementSalario"
                                            class="flex-1 px-3 text-indigo-600 dark:text-indigo-400 hover:bg-indigo-600 hover:text-white transition-colors">
                                            ▼
                                        </button>
                                    </div>
                                </div>
                            </div>

                            <!-- Tipo contrato -->
                            <div>
                                <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">
                                    Tipo de Contrato <span class="text-red-500">*</span>
                                </label>
                                <select wire:model="tipo_contrato"
                                    class="w-full px-4 py-2.5 border border-gray-300 dark:border-gray-600 bg-white dark:bg-gray-900/50 rounded-lg text-gray-900 dark:text-white focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500">
                                    <option value="">Seleccionar...</option>
                                    <option value="indefinido">Indefinido</option>
                                    <option value="temporal">Temporal</option>
                                    <option value="practicas">Prácticas</option>
                                </select>
                            </div>

                            <!-- Estado -->
                            <div>
                                <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">
                                    Estado <span class="text-red-500">*</span>
                                </label>
                                <select wire:model="estado"
                                    class="w-full px-4 py-2.5 border border-gray-300 dark:border-gray-600 bg-white dark:bg-gray-900/50 rounded-lg text-gray-900 dark:text-white focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500">
                                    <option value="activo">Activo</option>
                                    <option value="inactivo">Inactivo</option>
                                    <option value="vacaciones">En Vacaciones</option>
                                </select>
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
                            class="w-full px-4 py-2.5 border border-gray-300 dark:border-gray-600 bg-white dark:bg-gray-900/50 rounded-lg text-gray-900 dark:text-white focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 transition-colors"
                            placeholder="Información adicional sobre el trabajador..."></textarea>
                    </div>

                </div>

                <!-- Footer botones -->
                <div class="px-6 py-4 bg-gray-50 dark:bg-gray-900/50 border-t border-gray-200 dark:border-gray-700 flex items-center justify-end gap-3">
                    <a href="{{ route('worker.show', $workerId) }}"
                       class="px-6 py-2.5 border border-gray-300 dark:border-gray-600 text-gray-700 dark:text-gray-300 font-medium rounded-lg hover:bg-gray-100 dark:hover:bg-gray-800 transition-colors">
                        Cancelar
                    </a>

                    <button type="submit"
                        class="bg-indigo-600 dark:bg-indigo-500 hover:bg-indigo-700 dark:hover:bg-indigo-600 text-white font-medium px-6 py-2.5 rounded-lg flex items-center gap-2 transition-colors shadow">
                        💾 Guardar Cambios
                    </button>
                </div>

            </form>

        </div>

    </div>
</div>
