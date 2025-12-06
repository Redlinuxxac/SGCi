<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="dark">
    <head>
        @include('partials.head')
    </head>
    <body class="min-h-screen bg-white dark:bg-zinc-800">
        <flux:sidebar sticky stashable class="border-e border-zinc-200 bg-zinc-50 dark:border-zinc-700 dark:bg-zinc-900">
            <flux:sidebar.toggle class="lg:hidden" icon="x-mark" />

            <a href="{{ route('dashboard') }}" class="me-5 flex items-center space-x-2 rtl:space-x-reverse" wire:navigate>
                <x-app-logo />
            </a>

            <flux:navlist variant="outline">
                <flux:navlist.group :heading="__('app.Platform')" class="grid">
                    <flux:navlist.item icon="home" :href="route('dashboard')" :current="request()->routeIs('dashboard')" wire:navigate>{{ __('app.Dashboard') }}</flux:navlist.item>
                    @can('socios.view')
                    <flux:navlist.item icon="users" :href="route('socios.index')" :current="request()->routeIs('socios.index')" wire:navigate>{{ __('socios.management_title') }}</flux:navlist.item>
                    @endcan
                    @can('prestamos.view')
                    <flux:navlist.item icon="banknotes" :href="route('prestamos.index')" :current="request()->routeIs('prestamos.index')" wire:navigate>{{ __('prestamos.management_title') }}</flux:navlist.item>
                    @endcan
                    @can('ahorros.view')
                    <flux:navlist.item icon="archive-box" :href="route('ahorros.index')" :current="request()->routeIs('ahorros.index')" wire:navigate>{{ __('ahorros.management_title') }}</flux:navlist.item>
                    @endcan
                    @can('cuentas_contables.view')
                    <flux:navlist.item icon="book-open" :href="route('plan-cuentas.index')" :current="request()->routeIs('plan-cuentas.index')" wire:navigate>{{ __('contabilidad.chart_of_accounts_title') }}</flux:navlist.item>
                    @endcan
                    @can('asientos_contables.view')
                    <flux:navlist.item icon="clipboard-document-list" :href="route('asientos.index')" :current="request()->routeIs('asientos.index')" wire:navigate>{{ __('contabilidad.journal_entries_title') }}</flux:navlist.item>
                    @endcan
                    @can('servicios.view')
                    <flux:navlist.item icon="briefcase" :href="route('servicios.index')" :current="request()->routeIs('servicios.index')" wire:navigate>{{ __('servicios.management_title') }}</flux:navlist.item>
                    @endcan
                    @can('auditoria.view')
                    <flux:navlist.item icon="shield-check" :href="route('auditoria.index')" :current="request()->routeIs('auditoria.index')" wire:navigate>{{ __('auditoria.management_title') }}</flux:navlist.item>
                    @endcan
                    @can('users.view')
                    <flux:navlist.item icon="user-group" :href="route('users.index')" :current="request()->routeIs('users.index')" wire:navigate>{{ __('users.management_title') }}</flux:navlist.item>
                    @endcan
                </flux:navlist.group>

                <flux:navlist.group :heading="__('seguridad.security_title')" class="grid">
                    <!-- Only show user management if the user has any of the relevant permissions -->
                    
                    @can('users.view')
                    <flux:navlist.item icon="user-circle" :href="route('users.index')" :current="request()->routeIs('users.index')" wire:navigate>{{ __('seguridad.users_title') }}</flux:navlist.item>
                    @endcan
                    @can('roles.view')
                    <flux:navlist.item icon="key" :href="route('roles.index')" :current="request()->routeIs('roles.index')" wire:navigate>{{ __('seguridad.roles_title') }}</flux:navlist.item>
                    @endcan
                    @can('permisos.view')
                    <flux:navlist.item icon="lock-closed" :href="route('permisos.index')" :current="request()->routeIs('permisos.index')" wire:navigate>{{ __('seguridad.permissions_title') }}</flux:navlist.item>
                    @endcan
                </flux:navlist.group>
            </flux:navlist>

            <flux:spacer />

            <flux:navlist variant="outline">
                <flux:navlist.item icon="book-open-text" :href="route('documentacion.index')" wire:navigate>
                {{ __('docs.Documentation') }}
                </flux:navlist.item>
            </flux:navlist>

            <!-- Desktop User Menu -->
            <flux:dropdown class="hidden lg:block" position="bottom" align="start">
                <flux:profile
                    :name="auth()->user()->name"
                    :initials="auth()->user()->initials()"
                    icon:trailing="chevrons-up-down"
                    data-test="sidebar-menu-button"
                />

                <flux:menu class="w-[220px]">
                    <flux:menu.radio.group>
                        <div class="p-0 text-sm font-normal">
                            <div class="flex items-center gap-2 px-1 py-1.5 text-start text-sm">
                                <span class="relative flex h-8 w-8 shrink-0 overflow-hidden rounded-lg">
                                    <span
                                        class="flex h-full w-full items-center justify-center rounded-lg bg-neutral-200 text-black dark:bg-neutral-700 dark:text-white"
                                    >
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
                        <flux:menu.item :href="route('profile.edit')" icon="cog" wire:navigate>{{ __('app.Settings') }}</flux:menu.item>
                    </flux:menu.radio.group>

                    <flux:menu.separator />

                    <form method="POST" action="{{ route('logout') }}" class="w-full">
                        @csrf
                        <flux:menu.item as="button" type="submit" icon="arrow-right-start-on-rectangle" class="w-full" data-test="logout-button">
                            {{ __('app.Log Out') }}
                        </flux:menu.item>
                    </form>
                </flux:menu>
            </flux:dropdown>
        </flux:sidebar>

        <!-- Mobile User Menu -->
        <flux:header class="lg:hidden">
            <flux:sidebar.toggle class="lg:hidden" icon="bars-2" inset="left" />

            <flux:spacer />

            <flux:dropdown position="top" align="end">
                <flux:profile
                    :initials="auth()->user()->initials()"
                    icon-trailing="chevron-down"
                />

                <flux:menu>
                    <flux:menu.radio.group>
                        <div class="p-0 text-sm font-normal">
                            <div class="flex items-center gap-2 px-1 py-1.5 text-start text-sm">
                                <span class="relative flex h-8 w-8 shrink-0 overflow-hidden rounded-lg">
                                    <span
                                        class="flex h-full w-full items-center justify-center rounded-lg bg-neutral-200 text-black dark:bg-neutral-700 dark:text-white"
                                    >
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
                        <flux:menu.item :href="route('profile.edit')" icon="cog" wire:navigate>{{ __('Settings') }}</flux:menu.item>
                    </flux:menu.radio.group>

                    <flux:menu.separator />

                    <form method="POST" action="{{ route('logout') }}" class="w-full">
                        @csrf
                        <flux:menu.item as="button" type="submit" icon="arrow-right-start-on-rectangle" class="w-full" data-test="logout-button">
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
