<div class="max-w-2xl mx-auto p-6 bg-white rounded-lg shadow-md mt-10">
    <h2 class="text-2xl font-bold mb-6 text-gray-800">Registrar Nuevo Cliente</h2>

    @if (session()->has('message'))
        <div class="bg-green-100 text-green-700 p-4 rounded mb-6">
            {{ session('message') }}
        </div>
    @endif

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
            <a href="{{ route('sales.dashboard') }}" class="bg-gray-300 hover:bg-gray-400 text-gray-800 px-4 py-2 rounded">Cancelar</a>
            <button type="submit" class="bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded shadow">Guardar Cliente</button>
        </div>
    </form>
</div>
