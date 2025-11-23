<div class="max-w-7xl mx-auto p-4 sm:p-6 space-y-8">

    <!-- Título + Filtros -->
    <div class="flex flex-col md:flex-row md:items-center md:justify-between gap-4">
        <div>
            <h1 class="text-2xl sm:text-3xl font-bold text-gray-900">Inventario</h1>
            <p class="text-sm text-gray-500 mt-1">Gestiona tus productos y stock en tiempo real</p>
        </div>

        <div class="flex flex-col sm:flex-row gap-3 w-full sm:w-auto">
            <div class="relative flex-1 sm:w-64">
                <svg class="absolute left-3 top-1/2 transform -translate-y-1/2 w-5 h-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
                </svg>
                <input
                    wire:model.live="search"
                    type="text"
                    placeholder="Buscar producto..."
                    class="w-full pl-10 pr-4 py-2.5 border border-gray-300 rounded-lg focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 shadow-sm transition"
                >
            </div>

            <select
                wire:model.live="category_id"
                class="px-4 py-2.5 border border-gray-300 rounded-lg focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 shadow-sm"
            >
                <option value="">Todas las categorías</option>
                @foreach($categories as $cat)
                    <option value="{{ $cat->id }}">{{ $cat->name }}</option>
                @endforeach
            </select>

            <button
                wire:click="abrirCrear"
                class="flex items-center justify-center gap-2 bg-gradient-to-r from-indigo-600 to-purple-600 hover:from-indigo-700 hover:to-purple-700 text-white font-medium px-5 py-2.5 rounded-lg transition shadow-md hover:shadow-lg focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2"
            >
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/>
                </svg>
                <span class="hidden sm:inline">Agregar</span>
            </button>
        </div>
    </div>

    <!-- Tabla -->
    <div class="bg-white rounded-xl shadow-sm border border-gray-200 overflow-hidden">
        <div class="overflow-x-auto">
            <table class="min-w-full divide-y divide-gray-200">
                <thead class="bg-gray-50">
                    <tr>
                        <th class="px-4 sm:px-6 py-3 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">Producto</th>
                        <th class="px-4 sm:px-6 py-3 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">Categoría</th>
                        <th class="px-4 sm:px-6 py-3 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">Precio</th>
                        <th class="px-4 sm:px-6 py-3 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">Stock</th>
                        <th class="px-4 sm:px-6 py-3 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">Sede</th>
                        <th class="px-4 sm:px-6 py-3 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">Acciones</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-200 bg-white">
                    @forelse($products as $p)
                        <tr class="hover:bg-gray-50 transition-colors">
                            <td class="px-4 sm:px-6 py-4 font-medium text-gray-900">{{ $p->name }}</td>
                            <td class="px-4 sm:px-6 py-4 text-sm text-gray-600">{{ $p->category->name }}</td>
                            <td class="px-4 sm:px-6 py-4 text-gray-900 font-medium">S/ {{ number_format($p->price, 2) }}</td>
                            <td class="px-4 sm:px-6 py-4">
                                <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium
                                    {{ $p->quantity < 10 ? 'bg-red-100 text-red-800' : 'bg-green-100 text-green-800' }}">
                                    {{ $p->quantity }} {{ $p->quantity < 10 ? 'bajo' : 'disponible' }}
                                </span>
                            </td>
                            <td class="px-4 sm:px-6 py-4 text-sm text-gray-600">{{ $p->location }}</td>
                            <td class="px-4 sm:px-6 py-4 flex gap-2">
                                <button
                                    wire:click="editar({{ $p->id }})"
                                    class="inline-flex items-center text-indigo-600 hover:text-indigo-900 font-medium text-sm group"
                                    aria-label="Editar {{ $p->name }}"
                                >
                                    <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z" />
                                    </svg>
                                    Editar
                                </button>
                                <button
                                    wire:click="eliminar({{ $p->id }})"
                                    onclick="confirm('¿Seguro que deseas eliminar este producto?') || event.stopImmediatePropagation()"
                                    class="inline-flex items-center text-red-600 hover:text-red-900 font-medium text-sm group"
                                    aria-label="Eliminar {{ $p->name }}"
                                >
                                    <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
                                    </svg>
                                    Eliminar
                                </button>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="6" class="text-center py-12 text-gray-500">
                                <svg class="mx-auto h-12 w-12 text-gray-300" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 012-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10" />
                                </svg>
                                <p class="mt-3 text-lg font-medium text-gray-700">No hay productos registrados</p>
                                <p class="text-gray-500">Agrega tu primer producto desde el botón de arriba.</p>
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        @if($products->hasPages())
            <div class="px-4 py-3 bg-gray-50 border-t border-gray-200">
                {{ $products->links() }}
            </div>
        @endif
    </div>

    <!-- Modal -->
    @if($modalOpen)
        <div
            class="fixed inset-0 bg-black bg-opacity-50 z-50 flex items-center justify-center p-4"
            x-on:keydown.escape.window="window.livewire.emit('cerrarModal')"
        >
            <div class="bg-white rounded-2xl shadow-xl w-full max-w-2xl max-h-[90vh] overflow-y-auto focus:outline-none" tabindex="-1">
                <div class="bg-gradient-to-r from-indigo-600 to-purple-600 text-white px-6 py-5 rounded-t-2xl">
                    <h3 class="text-xl font-bold">{{ $editando ? 'Editar Producto' : 'Agregar al Inventario' }}</h3>
                    <p class="text-indigo-100 text-sm mt-1">Completa la información del producto</p>
                </div>

                <form wire:submit.prevent="guardar" class="p-6 space-y-5">
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-5">
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-1">Categoría *</label>
                            <select
                                wire:model="form.category_id"
                                required
                                class="w-full px-4 py-2.5 border border-gray-300 rounded-lg focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 shadow-sm"
                            >
                                <option value="">Selecciona una categoría</option>
                                @foreach($categories as $cat)
                                    <option value="{{ $cat->id }}">{{ $cat->name }}</option>
                                @endforeach
                            </select>
                        </div>

                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-1">Nombre del producto *</label>
                            <input
                                wire:model="form.name"
                                type="text"
                                required
                                placeholder="Ej: Chalina de alpaca roja"
                                class="w-full px-4 py-2.5 border border-gray-300 rounded-lg focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 shadow-sm"
                            >
                        </div>

                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-1">Precio (S/) *</label>
                            <input
                                wire:model="form.price"
                                type="number"
                                step="0.01"
                                min="0"
                                required
                                placeholder="0.00"
                                class="w-full px-4 py-2.5 border border-gray-300 rounded-lg focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 shadow-sm"
                            >
                        </div>

                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-1">Cantidad *</label>
                            <input
                                wire:model="form.quantity"
                                type="number"
                                min="0"
                                required
                                class="w-full px-4 py-2.5 border border-gray-300 rounded-lg focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 shadow-sm"
                            >
                        </div>

                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-1">Sede *</label>
                            <input
                                wire:model="form.location"
                                type="text"
                                required
                                placeholder="Ej: Lima Centro"
                                class="w-full px-4 py-2.5 border border-gray-300 rounded-lg focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 shadow-sm"
                            >
                        </div>

                        <div class="md:col-span-2">
                            <label class="block text-sm font-medium text-gray-700 mb-1">Descripción (opcional)</label>
                            <textarea
                                wire:model="form.description"
                                rows="3"
                                placeholder="Color, material, talla, u otras características..."
                                class="w-full px-4 py-2.5 border border-gray-300 rounded-lg focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 shadow-sm"
                            ></textarea>
                        </div>
                    </div>

                    <div class="flex flex-col sm:flex-row justify-end gap-3 pt-4">
                        <button
                            type="button"
                            wire:click="cerrarModal"
                            class="px-5 py-2.5 border border-gray-300 text-gray-700 rounded-lg hover:bg-gray-50 transition font-medium focus:outline-none focus:ring-2 focus:ring-gray-400"
                        >
                            Cancelar
                        </button>
                        <button
                            type="submit"
                            class="px-6 py-2.5 bg-gradient-to-r from-indigo-600 to-purple-600 hover:from-indigo-700 hover:to-purple-700 text-white font-medium rounded-lg shadow transition focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2"
                        >
                            {{ $editando ? 'Actualizar Producto' : 'Guardar Producto' }}
                        </button>
                    </div>
                </form>
            </div>
        </div>
    @endif

    <!-- Mensaje de éxito -->
    @if (session()->has('message'))
        <div
            x-data="{ show: true }"
            x-init="setTimeout(() => show = false, 3000)"
            x-show="show"
            class="fixed top-4 right-4 z-50"
        >
            <div class="bg-green-500 text-white px-5 py-3 rounded-lg shadow-lg flex items-center gap-2 animate-fade-in">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
                </svg>
                {{ session('message') }}
            </div>
        </div>
    @endif
</div>
