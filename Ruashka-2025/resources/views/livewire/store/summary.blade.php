<div class="flex flex-col gap-6">
    <div class="flex items-center justify-between">
        <h1 class="text-2xl font-bold">Resumen de Tienda</h1>
        <flux:button variant="primary" icon="plus">Nuevo Incidente</flux:button>
    </div>

    <div class="grid grid-cols-1 gap-6 md:grid-cols-2 lg:grid-cols-4">
        <div class="flex flex-col gap-2 p-6 border rounded-xl bg-white dark:bg-zinc-900 border-zinc-200 dark:border-zinc-800">
            <span class="text-sm text-zinc-500">Personal Presente</span>
            <span class="text-3xl font-bold">{{ $personnelPresent }}/{{ $totalPersonnel }}</span>
            <span class="text-xs text-green-500">Registrado hoy</span>
        </div>
        <div class="flex flex-col gap-2 p-6 border rounded-xl bg-white dark:bg-zinc-900 border-zinc-200 dark:border-zinc-800">
            <span class="text-sm text-zinc-500">Incidentes Abiertos</span>
            <span class="text-3xl font-bold">{{ $openIncidents }}</span>
            <span class="text-xs {{ $criticalIncidents > 0 ? 'text-red-500' : 'text-zinc-500' }}">
                {{ $criticalIncidents }} críticos
            </span>
        </div>
        <div class="flex flex-col gap-2 p-6 border rounded-xl bg-white dark:bg-zinc-900 border-zinc-200 dark:border-zinc-800">
            <span class="text-sm text-zinc-500">Solicitudes Pendientes</span>
            <span class="text-3xl font-bold">{{ $pendingRequests }}</span>
            <span class="text-xs text-yellow-500">Necesita aprobación</span>
        </div>
        <div class="flex flex-col gap-2 p-6 border rounded-xl bg-white dark:bg-zinc-900 border-zinc-200 dark:border-zinc-800">
            <span class="text-sm text-zinc-500">Mantenimiento de Máquinas</span>
            <span class="text-3xl font-bold">{{ $maintenanceCount }}</span>
            <span class="text-xs text-blue-500">Activo o Programado</span>
        </div>
    </div>

    <div class="grid grid-cols-1 gap-6 lg:grid-cols-2">
        <div class="p-6 border rounded-xl bg-white dark:bg-zinc-900 border-zinc-200 dark:border-zinc-800">
            <h2 class="mb-4 text-lg font-semibold">Actividad Reciente</h2>
            <div class="space-y-4">
                @forelse($recentActivity as $activity)
                    <div class="flex items-center justify-between">
                        <div class="flex items-center gap-3">
                            @if($activity->type === 'incident')
                                <div class="flex items-center justify-center w-8 h-8 bg-red-100 rounded-full text-red-600">
                                    <flux:icon.exclamation-triangle class="w-4 h-4" />
                                </div>
                                <div>
                                    <p class="text-sm font-medium">Incidente: {{ $activity->title }}</p>
                                    <p class="text-xs text-zinc-500">{{ $activity->created_at->diffForHumans() }}</p>
                                </div>
                            @elseif($activity->type === 'request')
                                <div class="flex items-center justify-center w-8 h-8 bg-yellow-100 rounded-full text-yellow-600">
                                    <flux:icon.document-text class="w-4 h-4" />
                                </div>
                                <div>
                                    <p class="text-sm font-medium">Solicitud: {{ ucfirst($activity->type) }}</p>
                                    <p class="text-xs text-zinc-500">{{ $activity->created_at->diffForHumans() }}</p>
                                </div>
                            @elseif($activity->type === 'notice')
                                <div class="flex items-center justify-center w-8 h-8 bg-blue-100 rounded-full text-blue-600">
                                    <flux:icon.megaphone class="w-4 h-4" />
                                </div>
                                <div>
                                    <p class="text-sm font-medium">Aviso: {{ $activity->title }}</p>
                                    <p class="text-xs text-zinc-500">{{ $activity->created_at->diffForHumans() }}</p>
                                </div>
                            @endif
                        </div>
                    </div>
                @empty
                    <p class="text-sm text-zinc-500">No hay actividad reciente.</p>
                @endforelse
            </div>
        </div>

        <div class="p-6 border rounded-xl bg-white dark:bg-zinc-900 border-zinc-200 dark:border-zinc-800">
            <h2 class="mb-4 text-lg font-semibold">Acciones Rápidas</h2>
            <div class="grid grid-cols-2 gap-4">
                <flux:button class="w-full justify-start" icon="user-plus">Agregar Personal</flux:button>
                <flux:button class="w-full justify-start" icon="document-plus">Subir Documento</flux:button>
                <flux:button class="w-full justify-start" icon="calendar">Programar Turno</flux:button>
                <flux:button class="w-full justify-start" icon="chat-bubble-left">Enviar Aviso</flux:button>
            </div>
        </div>
    </div>
</div>
