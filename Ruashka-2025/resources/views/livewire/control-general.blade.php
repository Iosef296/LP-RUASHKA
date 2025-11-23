<div class="p-6 space-y-8 bg-gray-50 dark:bg-zinc-900 min-h-screen">
    <div class="flex justify-between items-center">
        <h1 class="text-3xl font-bold text-gray-900 dark:text-white">Control General - Multisede</h1>
        <div class="text-sm text-gray-500 dark:text-gray-400">
            Supervisión y Análisis Estratégico
        </div>
    </div>

    <!-- 1. Gestión de Sedes -->
    <section class="space-y-4">
        <div class="flex justify-between items-center">
            <h2 class="text-xl font-semibold text-gray-800 dark:text-gray-200 flex items-center gap-2">
                <span>🗺️</span> Gestión de Sedes
            </h2>
        </div>
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
            @forelse($sedes as $sede)
                <div class="bg-white dark:bg-zinc-800 p-6 rounded-lg shadow-sm border border-gray-200 dark:border-zinc-700 relative group">
                    <div class="absolute top-2 right-2 opacity-0 group-hover:opacity-100 transition-opacity flex gap-2">
                        <flux:button wire:click="edit('sede', {{ $sede->id }})" icon="pencil-square" variant="ghost" size="sm" />
                        <flux:button wire:confirm="¿Seguro que desea eliminar?" wire:click="delete('sede', {{ $sede->id }})" icon="trash" variant="ghost" color="danger" size="sm" />
                    </div>
                    <div class="flex justify-between items-start">
                        <div>
                            <h3 class="text-lg font-medium text-gray-900 dark:text-white">Sede #{{ $sede->id }}</h3>
                            <p class="text-gray-500 dark:text-gray-400 mt-1">{{ $sede->ubicacion }}</p>
                        </div>
                        <div class="p-2 bg-blue-50 dark:bg-blue-900/30 rounded-full">
                            <flux:icon name="building-office" class="w-6 h-6 text-blue-600 dark:text-blue-400" />
                        </div>
                    </div>
                    @if($sede->organigrama)
                        <div class="mt-4 pt-4 border-t border-gray-100 dark:border-zinc-700">
                            <a href="{{ $sede->organigrama }}" target="_blank" class="text-sm text-blue-600 dark:text-blue-400 hover:underline flex items-center gap-1">
                                <flux:icon name="link" class="w-4 h-4" />
                                Ver Organigrama
                            </a>
                        </div>
                    @endif
                </div>
            @empty
                <div class="col-span-full text-center py-8 text-gray-500 dark:text-gray-400 bg-white dark:bg-zinc-800 rounded-lg border border-dashed border-gray-300 dark:border-zinc-700">
                    No hay sedes registradas.
                </div>
            @endforelse
        </div>
    </section>

    <!-- 2. KPIs -->
    <section class="space-y-4">
        <div class="flex justify-between items-center">
            <h2 class="text-xl font-semibold text-gray-800 dark:text-gray-200 flex items-center gap-2">
                <span>📈</span> Indicadores Clave de Desempeño (KPIs)
            </h2>
            <flux:button wire:click="create('indicador')" icon="plus" variant="primary" size="sm">Nuevo KPI</flux:button>
        </div>
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-4">
            @forelse($indicadores as $ind)
                <div class="bg-white dark:bg-zinc-800 p-5 rounded-lg shadow-sm border border-gray-200 dark:border-zinc-700 relative group">
                    <div class="absolute top-2 right-2 opacity-0 group-hover:opacity-100 transition-opacity flex gap-2 bg-white dark:bg-zinc-800 p-1 rounded shadow">
                        <flux:button wire:click="edit('indicador', {{ $ind->id }})" icon="pencil-square" variant="ghost" size="sm" />
                        <flux:button wire:confirm="¿Seguro que desea eliminar?" wire:click="delete('indicador', {{ $ind->id }})" icon="trash" variant="ghost" color="danger" size="sm" />
                    </div>
                    <div class="flex justify-between items-start mb-2">
                        <span class="text-xs font-medium px-2 py-1 rounded-full bg-gray-100 dark:bg-zinc-700 text-gray-600 dark:text-gray-300">{{ $ind->tipo }}</span>
                        <span class="text-xs text-gray-400">{{ $ind->fecha_actual }}</span>
                    </div>
                    <h3 class="text-sm font-medium text-gray-500 dark:text-gray-400">{{ $ind->descripcion }}</h3>
                    <div class="mt-2 flex items-baseline gap-2">
                        <span class="text-2xl font-bold text-gray-900 dark:text-white">{{ $ind->valor_actual }}</span>
                        <span class="text-sm text-gray-500">/ {{ $ind->metas }}</span>
                    </div>
                    <div class="mt-4">
                        <div class="flex justify-between text-xs mb-1">
                            <span>Cumplimiento</span>
                            <span class="{{ $ind->porcentaje_cumplimiento >= 100 ? 'text-green-600' : ($ind->porcentaje_cumplimiento >= 80 ? 'text-yellow-600' : 'text-red-600') }}">
                                {{ $ind->porcentaje_cumplimiento }}%
                            </span>
                        </div>
                        <div class="w-full bg-gray-200 dark:bg-zinc-700 rounded-full h-2">
                            <div class="bg-blue-600 h-2 rounded-full" style="width: {{ min($ind->porcentaje_cumplimiento, 100) }}%"></div>
                        </div>
                    </div>
                </div>
            @empty
                <div class="col-span-full text-center py-4 text-gray-500 dark:text-gray-400">
                    No hay indicadores registrados.
                </div>
            @endforelse
        </div>
    </section>

    <!-- 3. Planificación y Estrategia -->
    <section class="grid grid-cols-1 lg:grid-cols-2 gap-8">
        <!-- Planes Estratégicos -->
        <div class="space-y-4">
            <div class="flex justify-between items-center">
                <h2 class="text-xl font-semibold text-gray-800 dark:text-gray-200 flex items-center gap-2">
                    <span>🎯</span> Planes Estratégicos
                </h2>
                <flux:button wire:click="create('plan')" icon="plus" variant="primary" size="sm">Nuevo Plan</flux:button>
            </div>
            <div class="bg-white dark:bg-zinc-800 rounded-lg shadow-sm border border-gray-200 dark:border-zinc-700 overflow-hidden">
                <table class="min-w-full divide-y divide-gray-200 dark:divide-zinc-700">
                    <thead class="bg-gray-50 dark:bg-zinc-900/50">
                        <tr>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-400 uppercase tracking-wider">Plan</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-400 uppercase tracking-wider">Estado</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-400 uppercase tracking-wider">Fechas</th>
                            <th class="px-6 py-3 text-right text-xs font-medium text-gray-500 dark:text-gray-400 uppercase tracking-wider">Acciones</th>
                        </tr>
                    </thead>
                    <tbody class="bg-white dark:bg-zinc-800 divide-y divide-gray-200 dark:divide-zinc-700">
                        @forelse($planes as $plan)
                            <tr class="group">
                                <td class="px-6 py-4">
                                    <div class="text-sm font-medium text-gray-900 dark:text-white">{{ $plan->nombre }}</div>
                                    <div class="text-xs text-gray-500 dark:text-gray-400 mt-1">{{ Str::limit($plan->objetivos, 50) }}</div>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full 
                                        {{ $plan->estado === 'Completado' ? 'bg-green-100 text-green-800 dark:bg-green-900/30 dark:text-green-400' : 
                                           ($plan->estado === 'En Progreso' ? 'bg-blue-100 text-blue-800 dark:bg-blue-900/30 dark:text-blue-400' : 
                                           'bg-gray-100 text-gray-800 dark:bg-gray-700 dark:text-gray-300') }}">
                                        {{ $plan->estado }}
                                    </span>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap text-xs text-gray-500 dark:text-gray-400">
                                    {{ $plan->fecha_inicio }} - {{ $plan->fecha_final }}
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap text-right text-sm font-medium">
                                    <flux:button wire:click="edit('plan', {{ $plan->id }})" icon="pencil-square" variant="ghost" size="sm" />
                                    <flux:button wire:confirm="¿Eliminar?" wire:click="delete('plan', {{ $plan->id }})" icon="trash" variant="ghost" color="danger" size="sm" />
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="4" class="px-6 py-4 text-center text-sm text-gray-500 dark:text-gray-400">No hay planes registrados.</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>

        <!-- Justificaciones -->
        <div class="space-y-4">
            <div class="flex justify-between items-center">
                <h2 class="text-xl font-semibold text-gray-800 dark:text-gray-200 flex items-center gap-2">
                    <span>📝</span> Justificaciones
                </h2>
                <flux:button wire:click="create('justificacion')" icon="plus" variant="primary" size="sm">Nueva</flux:button>
            </div>
            <div class="bg-white dark:bg-zinc-800 rounded-lg shadow-sm border border-gray-200 dark:border-zinc-700 p-4 max-h-[400px] overflow-y-auto space-y-4">
                @forelse($justificaciones as $just)
                    <div class="border-l-4 border-yellow-400 pl-4 py-2 relative group">
                        <div class="absolute top-0 right-0 opacity-0 group-hover:opacity-100 transition-opacity flex gap-2">
                            <flux:button wire:click="edit('justificacion', {{ $just->id }})" icon="pencil-square" variant="ghost" size="sm" />
                            <flux:button wire:confirm="¿Eliminar?" wire:click="delete('justificacion', {{ $just->id }})" icon="trash" variant="ghost" color="danger" size="sm" />
                        </div>
                        <h4 class="text-sm font-bold text-gray-900 dark:text-white">{{ $just->asunto }}</h4>
                        <p class="text-sm text-gray-600 dark:text-gray-300 mt-1">{{ $just->descripcion }}</p>
                        @if($just->plan_estrategico_id)
                            <div class="mt-2 text-xs text-gray-400">Ref: Plan #{{ $just->plan_estrategico_id }}</div>
                        @endif
                    </div>
                @empty
                    <div class="text-center text-sm text-gray-500 dark:text-gray-400 py-4">No hay justificaciones.</div>
                @endforelse
            </div>
        </div>
    </section>

    <!-- 4. Auditorías y Control -->
    <section class="space-y-4">
        <h2 class="text-xl font-semibold text-gray-800 dark:text-gray-200 flex items-center gap-2">
            <span>💼</span> Gestión de Auditorías y Control
        </h2>
        <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">
            <!-- Tabla de Auditorías -->
            <div class="bg-white dark:bg-zinc-800 rounded-lg shadow-sm border border-gray-200 dark:border-zinc-700 overflow-hidden">
                <div class="px-4 py-3 border-b border-gray-200 dark:border-zinc-700 bg-gray-50 dark:bg-zinc-900/50 flex justify-between items-center">
                    <h3 class="text-sm font-medium text-gray-700 dark:text-gray-300">Auditorías Recientes</h3>
                    <flux:button wire:click="create('auditoria')" icon="plus" variant="primary" size="xs">Nueva</flux:button>
                </div>
                <ul class="divide-y divide-gray-200 dark:divide-zinc-700">
                    @forelse($auditorias as $aud)
                        <li class="px-4 py-3 hover:bg-gray-50 dark:hover:bg-zinc-700/50 transition group relative">
                            <div class="absolute top-2 right-2 opacity-0 group-hover:opacity-100 transition-opacity flex gap-2">
                                <flux:button wire:click="edit('auditoria', {{ $aud->id }})" icon="pencil-square" variant="ghost" size="sm" />
                                <flux:button wire:confirm="¿Eliminar?" wire:click="delete('auditoria', {{ $aud->id }})" icon="trash" variant="ghost" color="danger" size="sm" />
                            </div>
                            <div class="flex justify-between">
                                <span class="text-sm font-medium text-gray-900 dark:text-white">{{ $aud->area }}</span>
                                <span class="text-xs text-gray-500">{{ $aud->fecha }}</span>
                            </div>
                            <div class="mt-1 flex justify-between items-center">
                                <p class="text-sm text-gray-600 dark:text-gray-300">{{ $aud->resultado }}</p>
                                @if($aud->sede_id)
                                    <span class="text-xs bg-gray-100 dark:bg-zinc-700 px-2 py-0.5 rounded text-gray-500">Sede {{ $aud->sede_id }}</span>
                                @endif
                            </div>
                            @if($aud->observaciones)
                                <p class="mt-1 text-xs text-gray-400 italic">{{ $aud->observaciones }}</p>
                            @endif
                        </li>
                    @empty
                        <li class="px-4 py-3 text-sm text-gray-500 text-center">No hay auditorías registradas.</li>
                    @endforelse
                </ul>
            </div>

            <!-- Reportes de Control de Calidad -->
            <div class="bg-white dark:bg-zinc-800 rounded-lg shadow-sm border border-gray-200 dark:border-zinc-700 overflow-hidden">
                <div class="px-4 py-3 border-b border-gray-200 dark:border-zinc-700 bg-gray-50 dark:bg-zinc-900/50 flex justify-between items-center">
                    <h3 class="text-sm font-medium text-gray-700 dark:text-gray-300">Control de Calidad</h3>
                    <flux:button wire:click="create('control')" icon="plus" variant="primary" size="xs">Nuevo</flux:button>
                </div>
                <ul class="divide-y divide-gray-200 dark:divide-zinc-700">
                    @forelse($controles as $control)
                        <li class="px-4 py-3 flex items-center justify-between hover:bg-gray-50 dark:hover:bg-zinc-700/50 transition group relative">
                            <div class="absolute right-2 opacity-0 group-hover:opacity-100 transition-opacity flex gap-2 bg-white dark:bg-zinc-800 p-1">
                                <flux:button wire:click="edit('control', {{ $control->id }})" icon="pencil-square" variant="ghost" size="sm" />
                                <flux:button wire:confirm="¿Eliminar?" wire:click="delete('control', {{ $control->id }})" icon="trash" variant="ghost" color="danger" size="sm" />
                            </div>
                            <div class="flex items-center gap-3">
                                <div class="w-2 h-2 rounded-full {{ Str::contains(strtolower($control->resultado), 'aprobado') ? 'bg-green-500' : 'bg-red-500' }}"></div>
                                <div>
                                    <p class="text-sm font-medium text-gray-900 dark:text-white">{{ $control->resultado }}</p>
                                    <p class="text-xs text-gray-500">{{ $control->fecha_control }}</p>
                                </div>
                            </div>
                            @if($control->sede_id)
                                <span class="text-xs text-gray-400">Sede {{ $control->sede_id }}</span>
                            @endif
                        </li>
                    @empty
                        <li class="px-4 py-3 text-sm text-gray-500 text-center">No hay reportes de calidad.</li>
                    @endforelse
                </ul>
            </div>
        </div>
    </section>

    <!-- 5. Visión Consolidada de Gastos -->
    <section class="space-y-4">
        <div class="flex justify-between items-center">
            <h2 class="text-xl font-semibold text-gray-800 dark:text-gray-200 flex items-center gap-2">
                <span>💰</span> Visión Consolidada de Gastos
            </h2>
            <flux:button wire:click="create('gasto')" icon="plus" variant="primary" size="sm">Nuevo Gasto</flux:button>
        </div>
        <div class="bg-white dark:bg-zinc-800 rounded-lg shadow-sm border border-gray-200 dark:border-zinc-700 overflow-hidden">
            <table class="min-w-full divide-y divide-gray-200 dark:divide-zinc-700">
                <thead class="bg-gray-50 dark:bg-zinc-900/50">
                    <tr>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-400 uppercase tracking-wider">Categoría</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-400 uppercase tracking-wider">Sede</th>
                        <th class="px-6 py-3 text-right text-xs font-medium text-gray-500 dark:text-gray-400 uppercase tracking-wider">Desembolso</th>
                        <th class="px-6 py-3 text-right text-xs font-medium text-gray-500 dark:text-gray-400 uppercase tracking-wider">Acciones</th>
                    </tr>
                </thead>
                <tbody class="bg-white dark:bg-zinc-800 divide-y divide-gray-200 dark:divide-zinc-700">
                    @forelse($gastos as $gasto)
                        <tr class="group">
                            <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900 dark:text-white">
                                {{ $gasto->categoria }}
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500 dark:text-gray-400">
                                {{ $gasto->sede_id ? 'Sede #' . $gasto->sede_id : 'General' }}
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-right font-mono text-gray-900 dark:text-white">
                                ${{ number_format($gasto->desembolso, 2) }}
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-right text-sm font-medium">
                                <flux:button wire:click="edit('gasto', {{ $gasto->id }})" icon="pencil-square" variant="ghost" size="sm" />
                                <flux:button wire:confirm="¿Eliminar?" wire:click="delete('gasto', {{ $gasto->id }})" icon="trash" variant="ghost" color="danger" size="sm" />
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="4" class="px-6 py-4 text-center text-sm text-gray-500 dark:text-gray-400">No hay gastos registrados.</td>
                        </tr>
                    @endforelse
                </tbody>
                @if($gastos->count() > 0)
                    <tfoot class="bg-gray-50 dark:bg-zinc-900/50">
                        <tr>
                            <td colspan="2" class="px-6 py-3 text-right text-sm font-bold text-gray-900 dark:text-white">Total</td>
                            <td class="px-6 py-3 text-right text-sm font-bold font-mono text-gray-900 dark:text-white">
                                ${{ number_format($gastos->sum('desembolso'), 2) }}
                            </td>
                            <td></td>
                        </tr>
                    </tfoot>
                @endif
            </table>
        </div>
    </section>

    <!-- Flux Modal -->
    <flux:modal name="edit-modal" class="md:w-96">
        <div class="space-y-6">
            <div>
                <h3 class="text-lg font-medium text-gray-900 dark:text-white">
                    {{ $editingId ? 'Editar' : 'Crear' }} {{ ucfirst($editingType) }}
                </h3>
            </div>

            <form wire:submit.prevent="save" class="space-y-4">
                @if($editingType === 'sede')
                    <flux:input label="Ubicación" wire:model="form.ubicacion" />
                    <flux:input label="URL Organigrama" wire:model="form.organigrama" />
                @elseif($editingType === 'indicador')
                    <flux:input label="Tipo" wire:model="form.tipo" />
                    <flux:input label="Descripción" wire:model="form.descripcion" />
                    <flux:input label="Metas" wire:model="form.metas" />
                    <flux:input label="Valor Actual" wire:model="form.valor_actual" />
                    <flux:input label="% Cumplimiento" type="number" step="0.01" wire:model="form.porcentaje_cumplimiento" />
                    <flux:input label="Fecha" type="date" wire:model="form.fecha_actual" />
                @elseif($editingType === 'plan')
                    <flux:input label="Nombre" wire:model="form.nombre" />
                    <flux:textarea label="Objetivos" wire:model="form.objetivos" />
                    <div class="grid grid-cols-2 gap-4">
                        <flux:input label="Inicio" type="date" wire:model="form.fecha_inicio" />
                        <flux:input label="Fin" type="date" wire:model="form.fecha_final" />
                    </div>
                    <flux:select label="Estado" wire:model="form.estado">
                        <option value="">Seleccionar</option>
                        <option value="En Progreso">En Progreso</option>
                        <option value="Completado">Completado</option>
                        <option value="Pendiente">Pendiente</option>
                    </flux:select>
                @elseif($editingType === 'justificacion')
                    <flux:input label="Asunto" wire:model="form.asunto" />
                    <flux:textarea label="Descripción" wire:model="form.descripcion" />
                @elseif($editingType === 'auditoria')
                    <flux:input label="Área" wire:model="form.area" />
                    <flux:input label="Fecha" type="date" wire:model="form.fecha" />
                    <flux:input label="Resultado" wire:model="form.resultado" />
                    <flux:textarea label="Observaciones" wire:model="form.observaciones" />
                @elseif($editingType === 'control')
                    <flux:input label="Fecha" type="date" wire:model="form.fecha_control" />
                    <flux:select label="Resultado" wire:model="form.resultado">
                        <option value="">Seleccionar</option>
                        <option value="Aprobado">Aprobado</option>
                        <option value="Rechazado">Rechazado</option>
                    </flux:select>
                @elseif($editingType === 'gasto')
                    <flux:input label="Categoría" wire:model="form.categoria" />
                    <flux:input label="Desembolso" type="number" step="0.01" wire:model="form.desembolso" />
                @endif

                <div class="flex justify-end gap-2">
                    <flux:button wire:click="cancel" variant="ghost">Cancelar</flux:button>
                    <flux:button type="submit" variant="primary">Guardar</flux:button>
                </div>
            </form>
        </div>
    </flux:modal>
</div>
