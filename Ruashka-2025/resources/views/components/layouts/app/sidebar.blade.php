<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="dark">
<head>
    @include('partials.head')
</head>

<body class="min-h-screen bg-indigo-50 dark:bg-[#0B1221]">

    <flux:sidebar sticky stashable
        class="border-e border-indigo-200 bg-indigo-50 dark:border-[#1b253d] dark:bg-[#0B1221]">

        <flux:sidebar.toggle class="lg:hidden" icon="x-mark" />

        <a href="{{ route('dashboard') }}"
           class="me-5 flex items-center space-x-2 rtl:space-x-reverse" wire:navigate>
            <x-app-logo />
        </a>

               <flux:navlist variant="outline">

                        <!-- Submenú con Alpine.js -->
                        <div x-data="{ openConfig: false }">

                            <!-- ENCABEZADO DEL GRUPO -->
                            <button
                                @click="openConfig = !openConfig"
                                class="w-full flex items-center justify-between px-3 py-2 text-sm font-medium
                                    text-gray-700 dark:text-gray-300 hover:bg-indigo-100 dark:hover:bg-[#192133]
                                    rounded-md transition">
                                <span>Configuración</span>

                                <!-- Flecha que rota -->
                                <svg x-bind:class="openConfig ? 'rotate-90' : ''"
                                    class="w-4 h-4 transition-transform"
                                    fill="none" stroke="currentColor" stroke-width="2"
                                    viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round"
                                        d="M9 5l7 7-7 7" />
                                </svg>
                            </button>

                            <!-- ITEMS DEL SUBMENÚ -->
                            <div x-show="openConfig"
                                x-transition
                                class="ml-4 mt-2 space-y-1">

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

                    </flux:navlist>




        <flux:spacer />

        <!-- Botón dark mode mejorado con estilo azul -->
        <button
            onclick="toggleDarkMode()"
            id="darkModeToggle"
            class="p-2 rounded-lg transition-colors
                   hover:bg-indigo-200 dark:hover:bg-[#192133]">
            <span id="lightIcon" class="text-xl hidden">☀️</span>
            <span id="darkIcon" class="text-xl">🌙</span>
        </button>

        <script>
            function toggleDarkMode() {
                const html = document.documentElement;
                const currentMode = localStorage.getItem('darkMode');

                if (currentMode === 'dark') {
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
                document.getElementById('lightIcon').classList.toggle('hidden', mode !== 'dark');
                document.getElementById('darkIcon').classList.toggle('hidden', mode === 'dark');
            }

            document.addEventListener('DOMContentLoaded', function() {
                const savedMode = localStorage.getItem('darkMode') || 'light';
                if (savedMode === 'dark') {
                    document.documentElement.classList.add('dark');
                }
                updateIcons(savedMode);
            });
        </script>

        <!-- Desktop User Menu -->
        <flux:dropdown class="hidden lg:block" position="bottom" align="start">

            <flux:profile
                :name="auth()->user()->name"
                :initials="auth()->user()->initials()"
                icon:trailing="chevrons-up-down"
            />

            <flux:menu class="w-[220px]">

                <flux:menu.radio.group>
                    <div class="p-0 text-sm font-normal">
                        <div class="flex items-center gap-2 px-1 py-1.5 text-start text-sm">

                            <span class="relative flex h-8 w-8 shrink-0 overflow-hidden rounded-lg">
                                <span class="flex h-full w-full items-center justify-center rounded-lg
                                             bg-indigo-200 text-black
                                             dark:bg-[#192133] dark:text-white">
                                    {{ auth()->user()->initials() }}
                                </span>
                            </span>

                            <div class="grid flex-1 text-start text-sm leading-tight">
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

    <!-- Mobile Header -->
    <flux:header class="lg:hidden border-b border-indigo-200 bg-indigo-50
        dark:border-[#1b253d] dark:bg-[#0B1221]">

        <flux:sidebar.toggle class="lg:hidden" icon="bars-2" inset="left" />

        <flux:spacer />

        <flux:dropdown position="top" align="end">

            <flux:profile :initials="auth()->user()->initials()" icon-trailing="chevron-down" />

            <flux:menu>
                <flux:menu.radio.group>
                    <div class="p-0 text-sm font-normal">
                        <div class="flex items-center gap-2 px-1 py-1.5 text-start text-sm">

                            <span class="relative flex h-8 w-8 shrink-0 overflow-hidden rounded-lg">
                                <span class="flex h-full w-full items-center justify-center rounded-lg
                                             bg-indigo-200 text-black
                                             dark:bg-[#192133] dark:text-white">
                                    {{ auth()->user()->initials() }}
                                </span>
                            </span>

                            <div class="grid flex-1 text-start text-sm leading-tight">
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

    </flux:header>

    {{ $slot }}

    @fluxScripts
</body>
</html>
