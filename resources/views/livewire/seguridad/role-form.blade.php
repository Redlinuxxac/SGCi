<form wire:submit.prevent="save">
    <h2 class="text-xl font-semibold mb-4">{{ $role ? 'Editar Rol' : 'Crear Nuevo Rol' }}</h2>
    
    <div>
        <label for="name" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Nombre del Rol</label>
        <input wire:model="name" type="text" id="name" @if($role && $role->name === 'admin') readonly @endif class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 dark:bg-gray-700 dark:border-gray-600 dark:text-white">
        @error('name') <span class="text-red-500 text-xs">{{ $message }}</span> @enderror
    </div>

    <div class="mt-4">
        <h3 class="text-lg font-medium text-gray-900 dark:text-white">Permisos</h3>
        <div class="mt-2 grid grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-4">
            @foreach($allPermissions as $permission)
                <div class="flex items-center">
                    <input wire:model="selectedPermissions" id="permission_{{ $permission->id }}" type="checkbox" value="{{ $permission->id }}" class="h-4 w-4 text-indigo-600 border-gray-300 rounded focus:ring-indigo-500">
                    <label for="permission_{{ $permission->id }}" class="ml-2 block text-sm text-gray-900 dark:text-gray-300">
                        {{ $permission->name }}
                    </label>
                </div>
            @endforeach
        </div>
        @error('selectedPermissions') <span class="text-red-500 text-xs">{{ $message }}</span> @enderror
    </div>

    <div class="mt-6 flex justify-end space-x-4">
        <button type="button" wire:click="$dispatch('role-saved')" class="btn btn-secondary">
            Cancelar
        </button>
        <button type="submit" class="btn btn-primary">
            Guardar
        </button>
    </div>
</form>