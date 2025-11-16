<div class="flex flex-col gap-6">
    <div class="flex items-center justify-between">
        <h1 class="text-2xl font-bold">Seguimiento de Asistencia</h1>
        <div class="flex items-center gap-2">
            <flux:input type="date" wire:model.live="date" class="w-40" />
        </div>
    </div>

    <div class="flex items-center gap-4">
        <flux:input icon="magnifying-glass" placeholder="Buscar personal..." wire:model.live="search" class="w-full max-w-sm" />
    </div>

    <div class="overflow-hidden border rounded-xl border-zinc-200 dark:border-zinc-800">
        <table class="w-full text-sm text-left">
            <thead class="bg-zinc-50 dark:bg-zinc-900/50 text-zinc-500">
                <tr>
                    <th class="px-4 py-3 font-medium">Nombre</th>
                    <th class="px-4 py-3 font-medium">Entrada</th>
                    <th class="px-4 py-3 font-medium">Salida</th>
                    <th class="px-4 py-3 font-medium">Estado</th>
                    <th class="px-4 py-3 font-medium text-right">Acciones</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-zinc-200 dark:divide-zinc-800">
                @forelse($personnel_list as $p)
                    <tr class="hover:bg-zinc-50 dark:hover:bg-zinc-900/50">
                        <td class="px-4 py-3 font-medium">{{ $p->first_name }} {{ $p->last_name }}</td>
                        <td class="px-4 py-3 text-zinc-500">
                            {{ $p->attendance?->check_in ? \Carbon\Carbon::parse($p->attendance->check_in)->format('H:i') : '-' }}
                        </td>
                        <td class="px-4 py-3 text-zinc-500">
                            {{ $p->attendance?->check_out ? \Carbon\Carbon::parse($p->attendance->check_out)->format('H:i') : '-' }}
                        </td>
                        <td class="px-4 py-3">
                            @if($p->attendance)
                                <span class="inline-flex items-center px-2 py-1 text-xs font-medium rounded-full 
                                    {{ $p->attendance->status === 'present' ? 'bg-green-100 text-green-700 dark:bg-green-900/30 dark:text-green-400' : '' }}
                                    {{ $p->attendance->status === 'late' ? 'bg-yellow-100 text-yellow-700 dark:bg-yellow-900/30 dark:text-yellow-400' : '' }}
                                    {{ $p->attendance->status === 'absent' ? 'bg-red-100 text-red-700 dark:bg-red-900/30 dark:text-red-400' : '' }}
                                    {{ $p->attendance->status === 'excused' ? 'bg-blue-100 text-blue-700 dark:bg-blue-900/30 dark:text-blue-400' : '' }}
                                ">
                                    {{ ucfirst($p->attendance->status) }}
                                </span>
                            @else
                                <span class="text-zinc-400">-</span>
                            @endif
                        </td>
                        <td class="px-4 py-3 text-right">
                            <div class="flex justify-end gap-2">
                                @if(!$p->attendance || !$p->attendance->check_in)
                                    <flux:button size="sm" variant="primary" wire:click="checkIn({{ $p->id }})">Entrada</flux:button>
                                @elseif(!$p->attendance->check_out)
                                    <flux:button size="sm" variant="ghost" wire:click="checkOut({{ $p->id }})">Salida</flux:button>
                                @endif

                                <flux:dropdown>
                                    <flux:button variant="ghost" size="sm" icon="ellipsis-horizontal" />
                                    <flux:menu>
                                        <flux:menu.item wire:click="updateStatus({{ $p->id }}, 'present')">Marcar Presente</flux:menu.item>
                                        <flux:menu.item wire:click="updateStatus({{ $p->id }}, 'late')">Marcar Tarde</flux:menu.item>
                                        <flux:menu.item wire:click="updateStatus({{ $p->id }}, 'absent')">Marcar Ausente</flux:menu.item>
                                        <flux:menu.item wire:click="updateStatus({{ $p->id }}, 'excused')">Marcar Justificado</flux:menu.item>
                                    </flux:menu>
                                </flux:dropdown>
                            </div>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="5" class="px-4 py-8 text-center text-zinc-500">No se encontró personal.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>
