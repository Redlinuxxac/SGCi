<form wire:submit.prevent="save">
    <h2 class="text-xl font-semibold mb-4">{{ $user ? __('users.edit_title') : __('users.create_new_title') }}</h2>
    
    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
        <!-- Name -->
        <div>
            <label for="name" class="block text-sm font-medium text-gray-700 dark:text-gray-300">{{ __('users.table_header_name') }}</label>
            <input wire:model="name" type="text" id="name" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 dark:bg-gray-700 dark:border-gray-600 dark:text-white">
            @error('name') <span class="text-red-500 text-xs">{{ $message }}</span> @enderror
        </div>

        <!-- Email -->
        <div>
            <label for="email" class="block text-sm font-medium text-gray-700 dark:text-gray-300">{{ __('users.table_header_email') }}</label>
            <input wire:model="email" type="email" id="email" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 dark:bg-gray-700 dark:border-gray-600 dark:text-white">
            @error('email') <span class="text-red-500 text-xs">{{ $message }}</span> @enderror
        </div>

        <!-- Password -->
        <div>
            <label for="password" class="block text-sm font-medium text-gray-700 dark:text-gray-300">{{ __('users.password') }}</label>
            <input wire:model="password" type="password" id="password" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 dark:bg-gray-700 dark:border-gray-600 dark:text-white">
            @error('password') <span class="text-red-500 text-xs">{{ $message }}</span> @enderror
        </div>

        <!-- Confirm Password -->
        <div>
            <label for="password_confirmation" class="block text-sm font-medium text-gray-700 dark:text-gray-300">{{ __('users.confirm_password') }}</label>
            <input wire:model="password_confirmation" type="password" id="password_confirmation" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 dark:bg-gray-700 dark:border-gray-600 dark:text-white">
        </div>

        <!-- Roles -->
        <div class="md:col-span-2">
            <label class="block text-sm font-medium text-gray-700 dark:text-gray-300">{{ __('users.assign_roles') }}</label>
            <div class="mt-2 grid grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-2">
                @foreach ($allRoles as $roleId => $roleName)
                    <div class="flex items-center">
                        <input type="checkbox" wire:model="selectedRoles" value="{{ $roleId }}" id="role_{{ $roleId }}" class="h-4 w-4 text-indigo-600 border-gray-300 rounded focus:ring-indigo-500">
                        <label for="role_{{ $roleId }}" class="ml-2 block text-sm text-gray-900 dark:text-gray-300">
                            {{ $roleName }}
                        </label>
                    </div>
                @endforeach
            </div>
            @error('selectedRoles') <span class="text-red-500 text-xs">{{ $message }}</span> @enderror
        </div>
    </div>

    <div class="mt-6 flex justify-end space-x-4">
        <button type="button" wire:click="$dispatch('user-saved')" class="btn btn-secondary">
            {{ __('app.Cancelar') }}
        </button>
        <button type="submit" class="btn btn-primary">
            {{ __('app.Guardar') }}
        </button>
    </div>
</form>