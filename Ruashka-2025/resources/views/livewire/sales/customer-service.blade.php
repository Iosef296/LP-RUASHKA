<div class="flex h-screen bg-gray-100">
    <!-- Left Side: Search & List -->
    <div class="w-1/3 bg-white border-r p-6 overflow-y-auto">
        <h2 class="text-2xl font-bold mb-6 text-gray-800">Atención al Cliente</h2>
        
        <div class="mb-6">
            <input wire:model.live.debounce.300ms="search" type="text" placeholder="Buscar cliente por nombre o DNI..." class="w-full p-3 border rounded-lg shadow-sm focus:ring-blue-500 focus:border-blue-500">
        </div>

        <div class="space-y-2">
            @forelse($this->customers as $customer)
                <div wire:click="selectCustomer({{ $customer->id }})" class="p-4 rounded-lg cursor-pointer transition {{ $selectedCustomerId == $customer->id ? 'bg-blue-50 border-blue-200 border' : 'hover:bg-gray-50 border border-transparent' }}">
                    <h3 class="font-bold text-gray-800">{{ $customer->name }}</h3>
                    <p class="text-sm text-gray-500">{{ $customer->document_number }}</p>
                    <p class="text-xs text-gray-400">{{ $customer->email }}</p>
                </div>
            @empty
                @if(strlen($search) >= 2)
                    <p class="text-center text-gray-500 mt-4">No se encontraron clientes.</p>
                @else
                    <p class="text-center text-gray-400 mt-4 text-sm">Ingrese al menos 2 caracteres para buscar.</p>
                @endif
            @endforelse
        </div>
    </div>

    <!-- Right Side: Customer Details -->
    <div class="w-2/3 p-8 overflow-y-auto">
        @if($this->selectedCustomer)
            <div class="bg-white rounded-lg shadow-md p-6 mb-8">
                <div class="flex justify-between items-start mb-4">
                    <div>
                        <h1 class="text-3xl font-bold text-gray-800">{{ $this->selectedCustomer->name }}</h1>
                        <p class="text-gray-500">Cliente desde {{ $this->selectedCustomer->created_at->format('Y') }}</p>
                    </div>
                    <span class="bg-green-100 text-green-800 px-3 py-1 rounded-full text-sm font-semibold">Activo</span>
                </div>
                
                <div class="grid grid-cols-2 gap-4 text-sm">
                    <div>
                        <p class="text-gray-500">Email</p>
                        <p class="font-medium">{{ $this->selectedCustomer->email ?? 'N/A' }}</p>
                    </div>
                    <div>
                        <p class="text-gray-500">Teléfono</p>
                        <p class="font-medium">{{ $this->selectedCustomer->phone ?? 'N/A' }}</p>
                    </div>
                    <div>
                        <p class="text-gray-500">DNI/RUC</p>
                        <p class="font-medium">{{ $this->selectedCustomer->document_number ?? 'N/A' }}</p>
                    </div>
                    <div>
                        <p class="text-gray-500">Dirección</p>
                        <p class="font-medium">{{ $this->selectedCustomer->address ?? 'N/A' }}</p>
                    </div>
                </div>
            </div>

            <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">
                <!-- Sales History -->
                <div class="bg-white rounded-lg shadow-md p-6">
                    <h3 class="text-xl font-bold mb-4 text-gray-800 border-b pb-2">Historial de Compras</h3>
                    <div class="space-y-4">
                        @forelse($this->selectedCustomer->ventas as $venta)
                            <div class="flex justify-between items-center p-3 bg-gray-50 rounded">
                                <div>
                                    <p class="font-semibold text-gray-700">Venta #{{ $venta->id }}</p>
                                    <p class="text-xs text-gray-500">{{ $venta->fecha_venta }}</p>
                                </div>
                                <span class="font-bold text-green-600">${{ number_format($venta->total, 2) }}</span>
                            </div>
                        @empty
                            <p class="text-gray-500 text-sm">No hay compras registradas.</p>
                        @endforelse
                    </div>
                </div>

                <!-- Quotes History -->
                <div class="bg-white rounded-lg shadow-md p-6">
                    <h3 class="text-xl font-bold mb-4 text-gray-800 border-b pb-2">Cotizaciones Recientes</h3>
                    <div class="space-y-4">
                        @forelse($this->selectedCustomer->cotizaciones as $cotizacion)
                            <div class="flex justify-between items-center p-3 bg-gray-50 rounded">
                                <div>
                                    <p class="font-semibold text-gray-700">Cotización #{{ $cotizacion->id }}</p>
                                    <p class="text-xs text-gray-500">Vence: {{ $cotizacion->fecha_vencimiento }}</p>
                                </div>
                                <div class="text-right">
                                    <p class="font-bold text-blue-600">${{ number_format($cotizacion->total_estimado, 2) }}</p>
                                    <span class="text-xs px-2 py-0.5 rounded bg-gray-200">{{ $cotizacion->estado }}</span>
                                </div>
                            </div>
                        @empty
                            <p class="text-gray-500 text-sm">No hay cotizaciones registradas.</p>
                        @endforelse
                    </div>
                </div>
            </div>
        @else
            <div class="flex flex-col items-center justify-center h-full text-gray-400">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-24 w-24 mb-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z" />
                </svg>
                <p class="text-xl">Seleccione un cliente para ver su información</p>
            </div>
        @endif
    </div>
</div>
