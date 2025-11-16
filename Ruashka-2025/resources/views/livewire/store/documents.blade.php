<div class="flex flex-col gap-6">
    <div class="flex items-center justify-between">
        <h1 class="text-2xl font-bold">Gestión de Documentos</h1>
        <flux:button variant="primary" icon="arrow-up-tray" wire:click="create">Subir Documento</flux:button>
    </div>

    <div class="flex items-center gap-4">
        <flux:input icon="magnifying-glass" placeholder="Buscar documentos..." wire:model.live="search" class="w-full max-w-sm" />
    </div>

    <div class="grid grid-cols-1 gap-6 md:grid-cols-2 lg:grid-cols-3">
        @forelse($documents as $doc)
            <div class="flex flex-col p-4 border rounded-xl bg-white dark:bg-zinc-900 border-zinc-200 dark:border-zinc-800">
                <div class="flex items-start justify-between mb-4">
                    <div class="flex items-center gap-3">
                        <div class="flex items-center justify-center w-10 h-10 rounded-lg bg-zinc-100 dark:bg-zinc-800 text-zinc-500">
                            <flux:icon.document-text class="w-6 h-6" />
                        </div>
                        <div>
                            <h3 class="font-medium truncate max-w-[150px]" title="{{ $doc->title }}">{{ $doc->title }}</h3>
                            <p class="text-xs text-zinc-500">{{ $doc->category }}</p>
                        </div>
                    </div>
                    <flux:dropdown>
                        <flux:button variant="ghost" size="sm" icon="ellipsis-horizontal" />
                        <flux:menu>
                            <flux:menu.item icon="arrow-down-tray" href="{{ Storage::url($doc->file_path) }}" download>Descargar</flux:menu.item>
                            <flux:menu.item icon="pencil" wire:click="edit({{ $doc->id }})">Editar</flux:menu.item>
                            <flux:menu.item icon="trash" variant="danger" wire:click="delete({{ $doc->id }})" wire:confirm="¿Estás seguro?">Eliminar</flux:menu.item>
                        </flux:menu>
                    </flux:dropdown>
                </div>
                <p class="text-sm text-zinc-600 dark:text-zinc-400 line-clamp-2 mb-4 flex-1">
                    {{ $doc->description ?: 'Sin descripción.' }}
                </p>
                <div class="flex items-center justify-between text-xs text-zinc-500 mt-auto">
                    <span>{{ $doc->created_at->format('M d, Y') }}</span>
                    <span>
                        @if(Storage::exists($doc->file_path))
                            {{ number_format(Storage::size($doc->file_path) / 1024, 2) }} KB
                        @else
                            <span class="text-red-500">Archivo faltante</span>
                        @endif
                    </span>
                </div>
            </div>
        @empty
            <div class="col-span-full py-12 text-center text-zinc-500 border border-dashed rounded-xl border-zinc-200 dark:border-zinc-800">
                <flux:icon.document-text class="w-12 h-12 mx-auto mb-3 text-zinc-300 dark:text-zinc-700" />
                <p>No se encontraron documentos.</p>
            </div>
        @endforelse
    </div>

    <div class="mt-4">
        {{ $documents->links() }}
    </div>

    <flux:modal wire:model="showModal" class="md:w-96">
        <div class="space-y-6">
            <div>
                <h2 class="text-lg font-medium">{{ $editMode ? 'Editar Documento' : 'Subir Documento' }}</h2>
                <p class="text-sm text-zinc-500">{{ $editMode ? 'Actualizar detalles del documento.' : 'Subir un nuevo documento al repositorio de la tienda.' }}</p>
            </div>

            <div class="space-y-4">
                <flux:input label="Título" wire:model="title" />
                <div>
                    <label class="block text-sm font-medium text-zinc-700 dark:text-zinc-300 mb-1">Categoría</label>
                    <select wire:model="category" class="w-full px-3 py-2 border border-zinc-300 dark:border-zinc-700 rounded-lg bg-white dark:bg-zinc-900 text-zinc-900 dark:text-zinc-100 focus:ring-2 focus:ring-blue-500 focus:border-blue-500">
                        <option value="protocol">Protocolo</option>
                        <option value="regulation">Reglamento</option>
                        <option value="manual">Manual</option>
                        <option value="other">Otro</option>
                    </select>
                </div>
                <flux:textarea label="Descripción" wire:model="description" />
                
                <div>
                    <label class="block mb-2 text-sm font-medium text-zinc-900 dark:text-zinc-100">Archivo {{ $editMode ? '(Opcional)' : '' }}</label>
                    <input type="file" wire:model="file" class="block w-full text-sm text-zinc-500 file:mr-4 file:py-2 file:px-4 file:rounded-full file:border-0 file:text-sm file:font-semibold file:bg-zinc-100 file:text-zinc-700 hover:file:bg-zinc-200 dark:file:bg-zinc-800 dark:file:text-zinc-300" />
                    @error('file') <span class="text-xs text-red-500">{{ $message }}</span> @enderror
                </div>
            </div>

            <div class="flex justify-end gap-2">
                <flux:button variant="ghost" wire:click="$set('showModal', false)">Cancelar</flux:button>
                <flux:button variant="primary" wire:click="{{ $editMode ? 'update' : 'store' }}">{{ $editMode ? 'Guardar Cambios' : 'Subir' }}</flux:button>
            </div>
        </div>
    </flux:modal>
</div>
