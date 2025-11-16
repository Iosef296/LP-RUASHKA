<div class="flex flex-col gap-6">
    <div class="flex items-center justify-between">
        <h1 class="text-2xl font-bold">Comunicaciones</h1>
        <div class="flex gap-2">
            <flux:button variant="primary" icon="megaphone" wire:click="openModal('notice')">Publicar Aviso</flux:button>
            <flux:button variant="ghost" icon="paper-airplane" wire:click="openModal('message')">Enviar Mensaje</flux:button>
        </div>
    </div>

    <div class="flex items-center gap-4">
        <flux:input icon="magnifying-glass" placeholder="Buscar..." wire:model.live="search" class="w-full max-w-sm" />
    </div>

    <div class="border-b border-zinc-200 dark:border-zinc-800">
        <nav class="flex gap-4">
            <button
                wire:click="setTab('notices')"
                class="px-4 py-2 text-sm font-medium border-b-2 {{ $activeTab === 'notices' ? 'border-blue-500 text-blue-600 dark:text-blue-400' : 'border-transparent text-zinc-500 hover:text-zinc-700 dark:hover:text-zinc-300' }}">
                Avisos
            </button>
            <button
                wire:click="setTab('inbox')"
                class="px-4 py-2 text-sm font-medium border-b-2 {{ $activeTab === 'inbox' ? 'border-blue-500 text-blue-600 dark:text-blue-400' : 'border-transparent text-zinc-500 hover:text-zinc-700 dark:hover:text-zinc-300' }}">
                Bandeja de Entrada
            </button>
            <button
                wire:click="setTab('sent')"
                class="px-4 py-2 text-sm font-medium border-b-2 {{ $activeTab === 'sent' ? 'border-blue-500 text-blue-600 dark:text-blue-400' : 'border-transparent text-zinc-500 hover:text-zinc-700 dark:hover:text-zinc-300' }}">
                Enviados
            </button>
        </nav>
    </div>

    @if($activeTab === 'notices')
        <div class="grid grid-cols-1 gap-6 md:grid-cols-2 lg:grid-cols-3">
            @forelse($notices as $notice)
                <div class="relative flex flex-col p-10 border rounded-xl bg-white dark:bg-zinc-900 border-zinc-200 dark:border-zinc-800">
                    <div class="flex items-start justify-between mb-2">
                        <h3 class="font-medium text-lg">{{ $notice->title }}</h3>
                        <span class="text-xs text-zinc-500">{{ $notice->created_at->format('M d, Y') }}</span>
                    </div>
                    <div class="absolute top-1 right-4">
                        <flux:dropdown>
                            <flux:button variant="ghost" size="sm" icon="ellipsis-horizontal" />
                            <flux:menu>
                                <flux:menu.item icon="pencil" wire:click="editNotice({{ $notice->id }})">Editar</flux:menu.item>
                                <flux:menu.item icon="trash" variant="danger" wire:click="deleteNotice({{ $notice->id }})" wire:confirm="¿Estás seguro?">Eliminar</flux:menu.item>
                            </flux:menu>
                        </flux:dropdown>
                    </div>
                    <p class="text-sm text-zinc-600 dark:text-zinc-400 mb-4 flex-1">
                        {{ $notice->content }}
                    </p>
                    <div class="flex items-center justify-between text-xs text-zinc-500 mt-auto">
                        <span>Publicado por: {{ $notice->author ? $notice->author->first_name . ' ' . $notice->author->last_name : 'Desconocido' }}</span>
                        @if($notice->expires_at)
                            <span class="text-red-500">Expira: {{ $notice->expires_at->format('M d') }}</span>
                        @endif
                    </div>
                </div>
            @empty
                <div class="col-span-full py-12 text-center text-zinc-500 border border-dashed rounded-xl border-zinc-200 dark:border-zinc-800">
                    <p>No se encontraron avisos.</p>
                </div>
            @endforelse
        </div>
    @endif

    @if($activeTab === 'inbox')
        <div class="overflow-hidden border rounded-xl border-zinc-200 dark:border-zinc-800">
            <table class="w-full text-sm text-left">
                <thead class="bg-zinc-50 dark:bg-zinc-900/50 text-zinc-500">
                    <tr>
                        <th class="px-4 py-3 font-medium">De</th>
                        <th class="px-4 py-3 font-medium">Mensaje</th>
                        <th class="px-4 py-3 font-medium">Fecha</th>
                        <th class="px-4 py-3 font-medium text-right">Acciones</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-zinc-200 dark:divide-zinc-800">
                    @forelse($inbox as $msg)
                        <tr class="hover:bg-zinc-50 dark:hover:bg-zinc-900/50">
                            <td class="px-4 py-3 font-medium">{{ $msg->sender ? $msg->sender->first_name . ' ' . $msg->sender->last_name : 'Desconocido' }}</td>
                            <td class="px-4 py-3 text-zinc-500 truncate max-w-xs">{{ $msg->message }}</td>
                            <td class="px-4 py-3 text-zinc-500">{{ $msg->created_at->format('M d, Y H:i') }}</td>
                            <td class="px-4 py-3 text-right">
                                <flux:dropdown>
                                    <flux:button variant="ghost" size="sm" icon="ellipsis-horizontal" />
                                    <flux:menu>
                                        <flux:menu.item icon="pencil" wire:click="editMessage({{ $msg->id }})">Editar</flux:menu.item>
                                        <flux:menu.item icon="trash" variant="danger" wire:click="deleteMessage({{ $msg->id }})" wire:confirm="¿Eliminar este mensaje?">Eliminar</flux:menu.item>
                                    </flux:menu>
                                </flux:dropdown>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="4" class="px-4 py-8 text-center text-zinc-500">No hay mensajes en la bandeja de entrada.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    @endif

    @if($activeTab === 'sent')
        <div class="overflow-hidden border rounded-xl border-zinc-200 dark:border-zinc-800">
            <table class="w-full text-sm text-left">
                <thead class="bg-zinc-50 dark:bg-zinc-900/50 text-zinc-500">
                    <tr>
                        <th class="px-4 py-3 font-medium">Para</th>
                        <th class="px-4 py-3 font-medium">Mensaje</th>
                        <th class="px-4 py-3 font-medium">Fecha</th>
                        <th class="px-4 py-3 font-medium text-right">Acciones</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-zinc-200 dark:divide-zinc-800">
                    @forelse($sent as $msg)
                        <tr class="hover:bg-zinc-50 dark:hover:bg-zinc-900/50">
                            <td class="px-4 py-3 font-medium">{{ $msg->recipient ? $msg->recipient->first_name . ' ' . $msg->recipient->last_name : 'Desconocido' }}</td>
                            <td class="px-4 py-3 text-zinc-500 truncate max-w-xs">{{ $msg->message }}</td>
                            <td class="px-4 py-3 text-zinc-500">{{ $msg->created_at->format('M d, Y H:i') }}</td>
                            <td class="px-4 py-3 text-right">
                                <flux:dropdown>
                                    <flux:button variant="ghost" size="sm" icon="ellipsis-horizontal" />
                                    <flux:menu>
                                        <flux:menu.item icon="pencil" wire:click="editMessage({{ $msg->id }})">Editar</flux:menu.item>
                                        <flux:menu.item icon="trash" variant="danger" wire:click="deleteMessage({{ $msg->id }})" wire:confirm="¿Eliminar este mensaje?">Eliminar</flux:menu.item>
                                    </flux:menu>
                                </flux:dropdown>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="3" class="px-4 py-8 text-center text-zinc-500">No hay mensajes enviados.</td>
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
                    @if($modalType === 'notice') Publicar Aviso
                    @elseif($modalType === 'notice_edit') Editar Aviso
                    @elseif($modalType === 'message') Enviar Mensaje
                    @elseif($modalType === 'message_edit') Editar Mensaje
                    @endif
                </h2>
            </div>

            @if($modalType === 'notice' || $modalType === 'notice_edit')
                <div class="space-y-4">
                    <flux:input label="Título" wire:model="notice_title" />
                    <flux:textarea label="Contenido" wire:model="notice_content" />
                    <div>
                        <label class="block text-sm font-medium text-zinc-700 dark:text-zinc-300 mb-1">Prioridad</label>
                        <select wire:model="notice_priority" class="w-full px-3 py-2 border border-zinc-300 dark:border-zinc-700 rounded-lg bg-white dark:bg-zinc-900 text-zinc-900 dark:text-zinc-100 focus:ring-2 focus:ring-blue-500 focus:border-blue-500">
                            <option value="normal">Normal</option>
                            <option value="high">Alta</option>
                            <option value="urgent">Urgente</option>
                        </select>
                    </div>
                    <flux:input type="date" label="Expira En" wire:model="notice_expires_at" />
                </div>
                <div class="flex justify-end gap-2">
                    <flux:button variant="ghost" wire:click="$set('showModal', false)">Cancelar</flux:button>
                    <flux:button variant="primary" wire:click="{{ $modalType === 'notice' ? 'storeNotice' : 'updateNotice' }}">{{ $modalType === 'notice' ? 'Publicar' : 'Guardar' }}</flux:button>
                </div>
            @elseif($modalType === 'message' || $modalType === 'message_edit')
                <div class="space-y-4">
                    <div>
                        <label class="block text-sm font-medium text-zinc-700 dark:text-zinc-300 mb-1">Para</label>
                        <select wire:model="message_recipient_id" class="w-full px-3 py-2 border border-zinc-300 dark:border-zinc-700 rounded-lg bg-white dark:bg-zinc-900 text-zinc-900 dark:text-zinc-100 focus:ring-2 focus:ring-blue-500 focus:border-blue-500">
                            <option value="">Seleccionar Personal</option>
                            @foreach($personnel as $p)
                                <option value="{{ $p->id }}">{{ $p->first_name }} {{ $p->last_name }}</option>
                            @endforeach
                        </select>
                    </div>
                    <flux:textarea label="Mensaje" wire:model="message_content" />
                </div>
                <div class="flex justify-end gap-2">
                    <flux:button variant="ghost" wire:click="$set('showModal', false)">Cancelar</flux:button>
                    <flux:button variant="primary" wire:click="{{ $modalType === 'message' ? 'storeMessage' : 'updateMessage' }}">{{ $modalType === 'message' ? 'Enviar' : 'Guardar' }}</flux:button>
                </div>
            @endif
        </div>
    </flux:modal>
</div>
