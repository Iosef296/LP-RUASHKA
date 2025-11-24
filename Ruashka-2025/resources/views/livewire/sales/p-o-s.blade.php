<div class="flex h-screen bg-gray-100">
    <!-- Left Side: Product Catalog -->
    <div class="w-2/3 p-6 overflow-y-auto">
        <div class="mb-6">
            <input wire:model.live.debounce.300ms="search" type="text" placeholder="Buscar productos por nombre o SKU..." class="w-full p-4 rounded-lg shadow-sm border-gray-200 focus:ring-blue-500 focus:border-blue-500" autofocus>
        </div>

        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6">
            @foreach($this->products as $product)
                <div class="bg-white rounded-lg shadow-md p-4 hover:shadow-lg transition cursor-pointer" wire:click="addToCart({{ $product->id }})">
                    <div class="flex justify-between items-start">
                        <h3 class="font-bold text-gray-800 text-lg">{{ $product->name }}</h3>
                        <span class="bg-blue-100 text-blue-800 text-xs font-semibold px-2.5 py-0.5 rounded">{{ $product->sku }}</span>
                    </div>
                    <p class="text-gray-500 text-sm mt-1">{{ $product->unit_of_measure }}</p>
                    <div class="mt-4 flex justify-between items-center">
                        <span class="text-xl font-bold text-gray-900">${{ number_format($product->price, 2) }}</span>
                        <span class="text-sm {{ $product->stock_quantity > 0 ? 'text-green-600' : 'text-red-600' }}">
                            {{ $product->stock_quantity > 0 ? 'Disponible: ' . $product->stock_quantity : 'Agotado' }}
                        </span>
                    </div>
                </div>
            @endforeach
        </div>
    </div>

    <!-- Right Side: Cart & Checkout -->
    <div class="w-1/3 bg-white shadow-xl p-6 flex flex-col">
        <h2 class="text-2xl font-bold mb-4 text-gray-800">Carrito de Compras</h2>

        <!-- Cart Items -->
        <div class="flex-1 overflow-y-auto mb-4">
            @if(count($cart) > 0)
                <table class="w-full text-left">
                    <thead>
                        <tr class="text-gray-500 border-b">
                            <th class="pb-2">Producto</th>
                            <th class="pb-2 text-center">Cant.</th>
                            <th class="pb-2 text-right">Total</th>
                            <th class="pb-2"></th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($cart as $index => $item)
                            <tr class="border-b last:border-0">
                                <td class="py-3">
                                    <p class="font-semibold text-gray-800">{{ $item['name'] }}</p>
                                    <p class="text-xs text-gray-500">${{ number_format($item['price'], 2) }} / {{ $item['unit'] }}</p>
                                </td>
                                <td class="py-3 text-center">
                                    <input type="number" min="1" wire:change="updateQuantity({{ $index }}, $event.target.value)" value="{{ $item['quantity'] }}" class="w-16 text-center border rounded p-1">
                                </td>
                                <td class="py-3 text-right font-bold text-gray-800">
                                    ${{ number_format($item['subtotal'], 2) }}
                                </td>
                                <td class="py-3 text-right">
                                    <button wire:click="removeFromCart({{ $index }})" class="text-red-500 hover:text-red-700">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
                                        </svg>
                                    </button>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            @else
                <div class="text-center text-gray-500 mt-10">
                    <p>El carrito está vacío.</p>
                </div>
            @endif
        </div>

        <!-- Checkout Section -->
        <div class="border-t pt-4">
            <div class="flex justify-between items-center mb-4">
                <span class="text-xl font-bold text-gray-800">Total a Pagar</span>
                <span class="text-3xl font-bold text-blue-600">${{ number_format($this->total, 2) }}</span>
            </div>

                <!-- Customer Search -->
                <div class="mb-4">
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

            <!-- Payment Method -->
            <div class="mb-6">
                <label class="block text-sm font-medium text-gray-700 mb-1">Método de Pago</label>
                <select wire:model="paymentMethod" class="w-full p-2 border rounded focus:ring-blue-500 focus:border-blue-500">
                    <option value="efectivo">Efectivo</option>
                    <option value="tarjeta">Tarjeta</option>
                    <option value="transferencia">Transferencia</option>
                </select>
            </div>

            <button wire:click="checkout" class="w-full bg-green-600 hover:bg-green-700 text-white font-bold py-3 rounded-lg shadow-lg transition disabled:opacity-50 disabled:cursor-not-allowed" @if(count($cart) == 0 || !$selectedCustomerId) disabled @endif>
                Confirmar Venta
            </button>

            @if (session()->has('message'))
                <div class="mt-4 p-2 bg-green-100 text-green-700 rounded text-center">
                    {{ session('message') }}
                </div>
            @endif
        </div>
    </div>

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
