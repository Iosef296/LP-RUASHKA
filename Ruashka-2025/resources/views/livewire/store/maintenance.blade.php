<div class="flex flex-col gap-6">
    <div class="flex items-center justify-between">
        <h1 class="text-2xl font-bold">Gestión de Mantenimiento</h1>
        <div class="flex gap-2">
            <flux:button variant="primary" icon="plus" wire:click="openModal('machine')">Agregar Máquina</flux:button>
            <flux:button variant="ghost" icon="wrench" wire:click="openModal('maintenance')">Programar Mantenimiento</flux:button>
            <flux:button variant="danger" icon="exclamation-triangle" wire:click="openModal('fault')">Reportar Avería</flux:button>
        </div>
    </div>

    <div class="flex items-center gap-4">
        <flux:input icon="magnifying-glass" placeholder="Buscar..." wire:model.live="search" class="w-full max-w-sm" />
    </div>

    <div class="border-b border-zinc-200 dark:border-zinc-800">
        <nav class="flex gap-4">
            <button 
                wire:click="setTab('machines')" 
                class="px-4 py-2 text-sm font-medium border-b-2 {{ $activeTab === 'machines' ? 'border-blue-500 text-blue-600 dark:text-blue-400' : 'border-transparent text-zinc-500 hover:text-zinc-700 dark:hover:text-zinc-300' }}">
                Máquinas
            </button>
            <button 
                wire:click="setTab('scheduled')" 
                class="px-4 py-2 text-sm font-medium border-b-2 {{ $activeTab === 'scheduled' ? 'border-blue-500 text-blue-600 dark:text-blue-400' : 'border-transparent text-zinc-500 hover:text-zinc-700 dark:hover:text-zinc-300' }}">
                Mantenimiento Programado
            </button>
            <button 
                wire:click="setTab('faults')" 
                class="px-4 py-2 text-sm font-medium border-b-2 {{ $activeTab === 'faults' ? 'border-blue-500 text-blue-600 dark:text-blue-400' : 'border-transparent text-zinc-500 hover:text-zinc-700 dark:hover:text-zinc-300' }}">
                Averías Reportadas
            </button>
        </nav>
    </div>

    @if($activeTab === 'machines')
        <div class="overflow-hidden border rounded-xl border-zinc-200 dark:border-zinc-800">
            <table class="w-full text-sm text-left">
                <thead class="bg-zinc-50 dark:bg-zinc-900/50 text-zinc-500">
                    <tr>
                        <th class="px-4 py-3 font-medium">Nombre</th>
                        <th class="px-4 py-3 font-medium">Número de Serie</th>
                        <th class="px-4 py-3 font-medium">Estado</th>
                        <th class="px-4 py-3 font-medium">Último Mantenimiento</th>
                        <th class="px-4 py-3 font-medium">Próximo Mantenimiento</th>
                        <th class="px-4 py-3 font-medium text-right">Acciones</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-zinc-200 dark:divide-zinc-800">
                    @forelse($machines as $m)
                        <tr class="hover:bg-zinc-50 dark:hover:bg-zinc-900/50">
                            <td class="px-4 py-3 font-medium">{{ $m->name }}</td>
                            <td class="px-4 py-3 text-zinc-500">{{ $m->serial_number }}</td>
                            <td class="px-4 py-3">
                                <span class="inline-flex items-center px-2 py-1 text-xs font-medium rounded-full 
                                    {{ $m->status === 'operational' ? 'bg-green-100 text-green-700 dark:bg-green-900/30 dark:text-green-400' : '' }}
                                    {{ $m->status === 'maintenance' ? 'bg-blue-100 text-blue-700 dark:bg-blue-900/30 dark:text-blue-400' : '' }}
                                    {{ $m->status === 'broken' ? 'bg-red-100 text-red-700 dark:bg-red-900/30 dark:text-red-400' : '' }}
                                ">
                                    {{ ucfirst($m->status) }}
                                </span>
                            </td>
                            <td class="px-4 py-3 text-zinc-500">{{ $m->last_maintenance ? $m->last_maintenance->format('M d, Y') : '-' }}</td>
                            <td class="px-4 py-3 text-zinc-500">{{ $m->next_maintenance ? $m->next_maintenance->format('M d, Y') : '-' }}</td>
                            <td class="px-4 py-3 text-right">
                                <flux:dropdown>
                                    <flux:button variant="ghost" size="sm" icon="ellipsis-horizontal" />
                                    <flux:menu>
                                        <flux:menu.item icon="pencil" wire:click="editMachine({{ $m->id }})">Editar</flux:menu.item>
                                        <flux:menu.item icon="trash" variant="danger" wire:click="deleteMachine({{ $m->id }})" wire:confirm="¿Estás seguro?">Eliminar</flux:menu.item>
                                    </flux:menu>
                                </flux:dropdown>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="6" class="px-4 py-8 text-center text-zinc-500">No se encontraron máquinas.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    @endif

    @if($activeTab === 'scheduled')
        <div class="overflow-hidden border rounded-xl border-zinc-200 dark:border-zinc-800">
            <table class="w-full text-sm text-left">
                <thead class="bg-zinc-50 dark:bg-zinc-900/50 text-zinc-500">
                    <tr>
                        <th class="px-4 py-3 font-medium">Máquina</th>
                        <th class="px-4 py-3 font-medium">Fecha</th>
                        <th class="px-4 py-3 font-medium">Tipo</th>
                        <th class="px-4 py-3 font-medium">Estado</th>
                        <th class="px-4 py-3 font-medium text-right">Acciones</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-zinc-200 dark:divide-zinc-800">
                    @forelse($maintenances as $mt)
                        <tr class="hover:bg-zinc-50 dark:hover:bg-zinc-900/50">
                            <td class="px-4 py-3 font-medium">{{ $mt->machine->name }}</td>
                            <td class="px-4 py-3 text-zinc-500">{{ $mt->scheduled_date->format('M d, Y') }}</td>
                            <td class="px-4 py-3 text-zinc-500">{{ ucfirst($mt->type) }}</td>
                            <td class="px-4 py-3">
                                <span class="inline-flex items-center px-2 py-1 text-xs font-medium rounded-full bg-zinc-100 text-zinc-700 dark:bg-zinc-800 dark:text-zinc-300">
                                    {{ ucfirst($mt->status) }}
                                </span>
                            </td>
                            <td class="px-4 py-3 text-right">
                                <flux:dropdown>
                                    <flux:button variant="ghost" size="sm" icon="ellipsis-horizontal" />
                                    <flux:menu>
                                        <flux:menu.item icon="pencil" wire:click="editMaintenance({{ $mt->id }})">Editar</flux:menu.item>
                                        <flux:menu.item icon="trash" variant="danger" wire:click="deleteMaintenance({{ $mt->id }})" wire:confirm="¿Estás seguro?">Eliminar</flux:menu.item>
                                    </flux:menu>
                                </flux:dropdown>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="5" class="px-4 py-8 text-center text-zinc-500">No hay mantenimiento programado.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    @endif

    @if($activeTab === 'faults')
        <div class="overflow-hidden border rounded-xl border-zinc-200 dark:border-zinc-800">
            <table class="w-full text-sm text-left">
                <thead class="bg-zinc-50 dark:bg-zinc-900/50 text-zinc-500">
                    <tr>
                        <th class="px-4 py-3 font-medium">Máquina</th>
                        <th class="px-4 py-3 font-medium">Reportado En</th>
                        <th class="px-4 py-3 font-medium">Prioridad</th>
                        <th class="px-4 py-3 font-medium">Estado</th>
                        <th class="px-4 py-3 font-medium text-right">Acciones</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-zinc-200 dark:divide-zinc-800">
                    @forelse($faults as $f)
                        <tr class="hover:bg-zinc-50 dark:hover:bg-zinc-900/50">
                            <td class="px-4 py-3 font-medium">{{ $f->machine->name }}</td>
                            <td class="px-4 py-3 text-zinc-500">{{ $f->reported_at->format('M d, Y H:i') }}</td>
                            <td class="px-4 py-3">
                                <span class="inline-flex items-center px-2 py-1 text-xs font-medium rounded-full 
                                    {{ $f->priority === 'low' ? 'bg-green-100 text-green-700 dark:bg-green-900/30 dark:text-green-400' : '' }}
                                    {{ $f->priority === 'medium' ? 'bg-yellow-100 text-yellow-700 dark:bg-yellow-900/30 dark:text-yellow-400' : '' }}
                                    {{ $f->priority === 'high' ? 'bg-orange-100 text-orange-700 dark:bg-orange-900/30 dark:text-orange-400' : '' }}
                                    {{ $f->priority === 'critical' ? 'bg-red-100 text-red-700 dark:bg-red-900/30 dark:text-red-400' : '' }}
                                ">
                                    {{ ucfirst($f->priority) }}
                                </span>
                            </td>
                            <td class="px-4 py-3">
                                <span class="inline-flex items-center px-2 py-1 text-xs font-medium rounded-full bg-zinc-100 text-zinc-700 dark:bg-zinc-800 dark:text-zinc-300">
                                    {{ ucfirst($f->status) }}
                                </span>
                            </td>
                            <td class="px-4 py-3 text-right">
                                <flux:dropdown>
                                    <flux:button variant="ghost" size="sm" icon="ellipsis-horizontal" />
                                    <flux:menu>
                                        <flux:menu.item icon="pencil" wire:click="editFault({{ $f->id }})">Editar</flux:menu.item>
                                        <flux:menu.item icon="trash" variant="danger" wire:click="deleteFault({{ $f->id }})" wire:confirm="¿Estás seguro?">Eliminar</flux:menu.item>
                                    </flux:menu>
                                </flux:dropdown>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="5" class="px-4 py-8 text-center text-zinc-500">No hay averías reportadas.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    @endif

    <flux:modal wire:model="showModal" class="md:w-96">
        <div class="space-y-6">
            <div>
                <h2 class="text-lg font-medium">
                    @if($modalType === 'machine') Agregar Máquina
                    @elseif($modalType === 'machine_edit') Editar Máquina
                    @elseif($modalType === 'maintenance') Programar Mantenimiento
                    @elseif($modalType === 'maintenance_edit') Editar Mantenimiento
                    @elseif($modalType === 'fault') Reportar Avería
                    @elseif($modalType === 'fault_edit') Editar Avería
                    @endif
                </h2>
            </div>

            @if($modalType === 'machine' || $modalType === 'machine_edit')
                <div class="space-y-4">
                    <flux:input label="Nombre" wire:model="machine_name" />
                    <flux:input label="Número de Serie" wire:model="serial_number" />
                    <div>
                        <label class="block text-sm font-medium text-zinc-700 dark:text-zinc-300 mb-1">Estado</label>
                        <select wire:model="machine_status" class="w-full px-3 py-2 border border-zinc-300 dark:border-zinc-700 rounded-lg bg-white dark:bg-zinc-900 text-zinc-900 dark:text-zinc-100 focus:ring-2 focus:ring-blue-500 focus:border-blue-500">
                            <option value="operational">Operativo</option>
                            <option value="maintenance">Mantenimiento</option>
                            <option value="broken">Averiado</option>
                        </select>
                    </div>
                </div>
                <div class="flex justify-end gap-2">
                    <flux:button variant="ghost" wire:click="$set('showModal', false)">Cancelar</flux:button>
                    <flux:button variant="primary" wire:click="{{ $modalType === 'machine' ? 'storeMachine' : 'updateMachine' }}">{{ $modalType === 'machine' ? 'Crear' : 'Guardar' }}</flux:button>
                </div>
            @elseif($modalType === 'maintenance' || $modalType === 'maintenance_edit')
                <div class="space-y-4">
                    <div>
                        <label class="block text-sm font-medium text-zinc-700 dark:text-zinc-300 mb-1">Máquina</label>
                        <select wire:model="selected_machine_id" class="w-full px-3 py-2 border border-zinc-300 dark:border-zinc-700 rounded-lg bg-white dark:bg-zinc-900 text-zinc-900 dark:text-zinc-100 focus:ring-2 focus:ring-blue-500 focus:border-blue-500">
                            <option value="">Seleccionar una máquina</option>
                            @foreach($all_machines as $machine)
                                <option value="{{ $machine->id }}">{{ $machine->name }}</option>
                            @endforeach
                        </select>
                    </div>
                    <flux:input type="date" label="Fecha" wire:model="scheduled_date" />
                    <div>
                        <label class="block text-sm font-medium text-zinc-700 dark:text-zinc-300 mb-1">Tipo</label>
                        <select wire:model="maintenance_type" class="w-full px-3 py-2 border border-zinc-300 dark:border-zinc-700 rounded-lg bg-white dark:bg-zinc-900 text-zinc-900 dark:text-zinc-100 focus:ring-2 focus:ring-blue-500 focus:border-blue-500">
                            <option value="preventive">Preventivo</option>
                            <option value="corrective">Correctivo</option>
                        </select>
                    </div>
                    <flux:textarea label="Descripción" wire:model="maintenance_description" />
                </div>
                <div class="flex justify-end gap-2">
                    <flux:button variant="ghost" wire:click="$set('showModal', false)">Cancelar</flux:button>
                    <flux:button variant="primary" wire:click="{{ $modalType === 'maintenance' ? 'storeMaintenance' : 'updateMaintenance' }}">{{ $modalType === 'maintenance' ? 'Programar' : 'Guardar' }}</flux:button>
                </div>
            @elseif($modalType === 'fault' || $modalType === 'fault_edit')
                <div class="space-y-4">
                    <div>
                        <label class="block text-sm font-medium text-zinc-700 dark:text-zinc-300 mb-1">Máquina</label>
                        <select wire:model="selected_machine_id" class="w-full px-3 py-2 border border-zinc-300 dark:border-zinc-700 rounded-lg bg-white dark:bg-zinc-900 text-zinc-900 dark:text-zinc-100 focus:ring-2 focus:ring-blue-500 focus:border-blue-500">
                            <option value="">Seleccionar una máquina</option>
                            @foreach($all_machines as $machine)
                                <option value="{{ $machine->id }}">{{ $machine->name }}</option>
                            @endforeach
                        </select>
                    </div>
                    <flux:textarea label="Descripción" wire:model="fault_description" />
                    <div>
                        <label class="block text-sm font-medium text-zinc-700 dark:text-zinc-300 mb-1">Prioridad</label>
                        <select wire:model="fault_priority" class="w-full px-3 py-2 border border-zinc-300 dark:border-zinc-700 rounded-lg bg-white dark:bg-zinc-900 text-zinc-900 dark:text-zinc-100 focus:ring-2 focus:ring-blue-500 focus:border-blue-500">
                            <option value="low">Baja</option>
                            <option value="medium">Media</option>
                            <option value="high">Alta</option>
                            <option value="critical">Crítica</option>
                        </select>
                    </div>
                </div>
                <div class="flex justify-end gap-2">
                    <flux:button variant="ghost" wire:click="$set('showModal', false)">Cancelar</flux:button>
                    <flux:button variant="danger" wire:click="{{ $modalType === 'fault' ? 'storeFault' : 'updateFault' }}">{{ $modalType === 'fault' ? 'Reportar' : 'Guardar' }}</flux:button>
                </div>
            @endif
        </div>
    </flux:modal>
</div>
