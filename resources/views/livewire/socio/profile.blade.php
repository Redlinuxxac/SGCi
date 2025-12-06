<div>
    <h1 class="text-2xl font-semibold text-gray-900 dark:text-white">{{ __('app.Mi Perfil') }}</h1>

    <div class="mt-4 p-4 bg-gray-100 dark:bg-gray-800/50 rounded-lg shadow-md">
        <h2 class="text-xl font-semibold text-gray-800 dark:text-white">{{ __('app.Gestiona y actualiza tu información personal.') }}</h2>
        <p class="text-gray-700 dark:text-gray-300 mt-2">
            {{ __('app.Tu Perfil') }}
        </p>

        @if (session()->has('message'))
            <div class="mt-4 p-3 bg-green-100 dark:bg-green-900/50 text-green-800 dark:text-green-200 rounded-lg">
                {{ session('message') }}
            </div>
        @endif

        <form wire:submit.prevent="save" class="mt-4 space-y-4">
            <!-- Nombres -->
            <div>
                <label for="nombres" class="block text-sm font-medium text-gray-700 dark:text-gray-300">{{ __('socios.table_header_first_names') }}</label>
                <input wire:model="nombres" type="text" id="nombres" readonly class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 dark:bg-gray-700 dark:border-gray-600 dark:text-white cursor-not-allowed">
            </div>

            <!-- Apellidos -->
            <div>
                <label for="apellidos" class="block text-sm font-medium text-gray-700 dark:text-gray-300">{{ __('socios.table_header_last_names') }}</label>
                <input wire:model="apellidos" type="text" id="apellidos" readonly class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 dark:bg-gray-700 dark:border-gray-600 dark:text-white cursor-not-allowed">
            </div>

            <!-- Cédula -->
            <div>
                <label for="cedula" class="block text-sm font-medium text-gray-700 dark:text-gray-300">{{ __('socios.table_header_id_number') }}</label>
                <input wire:model="cedula" type="text" id="cedula" readonly class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 dark:bg-gray-700 dark:border-gray-600 dark:text-white cursor-not-allowed">
            </div>
            
            <!-- Email (from User model) -->
            <div>
                <label for="email" class="block text-sm font-medium text-gray-700 dark:text-gray-300">{{ __('app.Email') }}</label>
                <input wire:model="email" type="email" id="email" readonly class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 dark:bg-gray-700 dark:border-gray-600 dark:text-white cursor-not-allowed">
            </div>

            <!-- Dirección -->
            <div>
                <label for="direccion" class="block text-sm font-medium text-gray-700 dark:text-gray-300">{{ __('socios.address') }}</label>
                <input wire:model="direccion" type="text" id="direccion" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 dark:bg-gray-700 dark:border-gray-600 dark:text-white">
                @error('direccion') <span class="text-red-500 text-xs">{{ $message }}</span> @enderror
            </div>

            <!-- Teléfono -->
            <div>
                <label for="telefono" class="block text-sm font-medium text-gray-700 dark:text-gray-300">{{ __('socios.phone') }}</label>
                <input wire:model="telefono" type="text" id="telefono" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 dark:bg-gray-700 dark:border-gray-600 dark:text-white">
                @error('telefono') <span class="text-red-500 text-xs">{{ $message }}</span> @enderror
            </div>

            <div class="flex justify-end">
                <button type="submit" class="btn btn-primary">{{ __('app.Guardar cambios') }}</button>
            </div>
        </form>
    </div>
</div>