<div class="flex flex-col gap-6">
    <div class="flex items-center justify-between">
        <h1 class="text-2xl font-bold">Registros de Acceso</h1>
    </div>

    <div class="flex items-center gap-4">
        <flux:input icon="magnifying-glass" placeholder="Buscar registros..." wire:model.live="search" class="w-full max-w-sm" />
    </div>

    <div class="overflow-hidden border rounded-xl border-zinc-200 dark:border-zinc-800">
        <table class="w-full text-sm text-left">
            <thead class="bg-zinc-50 dark:bg-zinc-900/50 text-zinc-500">
                <tr>
                    <th class="px-4 py-3 font-medium">Usuario</th>
                    <th class="px-4 py-3 font-medium">Acción</th>
                    <th class="px-4 py-3 font-medium">Detalles</th>
                    <th class="px-4 py-3 font-medium">Dirección IP</th>
                    <th class="px-4 py-3 font-medium">Fecha y Hora</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-zinc-200 dark:divide-zinc-800">
                @forelse($logs as $log)
                    <tr class="hover:bg-zinc-50 dark:hover:bg-zinc-900/50">
                        <td class="px-4 py-3 font-medium">{{ $log->user ? $log->user->name : 'Sistema' }}</td>
                        <td class="px-4 py-3">
                            <span class="inline-flex items-center px-2 py-1 text-xs font-medium rounded-full bg-zinc-100 text-zinc-700 dark:bg-zinc-800 dark:text-zinc-300">
                                {{ $log->action }}
                            </span>
                        </td>
                        <td class="px-4 py-3 text-zinc-500">{{ $log->details }}</td>
                        <td class="px-4 py-3 text-zinc-500 font-mono text-xs">{{ $log->ip_address }}</td>
                        <td class="px-4 py-3 text-zinc-500">{{ $log->created_at->format('M d, Y H:i:s') }}</td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="5" class="px-4 py-8 text-center text-zinc-500">No se encontraron registros de acceso.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    <div class="mt-4">
        {{ $logs->links() }}
    </div>
</div>
