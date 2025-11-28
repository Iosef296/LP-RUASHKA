<div class="flex h-full w-full flex-1 flex-col gap-4 rounded-xl">
    <div class="grid auto-rows-min gap-4 md:grid-cols-3">
        <a href="{{ route('store.summary') }}" class="relative aspect-video overflow-hidden rounded-xl border border-neutral-200 dark:border-neutral-700 hover:border-neutral-300 dark:hover:border-neutral-600 transition-colors group">
            <div class="absolute inset-0 flex items-center justify-center bg-neutral-50 dark:bg-neutral-800 group-hover:bg-neutral-100 dark:group-hover:bg-neutral-700 transition-colors">
                <div class="text-center">
                    <flux:icon.chart-bar class="w-10 h-10 mx-auto mb-2 text-neutral-500" />
                    <span class="font-medium text-neutral-900 dark:text-neutral-100">Resumen</span>
                </div>
            </div>
        </a>
        <a href="{{ route('store.personnel') }}" class="relative aspect-video overflow-hidden rounded-xl border border-neutral-200 dark:border-neutral-700 hover:border-neutral-300 dark:hover:border-neutral-600 transition-colors group">
            <div class="absolute inset-0 flex items-center justify-center bg-neutral-50 dark:bg-neutral-800 group-hover:bg-neutral-100 dark:group-hover:bg-neutral-700 transition-colors">
                <div class="text-center">
                    <flux:icon.users class="w-10 h-10 mx-auto mb-2 text-neutral-500" />
                    <span class="font-medium text-neutral-900 dark:text-neutral-100">Personal</span>
                </div>
            </div>
        </a>
        <a href="{{ route('store.attendance') }}" class="relative aspect-video overflow-hidden rounded-xl border border-neutral-200 dark:border-neutral-700 hover:border-neutral-300 dark:hover:border-neutral-600 transition-colors group">
            <div class="absolute inset-0 flex items-center justify-center bg-neutral-50 dark:bg-neutral-800 group-hover:bg-neutral-100 dark:group-hover:bg-neutral-700 transition-colors">
                <div class="text-center">
                    <flux:icon.clock class="w-10 h-10 mx-auto mb-2 text-neutral-500" />
                    <span class="font-medium text-neutral-900 dark:text-neutral-100">Asistencia</span>
                </div>
            </div>
        </a>
        <a href="{{ route('store.maintenance') }}" class="relative aspect-video overflow-hidden rounded-xl border border-neutral-200 dark:border-neutral-700 hover:border-neutral-300 dark:hover:border-neutral-600 transition-colors group">
            <div class="absolute inset-0 flex items-center justify-center bg-neutral-50 dark:bg-neutral-800 group-hover:bg-neutral-100 dark:group-hover:bg-neutral-700 transition-colors">
                <div class="text-center">
                    <flux:icon.wrench class="w-10 h-10 mx-auto mb-2 text-neutral-500" />
                    <span class="font-medium text-neutral-900 dark:text-neutral-100">Mantenimiento</span>
                </div>
            </div>
        </a>
        <a href="{{ route('store.documents') }}" class="relative aspect-video overflow-hidden rounded-xl border border-neutral-200 dark:border-neutral-700 hover:border-neutral-300 dark:hover:border-neutral-600 transition-colors group">
            <div class="absolute inset-0 flex items-center justify-center bg-neutral-50 dark:bg-neutral-800 group-hover:bg-neutral-100 dark:group-hover:bg-neutral-700 transition-colors">
                <div class="text-center">
                    <flux:icon.document-text class="w-10 h-10 mx-auto mb-2 text-neutral-500" />
                    <span class="font-medium text-neutral-900 dark:text-neutral-100">Documentos</span>
                </div>
            </div>
        </a>
        <a href="{{ route('store.incidents') }}" class="relative aspect-video overflow-hidden rounded-xl border border-neutral-200 dark:border-neutral-700 hover:border-neutral-300 dark:hover:border-neutral-600 transition-colors group">
            <div class="absolute inset-0 flex items-center justify-center bg-neutral-50 dark:bg-neutral-800 group-hover:bg-neutral-100 dark:group-hover:bg-neutral-700 transition-colors">
                <div class="text-center">
                    <flux:icon.exclamation-triangle class="w-10 h-10 mx-auto mb-2 text-neutral-500" />
                    <span class="font-medium text-neutral-900 dark:text-neutral-100">Incidentes</span>
                </div>
            </div>
        </a>
        <a href="{{ route('store.requests') }}" class="relative aspect-video overflow-hidden rounded-xl border border-neutral-200 dark:border-neutral-700 hover:border-neutral-300 dark:hover:border-neutral-600 transition-colors group">
            <div class="absolute inset-0 flex items-center justify-center bg-neutral-50 dark:bg-neutral-800 group-hover:bg-neutral-100 dark:group-hover:bg-neutral-700 transition-colors">
                <div class="text-center">
                    <flux:icon.inbox-arrow-down class="w-10 h-10 mx-auto mb-2 text-neutral-500" />
                    <span class="font-medium text-neutral-900 dark:text-neutral-100">Solicitudes</span>
                </div>
            </div>
        </a>
        <a href="{{ route('store.access-logs') }}" class="relative aspect-video overflow-hidden rounded-xl border border-neutral-200 dark:border-neutral-700 hover:border-neutral-300 dark:hover:border-neutral-600 transition-colors group">
            <div class="absolute inset-0 flex items-center justify-center bg-neutral-50 dark:bg-neutral-800 group-hover:bg-neutral-100 dark:group-hover:bg-neutral-700 transition-colors">
                <div class="text-center">
                    <flux:icon.shield-check class="w-10 h-10 mx-auto mb-2 text-neutral-500" />
                    <span class="font-medium text-neutral-900 dark:text-neutral-100">Registros de Acceso</span>
                </div>
            </div>
        </a>
        <a href="{{ route('store.communications') }}" class="relative aspect-video overflow-hidden rounded-xl border border-neutral-200 dark:border-neutral-700 hover:border-neutral-300 dark:hover:border-neutral-600 transition-colors group">
            <div class="absolute inset-0 flex items-center justify-center bg-neutral-50 dark:bg-neutral-800 group-hover:bg-neutral-100 dark:group-hover:bg-neutral-700 transition-colors">
                <div class="text-center">
                    <flux:icon.chat-bubble-left-right class="w-10 h-10 mx-auto mb-2 text-neutral-500" />
                    <span class="font-medium text-neutral-900 dark:text-neutral-100">Comunicaciones</span>
                </div>
            </div>
        </a>
    </div>
</div>
