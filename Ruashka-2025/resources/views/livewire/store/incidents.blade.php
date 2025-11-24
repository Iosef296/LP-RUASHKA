<div class="flex flex-col gap-6">
    <div class="flex items-center justify-between">
        <h1 class="text-2xl font-bold">Reporte de Incidentes</h1>
        <flux:button variant="primary" icon="plus" wire:click="create">Reportar Incidente</flux:button>
    </div>

    <div class="flex items-center gap-4">
        <flux:input icon="magnifying-glass" placeholder="Buscar incidentes..." wire:model.live="search" class="w-full max-w-sm" />
    </div>

    <div class="overflow-hidden border rounded-xl border-zinc-200 dark:border-zinc-800">
        <table class="w-full text-sm text-left">
            <thead class="bg-zinc-50 dark:bg-zinc-900/50 text-zinc-500">
                <tr>
                    <th class="px-4 py-3 font-medium">Título</th>
                    <th class="px-4 py-3 font-medium">Fecha</th>
                    <th class="px-4 py-3 font-medium">Gravedad</th>
                    <th class="px-4 py-3 font-medium">Reportado Por</th>
                    <th class="px-4 py-3 font-medium">Estado</th>
                    <th class="px-4 py-3 font-medium text-right">Acciones</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-zinc-200 dark:divide-zinc-800">
                @forelse($incidents as $incident)
                    <tr class="hover:bg-zinc-50 dark:hover:bg-zinc-900/50">
                        <td class="px-4 py-3 font-medium">{{ $incident->title }}</td>
                        <td class="px-4 py-3 text-zinc-500">{{ $incident->occurred_at->format('M d, Y H:i') }}</td>
                        <td class="px-4 py-3">
                            <span class="inline-flex items-center px-2 py-1 text-xs font-medium rounded-full 
                                {{ $incident->severity === 'low' ? 'bg-green-100 text-green-700 dark:bg-green-900/30 dark:text-green-400' : '' }}
                                {{ $incident->severity === 'medium' ? 'bg-yellow-100 text-yellow-700 dark:bg-yellow-900/30 dark:text-yellow-400' : '' }}
                                {{ $incident->severity === 'high' ? 'bg-orange-100 text-orange-700 dark:bg-orange-900/30 dark:text-orange-400' : '' }}
                                {{ $incident->severity === 'critical' ? 'bg-red-100 text-red-700 dark:bg-red-900/30 dark:text-red-400' : '' }}
                            ">
                                {{ ucfirst($incident->severity) }}
                            </span>
                        </td>
                        <td class="px-4 py-3 text-zinc-500">{{ $incident->reporter ? $incident->reporter->first_name . ' ' . $incident->reporter->last_name : '-' }}</td>
                        <td class="px-4 py-3">
                            <span class="inline-flex items-center px-2 py-1 text-xs font-medium rounded-full bg-zinc-100 text-zinc-700 dark:bg-zinc-800 dark:text-zinc-300">
                                {{ ucfirst($incident->status) }}
                            </span>
                        </td>
                        <td class="px-4 py-3 text-right">
                            <flux:dropdown>
                                <flux:button variant="ghost" size="sm" icon="ellipsis-horizontal" />
                                <flux:menu>
                                    <flux:menu.item wire:click="updateStatus({{ $incident->id }}, 'investigating')">Marcar en Investigación</flux:menu.item>
                                    <flux:menu.item wire:click="updateStatus({{ $incident->id }}, 'resolved')">Marcar Resuelto</flux:menu.item>
                                    <flux:menu.item wire:click="updateStatus({{ $incident->id }}, 'closed')">Cerrar</flux:menu.item>
                                    <flux:menu.separator />
                                    <flux:menu.item icon="pencil" wire:click="edit({{ $incident->id }})">Editar</flux:menu.item>
                                    <flux:menu.item icon="trash" variant="danger" wire:click="delete({{ $incident->id }})" wire:confirm="¿Estás seguro?">Eliminar</flux:menu.item>
                                </flux:menu>
                            </flux:dropdown>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="6" class="px-4 py-8 text-center text-zinc-500">No se encontraron incidentes.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    <div class="mt-4">
        {{ $incidents->links() }}
    </div>

    <flux:modal wire:model="showModal" class="md:w-96">
        <div class="space-y-6">
            <div>
                <h2 class="text-lg font-medium">{{ $editMode ? 'Editar Incidente' : 'Reportar Incidente' }}</h2>
                <p class="text-sm text-zinc-500">{{ $editMode ? 'Actualizar detalles del incidente.' : 'Reportar un nuevo incidente administrativo.' }}</p>
            </div>

            <div class="space-y-4">
                <flux:input label="Título" wire:model="title" />
                <flux:textarea label="Descripción" wire:model="description" />
                <flux:input type="datetime-local" label="Fecha y Hora" wire:model="occurred_at" />
                <div>
                    <label class="block text-sm font-medium text-zinc-700 dark:text-zinc-300 mb-1">Gravedad</label>
                    <select wire:model="severity" class="w-full px-3 py-2 border border-zinc-300 dark:border-zinc-700 rounded-lg bg-white dark:bg-zinc-900 text-zinc-900 dark:text-zinc-100 focus:ring-2 focus:ring-blue-500 focus:border-blue-500">
                        <option value="low">Baja</option>
                        <option value="medium">Media</option>
                        <option value="high">Alta</option>
                        <option value="critical">Crítica</option>
                    </select>
                </div>
                <div>
                    <label class="block text-sm font-medium text-zinc-700 dark:text-zinc-300 mb-1">Reportado Por</label>
                    <select wire:model="reported_by" class="w-full px-3 py-2 border border-zinc-300 dark:border-zinc-700 rounded-lg bg-white dark:bg-zinc-900 text-zinc-900 dark:text-zinc-100 focus:ring-2 focus:ring-blue-500 focus:border-blue-500">
                        <option value="">Seleccionar Personal</option>
                        @foreach($personnel as $p)
                            <option value="{{ $p->id }}">{{ $p->first_name }} {{ $p->last_name }}</option>
                        @endforeach
                    </select>
                </div>
            </div>

            <div class="flex justify-end gap-2">
                <flux:button variant="ghost" wire:click="$set('showModal', false)">Cancelar</flux:button>
                <flux:button variant="primary" wire:click="{{ $editMode ? 'update' : 'store' }}">{{ $editMode ? 'Guardar Cambios' : 'Reportar' }}</flux:button>
            </div>
        </div>
    </flux:modal>
</div>
