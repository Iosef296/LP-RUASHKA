<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    @include('partials.head')
</head>

<body class="min-h-screen bg-indigo-50 dark:bg-[#0B1221]">

    <!-- SIDEBAR -->
    <flux:sidebar sticky stashable
        class="border-e border-indigo-200 bg-indigo-50
               dark:border-[#1b253d] dark:bg-[#0B1221]">

        <flux:sidebar.toggle class="lg:hidden" icon="x-mark" />

        <a href="{{ route('dashboard') }}"
           class="me-5 flex items-center space-x-2 rtl:space-x-reverse"
           wire:navigate>
            <x-app-logo />
        </a>

        <!-- NAVLIST PRINCIPAL -->
        <flux:navlist variant="outline">

            <!-- SUBMENÚ: CONFIGURACIÓN -->
            <div x-data="{ openConfig: false }">
                <button
                    @click="openConfig = !openConfig"
                    class="w-full flex items-center justify-between px-3 py-2 text-sm font-medium
                        text-gray-700 dark:text-gray-300 hover:bg-indigo-100 dark:hover:bg-[#192133]
                        rounded-md transition">

                    <span>Configuración</span>

                    <svg x-bind:class="openConfig ? 'rotate-90' : ''"
                        class="w-4 h-4 transition-transform"
                        fill="none" stroke="currentColor" stroke-width="2"
                        viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round"
                            d="M9 5l7 7-7 7" />
                    </svg>
                </button>

                <div x-show="openConfig" x-transition class="ml-4 mt-2 space-y-1" x-cloak>

                    <flux:navlist.item
                        icon="users"
                        class="hover:bg-indigo-100 dark:hover:bg-[#192133]"
                        href="{{ route('worker.index') }}"
                        wire:navigate>
                        Trabajadores
                    </flux:navlist.item>

                    <flux:navlist.item
                        icon="building-office"
                        class="hover:bg-indigo-100 dark:hover:bg-[#192133]"
                        href="{{ route('sede.index') }}"
                        wire:navigate>
                        Sedes
                    </flux:navlist.item>

                    <flux:navlist.item
                        icon="shield-check"
                        class="hover:bg-indigo-100 dark:hover:bg-[#192133]"
                        href="{{ route('role.index') }}"
                        wire:navigate>
                        Roles
                    </flux:navlist.item>

                </div>
            </div>

            <!-- SUBMENÚ: TIENDA -->
            <div x-data="{ openStore: false }" x-cloak>

                <button
                    @click.stop="openStore = !openStore"
                    class="w-full flex items-center justify-between px-3 py-2 text-sm font-medium
                        text-gray-700 dark:text-gray-300 hover:bg-indigo-100 dark:hover:bg-[#192133]
                        rounded-md transition">

                    <span>Administración de Tienda</span>

                    <svg :class="openStore ? 'rotate-90' : ''"
                        class="w-4 h-4 transition-transform duration-200"
                        fill="none" stroke="currentColor" stroke-width="2"
                        viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round"
                            d="M9 5l7 7-7 7" />
                    </svg>
                </button>

                <div x-show="openStore" x-collapse class="ml-4 mt-2 space-y-1">

                    <flux:navlist.item icon="building-storefront"
                        href="{{ route('store.dashboard') }}"
                        :current="request()->routeIs('store.dashboard')"
                        class="hover:bg-indigo-100 dark:hover:bg-[#192133]"
                        wire:navigate>
                        Panel de Tienda
                    </flux:navlist.item>

                    <flux:navlist.item icon="chart-bar"
                        href="{{ route('store.summary') }}"
                        :current="request()->routeIs('store.summary')"
                        class="hover:bg-indigo-100 dark:hover:bg-[#192133]"
                        wire:navigate>
                        Resumen
                    </flux:navlist.item>

                    <flux:navlist.item icon="users"
                        href="{{ route('store.personnel') }}"
                        :current="request()->routeIs('store.personnel')"
                        class="hover:bg-indigo-100 dark:hover:bg-[#192133]"
                        wire:navigate>
                        Personal
                    </flux:navlist.item>

                    <flux:navlist.item icon="clock"
                        href="{{ route('store.attendance') }}"
                        :current="request()->routeIs('store.attendance')"
                        class="hover:bg-indigo-100 dark:hover:bg-[#192133]"
                        wire:navigate>
                        Asistencia
                    </flux:navlist.item>

                    <flux:navlist.item icon="wrench"
                        href="{{ route('store.maintenance') }}"
                        :current="request()->routeIs('store.maintenance')"
                        class="hover:bg-indigo-100 dark:hover:bg-[#192133]"
                        wire:navigate>
                        Mantenimiento
                    </flux:navlist.item>

                    <flux:navlist.item icon="document-text"
                        href="{{ route('store.documents') }}"
                        :current="request()->routeIs('store.documents')"
                        class="hover:bg-indigo-100 dark:hover:bg-[#192133]"
                        wire:navigate>
                        Documentos
                    </flux:navlist.item>

                    <flux:navlist.item icon="exclamation-triangle"
                        href="{{ route('store.incidents') }}"
                        :current="request()->routeIs('store.incidents')"
                        class="hover:bg-indigo-100 dark:hover:bg-[#192133]"
                        wire:navigate>
                        Incidentes
                    </flux:navlist.item>

                    <flux:navlist.item icon="inbox-arrow-down"
                        href="{{ route('store.requests') }}"
                        :current="request()->routeIs('store.requests')"
                        class="hover:bg-indigo-100 dark:hover:bg-[#192133]"
                        wire:navigate>
                        Solicitudes
                    </flux:navlist.item>

                    <flux:navlist.item icon="shield-check"
                        href="{{ route('store.access-logs') }}"
                        :current="request()->routeIs('store.access-logs')"
                        class="hover:bg-indigo-100 dark:hover:bg-[#192133]"
                        wire:navigate>
                        Registros de Acceso
                    </flux:navlist.item>

                    <flux:navlist.item icon="chat-bubble-left-right"
                        href="{{ route('store.communications') }}"
                        :current="request()->routeIs('store.communications')"
                        class="hover:bg-indigo-100 dark:hover:bg-[#192133]"
                        wire:navigate>
                        Comunicaciones
                    </flux:navlist.item>

                    <flux:navlist.item icon="cog-6-tooth"
                        href="{{ route('store.settings') }}"
                        :current="request()->routeIs('store.settings')"
                        class="hover:bg-indigo-100 dark:hover:bg-[#192133]"
                        wire:navigate>
                        Configuración de Tienda
                    </flux:navlist.item>

                </div>
            </div>

            <!-- SUBMENÚ: VENTAS -->
            <div x-data="{ openSales: false }">

                <button
                    @click="openSales = !openSales"
                    class="w-full flex items-center justify-between px-3 py-2 text-sm font-medium
                        text-gray-700 dark:text-gray-300 hover:bg-indigo-100 dark:hover:bg-[#192133]
                        rounded-md transition">

                    <span>Ventas</span>

                    <svg :class="openSales ? 'rotate-90' : ''"
                        class="w-4 h-4 transition-transform"
                        fill="none" stroke="currentColor" stroke-width="2"
                        viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round"
                            d="M9 5l7 7-7 7" />
                    </svg>
                </button>

                <div x-show="openSales" x-collapse class="ml-4 mt-2 space-y-1">

                    <flux:navlist.item
                        icon="shopping-bag"
                        :href="route('sales.dashboard')"
                        :current="request()->routeIs('sales.dashboard')"
                        class="hover:bg-indigo-100 dark:hover:bg-[#192133]"
                        wire:navigate>
                        Dashboard Ventas
                    </flux:navlist.item>

                    <flux:navlist.item
                        icon="users"
                        :href="route('sales.customers')"
                        :current="request()->routeIs('sales.customers')"
                        class="hover:bg-indigo-100 dark:hover:bg-[#192133]"
                        wire:navigate>
                        Clientes
                    </flux:navlist.item>

                </div>
            </div>

            <!-- SUBMENÚ: INVENTARIO -->
            <div x-data="{ openInventory: false }">

                <button
                    @click="openInventory = !openInventory"
                    class="w-full flex items-center justify-between px-3 py-2 text-sm font-medium
                        text-gray-700 dark:text-gray-300 hover:bg-indigo-100 dark:hover:bg-[#192133]
                        rounded-md transition">

                    <span>Inventario</span>

                    <svg :class="openInventory ? 'rotate-90' : ''"
                        class="w-4 h-4 transition-transform"
                        fill="none" stroke="currentColor" stroke-width="2"
                        viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round"
                            d="M9 5l7 7-7 7" />
                    </svg>
                </button>

                <div x-show="openInventory" x-collapse class="ml-4 mt-2 space-y-1">

                    <flux:navlist.item
                        icon="home"
                        :href="route('inveradd')"
                        :current="request()->routeIs('inveradd')"
                        class="hover:bg-indigo-100 dark:hover:bg-[#192133]"
                        wire:navigate>
                        Inventario
                    </flux:navlist.item>

                    <flux:navlist.item
                        icon="inbox-stack"
                        :href="route('inventorylist')"
                        :current="request()->routeIs('inventorylist')"
                        class="hover:bg-indigo-100 dark:hover:bg-[#192133]"
                        wire:navigate>
                        Lista
                    </flux:navlist.item>

                </div>
            </div>

        </flux:navlist>

        <flux:spacer />

        <!-- DARK MODE SWITCH -->
        <button
            onclick="toggleDarkMode()"
            id="darkModeToggle"
            class="p-2 rounded-lg transition-colors hover:bg-indigo-200 dark:hover:bg-[#192133]">
            <span id="lightIcon" class="text-xl hidden">☀️</span>
            <span id="darkIcon" class="text-xl">🌙</span>
        </button>

        <script>
            function toggleDarkMode() {
                const html = document.documentElement;
                const mode = localStorage.getItem('darkMode');

                if (mode === 'dark') {
                    html.classList.remove('dark');
                    localStorage.setItem('darkMode', 'light');
                    updateIcons('light');
                } else {
                    html.classList.add('dark');
                    localStorage.setItem('darkMode', 'dark');
                    updateIcons('dark');
                }
            }

            function updateIcons(mode) {
                document.getElementById('lightIcon')
                    .classList.toggle('hidden', mode !== 'dark');
                document.getElementById('darkIcon')
                    .classList.toggle('hidden', mode === 'dark');
            }

            document.addEventListener('DOMContentLoaded', () => {
                const saved = localStorage.getItem('darkMode') || 'light';
                if (saved === 'dark') document.documentElement.classList.add('dark');
                updateIcons(saved);
            });
        </script>

        <!-- USER MENU DESKTOP -->
        <flux:dropdown class="hidden lg:block" position="bottom" align="start">
            <flux:profile
                :name="auth()->user()->name"
                :initials="auth()->user()->initials()"
                icon:trailing="chevrons-up-down"
            />

            <flux:menu class="w-[220px]">

                <flux:menu.radio.group>
                    <div class="p-0 text-sm font-normal">
                        <div class="flex items-center gap-2 px-1 py-1.5">
                            <span class="relative flex h-8 w-8 rounded-lg overflow-hidden">
                                <span class="flex h-full w-full items-center justify-center rounded-lg
                                             bg-indigo-200 text-black
                                             dark:bg-[#192133] dark:text-white">
                                    {{ auth()->user()->initials() }}
                                </span>
                            </span>

                            <div class="grid flex-1 text-start text-sm">
                                <span class="truncate font-semibold">{{ auth()->user()->name }}</span>
                                <span class="truncate text-xs">{{ auth()->user()->email }}</span>
                            </div>
                        </div>
                    </div>
                </flux:menu.radio.group>

                <flux:menu.separator />

                <flux:menu.radio.group>
                    <flux:menu.item :href="route('profile.edit')" icon="cog" wire:navigate>
                        {{ __('Settings') }}
                    </flux:menu.item>
                </flux:menu.radio.group>

                <flux:menu.separator />

                <form method="POST" action="{{ route('logout') }}" class="w-full">
                    @csrf
                    <flux:menu.item as="button" type="submit"
                        icon="arrow-right-start-on-rectangle"
                        class="w-full">
                        {{ __('Log Out') }}
                    </flux:menu.item>
                </form>

            </flux:menu>
        </flux:dropdown>

    </flux:sidebar>

    <!-- MOBILE HEADER -->
    <flux:header class="lg:hidden border-b border-indigo-200
        dark:border-[#1b253d] bg-indigo-50 dark:bg-[#0B1221]">

        <flux:sidebar.toggle class="lg:hidden" icon="bars-2" inset="left" />
        <flux:spacer />

        <flux:dropdown position="top" align="end">

            <flux:profile :initials="auth()->user()->initials()" icon-trailing="chevron-down" />

            <flux:menu>

                <flux:menu.radio.group>
                    <div class="p-0 text-sm font-normal">
                        <div class="flex items-center gap-2 px-1 py-1.5">

                            <span class="relative flex h-8 w-8 overflow-hidden rounded-lg">
                                <span class="flex h-full w-full items-center justify-center rounded-lg
                                             bg-indigo-200 text-black
                                             dark:bg-[#192133] dark:text-white">
                                    {{ auth()->user()->initials() }}
                                </span>
                            </span>

                            <div class="grid flex-1 text-start text-sm">
                                <span class="truncate font-semibold">{{ auth()->user()->name }}</span>
                                <span class="truncate text-xs">{{ auth()->user()->email }}</span>
                            </div>

                        </div>
                    </div>
                </flux:menu.radio.group>

                <flux:menu.separator />

                <flux:menu.radio.group>
                    <flux:menu.item :href="route('profile.edit')" icon="cog" wire:navigate>
                        {{ __('Settings') }}
                    </flux:menu.item>
                </flux:menu.radio.group>

                <flux:menu.separator />

                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <flux:menu.item as="button" type="submit"
                        icon="arrow-right-start-on-rectangle">
                        {{ __('Log Out') }}
                    </flux:menu.item>
                </form>

            </flux:menu>
        </flux:dropdown>

    </flux:header>

    <!-- CONTENIDO -->
    {{ $slot }}

    @fluxScripts
</body>
</html>
