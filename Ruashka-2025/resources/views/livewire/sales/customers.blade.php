<div class="p-6 bg-gray-100 min-h-screen">
    <div class="flex justify-between items-center mb-6">
        <h1 class="text-3xl font-bold text-gray-800">Gestión de Clientes</h1>
        <button wire:click="create" class="bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded shadow">
            Nuevo Cliente
        </button>
    </div>

    @if (session()->has('message'))
        <div class="bg-green-100 text-green-700 p-4 rounded mb-6">
            {{ session('message') }}
        </div>
    @endif

    <div class="bg-white rounded shadow p-4 mb-6">
        <input wire:model.live.debounce.300ms="search" type="text" placeholder="Buscar por nombre o DNI..." class="w-full p-2 border rounded focus:ring-blue-500 focus:border-blue-500">
    </div>

    <div class="bg-white rounded shadow overflow-hidden">
        <table class="w-full text-left border-collapse">
            <thead class="bg-gray-50 border-b">
                <tr>
                    <th class="p-4 font-semibold text-gray-600">Nombre</th>
                    <th class="p-4 font-semibold text-gray-600">DNI / RUC</th>
                    <th class="p-4 font-semibold text-gray-600">Email</th>
                    <th class="p-4 font-semibold text-gray-600">Teléfono</th>
                    <th class="p-4 font-semibold text-gray-600 text-center">Acciones</th>
                </tr>
            </thead>
            <tbody>
                @forelse($customers as $customer)
                    <tr class="border-b hover:bg-gray-50">
                        <td class="p-4">{{ $customer->name }}</td>
                        <td class="p-4">{{ $customer->document_number }}</td>
                        <td class="p-4">{{ $customer->email }}</td>
                        <td class="p-4">{{ $customer->phone }}</td>
                        <td class="p-4 text-center">
                            <button wire:click="edit({{ $customer->id }})" class="text-blue-600 hover:underline mr-2">Editar</button>
                            <button wire:click="delete({{ $customer->id }})" wire:confirm="¿Estás seguro de eliminar este cliente?" class="text-red-600 hover:underline">Eliminar</button>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="5" class="p-8 text-center text-gray-500">No se encontraron clientes.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
        <div class="p-4">
            {{ $customers->links() }}
        </div>
    </div>

    <!-- Modal -->
    @if($isModalOpen)
        <div class="fixed inset-0 z-50 flex items-center justify-center bg-black bg-opacity-50">
            <div class="bg-white rounded-lg shadow-lg w-full max-w-md p-6">
                <h2 class="text-xl font-bold mb-4">{{ $isEditing ? 'Editar Cliente' : 'Nuevo Cliente' }}</h2>
                
                <form wire:submit.prevent="save">
                    <div class="mb-4">
                        <label class="block text-gray-700 font-bold mb-2">Nombre Completo</label>
                        <input wire:model="name" type="text" class="w-full p-2 border rounded focus:ring-blue-500 focus:border-blue-500">
                        @error('name') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
                    </div>

                    <div class="mb-4">
                        <label class="block text-gray-700 font-bold mb-2">DNI / RUC</label>
                        <input wire:model="document_number" type="text" class="w-full p-2 border rounded focus:ring-blue-500 focus:border-blue-500">
                        @error('document_number') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
                    </div>

                    <div class="mb-4">
                        <label class="block text-gray-700 font-bold mb-2">Email</label>
                        <input wire:model="email" type="email" class="w-full p-2 border rounded focus:ring-blue-500 focus:border-blue-500">
                        @error('email') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
                    </div>

                    <div class="mb-4">
                        <label class="block text-gray-700 font-bold mb-2">Teléfono</label>
                        <input wire:model="phone" type="text" class="w-full p-2 border rounded focus:ring-blue-500 focus:border-blue-500">
                    </div>

                    <div class="mb-6">
                        <label class="block text-gray-700 font-bold mb-2">Dirección</label>
                        <input wire:model="address" type="text" class="w-full p-2 border rounded focus:ring-blue-500 focus:border-blue-500">
                    </div>

                    <div class="flex justify-end gap-4">
                        <button type="button" wire:click="closeModal" class="bg-gray-300 hover:bg-gray-400 text-gray-800 px-4 py-2 rounded">Cancelar</button>
                        <button type="submit" class="bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded shadow">Guardar</button>
                    </div>
                </form>
            </div>
        </div>
    @endif
</div>
