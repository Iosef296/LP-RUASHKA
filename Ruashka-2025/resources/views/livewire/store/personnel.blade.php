<div class="flex flex-col gap-6">
    <div class="flex items-center justify-between">
        <h1 class="text-2xl font-bold">Gestión de Personal</h1>
        <flux:button variant="primary" icon="plus" wire:click="create">Agregar Personal</flux:button>
    </div>

    <div class="flex items-center gap-4">
        <flux:input icon="magnifying-glass" placeholder="Buscar personal..." wire:model.live="search" class="w-full max-w-sm" />
    </div>

    <div class="overflow-hidden border rounded-xl border-zinc-200 dark:border-zinc-800">
        <table class="w-full text-sm text-left">
            <thead class="bg-zinc-50 dark:bg-zinc-900/50 text-zinc-500">
                <tr>
                    <th class="px-4 py-3 font-medium">Nombre</th>
                    <th class="px-4 py-3 font-medium">Correo</th>
                    <th class="px-4 py-3 font-medium">Teléfono</th>
                    <th class="px-4 py-3 font-medium">Fecha de Contratación</th>
                    <th class="px-4 py-3 font-medium">Roles</th>
                    <th class="px-4 py-3 font-medium">Estado</th>
                    <th class="px-4 py-3 font-medium text-right">Acciones</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-zinc-200 dark:divide-zinc-800">
                @forelse($personnel as $person)
                    <tr class="hover:bg-zinc-50 dark:hover:bg-zinc-900/50">
                        <td class="px-4 py-3 font-medium">{{ $person->first_name }} {{ $person->last_name }}</td>
                        <td class="px-4 py-3 text-zinc-500">{{ $person->email }}</td>
                        <td class="px-4 py-3 text-zinc-500">{{ $person->phone }}</td>
                        <td class="px-4 py-3 text-zinc-500">{{ $person->hire_date ? $person->hire_date->format('M d, Y') : '-' }}</td>
                        <td class="px-4 py-3">
                            <div class="flex flex-wrap gap-1">
                                @foreach($person->roles as $role)
                                    <span class="inline-flex items-center px-2 py-0.5 rounded text-xs font-medium bg-blue-100 text-blue-800 dark:bg-blue-900 dark:text-blue-300">
                                        {{ $role->name }}
                                    </span>
                                @endforeach
                            </div>
                        </td>
                        <td class="px-4 py-3">
                            <span class="inline-flex items-center px-2 py-1 rounded-full text-xs font-medium {{ $person->is_active ? 'bg-green-100 text-green-700 dark:bg-green-900/30 dark:text-green-400' : 'bg-red-100 text-red-700 dark:bg-red-900/30 dark:text-red-400' }}">
                                {{ $person->is_active ? 'Activo' : 'Inactivo' }}
                            </span>
                        </td>
                        <td class="px-4 py-3 text-right">
                            <flux:dropdown>
                                <flux:button variant="ghost" size="sm" icon="ellipsis-horizontal" />
                                <flux:menu>
                                    <flux:menu.item icon="pencil" wire:click="edit({{ $person->id }})">Editar</flux:menu.item>
                                    <flux:menu.item icon="trash" variant="danger" wire:click="delete({{ $person->id }})" wire:confirm="¿Estás seguro de que quieres eliminar a esta persona?">Eliminar</flux:menu.item>
                                </flux:menu>
                            </flux:dropdown>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="7" class="px-4 py-8 text-center text-zinc-500">No se encontró personal.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    <div class="mt-4">
        {{ $personnel->links() }}
    </div>

    <flux:modal wire:model="showModal" class="md:w-96">
        <div class="space-y-6">
            <div>
                <h2 class="text-lg font-medium">{{ $editMode ? 'Editar Personal' : 'Agregar Personal' }}</h2>
                <p class="text-sm text-zinc-500">Gestionar información del personal de la tienda.</p>
            </div>

            <div class="space-y-4">
                <flux:input label="Nombre" wire:model="first_name" />
                <flux:input label="Apellido" wire:model="last_name" />
                <flux:input label="Correo" type="email" wire:model="email" />
                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                    <flux:input label="Teléfono" wire:model="phone" />
                    <flux:input type="date" label="Fecha de Contratación" wire:model="hire_date" />
                </div>

                <div>
                    <label class="block text-sm font-medium text-zinc-700 dark:text-zinc-300 mb-2">Roles</label>
                    <div class="space-y-2 border border-zinc-200 dark:border-zinc-700 rounded-lg p-3 max-h-40 overflow-y-auto">
                        @foreach($roles as $role)
                            <label class="flex items-center gap-2 cursor-pointer">
                                <input type="checkbox" value="{{ $role->id }}" wire:model="selectedRoles" class="rounded border-zinc-300 text-blue-600 shadow-sm focus:border-blue-300 focus:ring focus:ring-blue-200 focus:ring-opacity-50 dark:bg-zinc-900 dark:border-zinc-700">
                                <span class="text-sm text-zinc-700 dark:text-zinc-300">{{ $role->name }}</span>
                            </label>
                        @endforeach
                    </div>
                </div>

                <div class="flex items-center gap-2">
                    <flux:checkbox label="Estado Activo" wire:model="is_active" />
                </div>
            </div>

            <div class="flex justify-end gap-2">
                <flux:button variant="ghost" wire:click="$set('showModal', false)">Cancelar</flux:button>
                <flux:button variant="primary" wire:click="{{ $editMode ? 'update' : 'store' }}">{{ $editMode ? 'Guardar Cambios' : 'Crear' }}</flux:button>
            </div>
        </div>
    </flux:modal>
</div>
