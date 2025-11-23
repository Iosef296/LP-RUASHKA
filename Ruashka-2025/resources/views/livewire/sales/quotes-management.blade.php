<div class="p-6 bg-gray-100 min-h-screen">
    <div class="flex justify-between items-center mb-6">
        <h1 class="text-3xl font-bold text-gray-800">Gestión de Cotizaciones</h1>
        @if(!$isCreating)
            <button wire:click="create" class="bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded shadow">
                Nueva Cotización
            </button>
        @endif
    </div>

    @if (session()->has('message'))
        <div class="bg-green-100 text-green-700 p-4 rounded mb-6">
            {{ session('message') }}
        </div>
    @endif

    @if($isCreating)
        <div class="bg-white rounded shadow p-6">
            <h2 class="text-xl font-bold mb-4">Nueva Cotización</h2>
            
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-6">
                <!-- Customer Search -->
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">Cliente</label>
                    <div class="flex gap-2">
                        <input type="text" value="{{ $customerSearch }}" readonly placeholder="Seleccione un cliente..." class="w-full p-2 border rounded bg-gray-50 cursor-not-allowed">
                        <button wire:click="openCustomerModal" class="bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded shadow">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
                            </svg>
                        </button>
                    </div>
                    @if($selectedCustomerId)
                        <div class="text-green-600 text-sm mt-1">Cliente seleccionado: {{ $customerSearch }}</div>
                    @endif
                </div>

                <!-- Expiration Date -->
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">Fecha de Vencimiento</label>
                    <input wire:model="expirationDate" type="date" class="w-full p-2 border rounded">
                </div>
            </div>

            <!-- Product Search -->
            <div class="mb-6 relative">
                <label class="block text-sm font-medium text-gray-700 mb-1">Agregar Producto</label>
                <input wire:model.live.debounce.300ms="productSearch" type="text" placeholder="Buscar producto por nombre o SKU..." class="w-full p-2 border rounded">
                @if(strlen($productSearch) >= 2)
                    <div class="absolute z-10 w-full bg-white shadow-lg rounded-md mt-1 border max-h-40 overflow-y-auto">
                        @foreach($this->products as $product)
                            <div wire:click="addProduct({{ $product->id }})" class="p-2 hover:bg-gray-100 cursor-pointer flex justify-between">
                                <span>{{ $product->name }}</span>
                                <span class="text-gray-500 text-sm">{{ $product->sku }}</span>
                            </div>
                        @endforeach
                    </div>
                @endif
            </div>

            <!-- Items Table -->
            <div class="mb-6">
                <table class="w-full text-left border-collapse">
                    <thead>
                        <tr class="bg-gray-50 border-b">
                            <th class="p-2">Producto</th>
                            <th class="p-2 w-24">Cant.</th>
                            <th class="p-2">Especificaciones Técnicas</th>
                            <th class="p-2 text-right">Subtotal</th>
                            <th class="p-2 w-10"></th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($cart as $index => $item)
                            <tr class="border-b">
                                <td class="p-2">{{ $item['name'] }}</td>
                                <td class="p-2">
                                    <input type="number" min="1" wire:change="updateQuantity({{ $index }}, $event.target.value)" value="{{ $item['quantity'] }}" class="w-full border rounded p-1">
                                </td>
                                <td class="p-2">
                                    <input type="text" wire:model="cart.{{ $index }}.specs" placeholder="Detalles..." class="w-full border rounded p-1">
                                </td>
                                <td class="p-2 text-right">${{ number_format($item['subtotal'], 2) }}</td>
                                <td class="p-2 text-center">
                                    <button wire:click="removeProduct({{ $index }})" class="text-red-500 hover:text-red-700">&times;</button>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>

            <div class="flex justify-end gap-4">
                <button wire:click="cancel" class="bg-gray-300 hover:bg-gray-400 text-gray-800 px-4 py-2 rounded">Cancelar</button>
                <button wire:click="save" class="bg-green-600 hover:bg-green-700 text-white px-4 py-2 rounded shadow">Guardar Cotización</button>
            </div>
        </div>
    @else
        <!-- Quotes List -->
        <div class="bg-white rounded shadow overflow-hidden">
            <table class="w-full text-left border-collapse">
                <thead class="bg-gray-50 border-b">
                    <tr>
                        <th class="p-4 font-semibold text-gray-600">ID</th>
                        <th class="p-4 font-semibold text-gray-600">Cliente</th>
                        <th class="p-4 font-semibold text-gray-600">Fecha Vencimiento</th>
                        <th class="p-4 font-semibold text-gray-600 text-right">Total Estimado</th>
                        <th class="p-4 font-semibold text-gray-600 text-center">Estado</th>
                        <th class="p-4 font-semibold text-gray-600 text-center">Acciones</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($quotes as $quote)
                        <tr class="border-b hover:bg-gray-50">
                            <td class="p-4">#{{ $quote->id }}</td>
                            <td class="p-4">{{ $quote->cliente->name }}</td>
                            <td class="p-4">{{ \Carbon\Carbon::parse($quote->fecha_vencimiento)->format('d/m/Y') }}</td>
                            <td class="p-4 text-right font-bold">${{ number_format($quote->total_estimado, 2) }}</td>
                            <td class="p-4 text-center">
                                <span class="px-2 py-1 rounded text-xs font-semibold
                                    {{ $quote->estado == 'Aceptada' ? 'bg-green-100 text-green-800' : 
                                       ($quote->estado == 'Enviada' ? 'bg-blue-100 text-blue-800' : 'bg-gray-100 text-gray-800') }}">
                                    {{ $quote->estado }}
                                </span>
                            </td>
                            <td class="p-4 text-center">
                                <button class="text-blue-600 hover:underline text-sm">Ver Detalles</button>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="6" class="p-8 text-center text-gray-500">No hay cotizaciones registradas.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    @endif

    <!-- Customer Selection Modal -->
    @if($isCustomerModalOpen)
        <div class="fixed inset-0 z-50 flex items-center justify-center bg-black bg-opacity-50">
            <div class="bg-white rounded-lg shadow-lg w-full max-w-md p-6 h-3/4 flex flex-col">
                <div class="flex justify-between items-center mb-4">
                    <h2 class="text-xl font-bold">Seleccionar Cliente</h2>
                    <button wire:click="closeCustomerModal" class="text-gray-500 hover:text-gray-700">&times;</button>
                </div>
                
                <div class="mb-4">
                    <input wire:model.live.debounce.300ms="customerSearchModal" type="text" placeholder="Buscar por nombre o DNI..." class="w-full p-2 border rounded focus:ring-blue-500 focus:border-blue-500" autofocus>
                </div>

                <div class="flex-1 overflow-y-auto">
                    @forelse($this->customers as $customer)
                        <div wire:click="selectCustomerFromModal({{ $customer->id }})" class="p-3 border-b hover:bg-gray-100 cursor-pointer flex justify-between items-center">
                            <div>
                                <p class="font-bold text-gray-800">{{ $customer->name }}</p>
                                <p class="text-xs text-gray-500">{{ $customer->document_number }}</p>
                            </div>
                            <span class="text-blue-600 text-sm">Seleccionar</span>
                        </div>
                    @empty
                        <p class="text-center text-gray-500 mt-4">No se encontraron clientes.</p>
                    @endforelse
                </div>

                <div class="mt-4 pt-4 border-t flex justify-end">
                    <button wire:click="closeCustomerModal" class="bg-gray-300 hover:bg-gray-400 text-gray-800 px-4 py-2 rounded">Cerrar</button>
                </div>
            </div>
        </div>
    @endif
</div>
