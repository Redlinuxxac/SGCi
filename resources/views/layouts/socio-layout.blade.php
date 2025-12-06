<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="dark">
    <head>
        @include('partials.head')
        <title>{{ config('app.name', 'Laravel') }}</title>
        @vite(['resources/css/app.css', 'resources/js/app.js'])
        @livewireStyles
    </head>
    <body class="min-h-screen bg-white dark:bg-zinc-800">
        <div class="flex h-screen bg-gray-100 dark:bg-gray-900">
            <!-- Sidebar for Socio -->
            <aside class="w-64 bg-white dark:bg-gray-800 shadow">
                <div class="p-4 border-b dark:border-gray-700">
                    <a href="{{ route('socio.dashboard') }}" class="flex items-center space-x-2 text-xl font-semibold text-gray-800 dark:text-white" wire:navigate>
                        <x-app-logo-icon class="h-10 w-10 fill-current text-blue-600 dark:text-blue-400" />
                        <span>{{ config('app.name') }}</span>
                    </a>
                </div>
                <nav class="mt-4">
                    <a href="{{ route('socio.dashboard') }}" class="flex items-center px-4 py-2 text-gray-700 dark:text-gray-300 hover:bg-gray-200 dark:hover:bg-gray-700 @if(request()->routeIs('socio.dashboard')) bg-gray-200 dark:bg-gray-700 @endif" wire:navigate>
                        <x-flux::icon name="home" class="w-5 h-5 mr-2" />
                        {{ __('app.Dashboard') }}
                    </a>
                    <a href="{{ route('socio.profile') }}" class="flex items-center px-4 py-2 text-gray-700 dark:text-gray-300 hover:bg-gray-200 dark:hover:bg-gray-700 @if(request()->routeIs('socio.profile')) bg-gray-200 dark:bg-gray-700 @endif" wire:navigate>
                        <x-flux::icon name="user" class="w-5 h-5 mr-2" />
                        {{ __('app.Mi Perfil') }}
                    </a>
                    <a href="{{ route('socio.my-loans') }}" class="flex items-center px-4 py-2 text-gray-700 dark:text-gray-300 hover:bg-gray-200 dark:hover:bg-gray-700 @if(request()->routeIs('socio.my-loans')) bg-gray-200 dark:bg-gray-700 @endif" wire:navigate>
                        <x-flux::icon name="banknotes" class="w-5 h-5 mr-2" />
                        {{ __('app.Mis Préstamos') }}
                    </a>
                    <a href="{{ route('socio.my-savings') }}" class="flex items-center px-4 py-2 text-gray-700 dark:text-gray-300 hover:bg-gray-200 dark:hover:bg-gray-700 @if(request()->routeIs('socio.my-savings')) bg-gray-200 dark:bg-gray-700 @endif" wire:navigate>
                        <x-flux::icon name="archive-box" class="w-5 h-5 mr-2" />
                        {{ __('app.Mis Ahorros') }}
                    </a>
                    
                    <!-- Logout -->
                    <form method="POST" action="{{ route('logout') }}" class="w-full">
                        @csrf
                        <a href="{{ route('logout') }}" onclick="event.preventDefault(); this.closest('form').submit();" class="flex items-center px-4 py-2 text-gray-700 dark:text-gray-300 hover:bg-gray-200 dark:hover:bg-gray-700">
                            <x-flux::icon name="arrow-right-start-on-rectangle" class="w-5 h-5 mr-2" />
                            {{ __('app.Log Out') }}
                        </a>
                    </form>
                </nav>
            </aside>

            <!-- Main Content -->
            <div class="flex-1 flex flex-col overflow-hidden">
                <header class="flex justify-between items-center p-4 bg-white dark:bg-gray-800 border-b dark:border-gray-700">
                    <div class="text-xl font-semibold text-gray-800 dark:text-white">{{ config('app.name') }} - {{ __('app.Portal del Socio') }}</div>
                    <!-- User Dropdown (optional) -->
                    <div>
                        <span class="text-gray-700 dark:text-gray-300">{{ Auth::user()->name }}</span>
                    </div>
                </header>
                <main class="flex-1 overflow-x-hidden overflow-y-auto bg-gray-200 dark:bg-gray-900 p-4">
                    {{ $slot }}
                </main>
            </div>
        </div>
        @fluxScripts
    </body>
</html>
