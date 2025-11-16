<div class="flex flex-col gap-6">
    <div class="flex items-center justify-between">
        <h1 class="text-2xl font-bold">Solicitudes Internas</h1>
        <flux:button variant="primary" icon="plus" wire:click="create">Nueva Solicitud</flux:button>
    </div>

    <div class="flex items-center gap-4">
        <flux:input icon="magnifying-glass" placeholder="Buscar solicitudes..." wire:model.live="search" class="w-full max-w-sm" />
    </div>

    <div class="overflow-hidden border rounded-xl border-zinc-200 dark:border-zinc-800">
        <table class="w-full text-sm text-left">
            <thead class="bg-zinc-50 dark:bg-zinc-900/50 text-zinc-500">
                <tr>
                    <th class="px-4 py-3 font-medium">Tipo</th>
                    <th class="px-4 py-3 font-medium">Solicitante</th>
                    <th class="px-4 py-3 font-medium">Fecha</th>
                    <th class="px-4 py-3 font-medium">Estado</th>
                    <th class="px-4 py-3 font-medium">Aprobado Por</th>
                    <th class="px-4 py-3 font-medium text-right">Acciones</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-zinc-200 dark:divide-zinc-800">
                @forelse($requests as $req)
                    <tr class="hover:bg-zinc-50 dark:hover:bg-zinc-900/50">
                        <td class="px-4 py-3 font-medium">{{ $req->type }}</td>
                        <td class="px-4 py-3 text-zinc-500">{{ $req->requester ? $req->requester->first_name . ' ' . $req->requester->last_name : '-' }}</td>
                        <td class="px-4 py-3 text-zinc-500">{{ $req->created_at->format('M d, Y') }}</td>
                        <td class="px-4 py-3">
                            <span class="inline-flex items-center px-2 py-1 text-xs font-medium rounded-full 
                                {{ $req->status === 'approved' ? 'bg-green-100 text-green-700 dark:bg-green-900/30 dark:text-green-400' : '' }}
                                {{ $req->status === 'pending' ? 'bg-yellow-100 text-yellow-700 dark:bg-yellow-900/30 dark:text-yellow-400' : '' }}
                                {{ $req->status === 'rejected' ? 'bg-red-100 text-red-700 dark:bg-red-900/30 dark:text-red-400' : '' }}
                            ">
                                {{ ucfirst($req->status) }}
                            </span>
                        </td>
                        <td class="px-4 py-3 text-zinc-500">{{ $req->approver ? $req->approver->first_name . ' ' . $req->approver->last_name : '-' }}</td>
                        <td class="px-4 py-3 text-right">
                            <flux:dropdown>
                                <flux:button variant="ghost" size="sm" icon="ellipsis-horizontal" />
                                <flux:menu>
                                    <flux:menu.item wire:click="updateStatus({{ $req->id }}, 'approved')">Aprobar</flux:menu.item>
                                    <flux:menu.item wire:click="updateStatus({{ $req->id }}, 'rejected')" variant="danger">Rechazar</flux:menu.item>
                                    <flux:menu.separator />
                                    <flux:menu.item icon="pencil" wire:click="edit({{ $req->id }})">Editar</flux:menu.item>
                                    <flux:menu.item icon="trash" variant="danger" wire:click="delete({{ $req->id }})" wire:confirm="¿Estás seguro?">Eliminar</flux:menu.item>
                                </flux:menu>
                            </flux:dropdown>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="6" class="px-4 py-8 text-center text-zinc-500">No se encontraron solicitudes.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    <div class="mt-4">
        {{ $requests->links() }}
    </div>

    <flux:modal wire:model="showModal" class="md:w-96">
        <div class="space-y-6">
            <div>
                <h2 class="text-lg font-medium">{{ $editMode ? 'Editar Solicitud' : 'Nueva Solicitud' }}</h2>
                <p class="text-sm text-zinc-500">{{ $editMode ? 'Actualizar detalles de la solicitud.' : 'Enviar una nueva solicitud interna.' }}</p>
            </div>

            <div class="space-y-4">
                <div>
                    <label class="block text-sm font-medium text-zinc-700 dark:text-zinc-300 mb-1">Tipo</label>
                    <select wire:model="type" class="w-full px-3 py-2 border border-zinc-300 dark:border-zinc-700 rounded-lg bg-white dark:bg-zinc-900 text-zinc-900 dark:text-zinc-100 focus:ring-2 focus:ring-blue-500 focus:border-blue-500">
                        <option value="permission">Permiso</option>
                        <option value="resupply">Reabastecimiento Interno</option>
                        <option value="other">Otro</option>
                    </select>
                </div>
                <flux:textarea label="Detalles" wire:model="details" />
                <div>
                    <label class="block text-sm font-medium text-zinc-700 dark:text-zinc-300 mb-1">Solicitante</label>
                    <select wire:model="requester_id" class="w-full px-3 py-2 border border-zinc-300 dark:border-zinc-700 rounded-lg bg-white dark:bg-zinc-900 text-zinc-900 dark:text-zinc-100 focus:ring-2 focus:ring-blue-500 focus:border-blue-500">
                        <option value="">Seleccionar Personal</option>
                        @foreach($personnel as $p)
                            <option value="{{ $p->id }}">{{ $p->first_name }} {{ $p->last_name }}</option>
                        @endforeach
                    </select>
                </div>
            </div>

            <div class="flex justify-end gap-2">
                <flux:button variant="ghost" wire:click="$set('showModal', false)">Cancelar</flux:button>
                <flux:button variant="primary" wire:click="{{ $editMode ? 'update' : 'store' }}">{{ $editMode ? 'Guardar Cambios' : 'Enviar' }}</flux:button>
            </div>
        </div>
    </flux:modal>
</div>
