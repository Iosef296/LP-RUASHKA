<div class="flex flex-col gap-6">
    <div class="flex items-center justify-between">
        <h1 class="text-2xl font-bold">Configuración de Tienda</h1>
        <flux:button variant="primary" wire:click="update">Guardar Cambios</flux:button>
    </div>

    <div class="grid grid-cols-1 gap-6 lg:grid-cols-2">
        <div class="p-6 space-y-6 border rounded-xl bg-white dark:bg-zinc-900 border-zinc-200 dark:border-zinc-800">
            <div>
                <h2 class="text-lg font-medium">Información General</h2>
                <p class="text-sm text-zinc-500">Detalles básicos sobre la tienda.</p>
            </div>

            <div class="space-y-4">
                <flux:input label="Nombre de la Tienda" wire:model="name" />
                <flux:input label="Dirección" wire:model="address" />
                <flux:input label="Teléfono" wire:model="phone" />
                <flux:input label="Nombre del Gerente" wire:model="manager_name" />
            </div>
        </div>

        <div class="p-6 space-y-6 border rounded-xl bg-white dark:bg-zinc-900 border-zinc-200 dark:border-zinc-800">
            <div>
                <h2 class="text-lg font-medium">Configuración</h2>
                <p class="text-sm text-zinc-500">Configuración del sistema para esta tienda.</p>
            </div>

            <div class="space-y-4">
                <div class="p-4 text-sm text-zinc-500 bg-zinc-50 dark:bg-zinc-800/50 rounded-lg">
                    <p>Las opciones de configuración adicionales aparecerán aquí según sea necesario.</p>
                </div>
                
                {{-- Example of dynamic settings --}}
                {{-- 
                @foreach($settings as $key => $value)
                    <flux:input label="{{ ucfirst(str_replace('_', ' ', $key)) }}" wire:model="settings.{{ $key }}" />
                @endforeach 
                --}}
            </div>
        </div>
    </div>
</div>
