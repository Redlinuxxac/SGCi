<form wire:submit.prevent="save">
    <h2 class="text-xl font-semibold mb-4">{{ $servicio ? 'Editar Servicio' : 'Crear Nuevo Servicio' }}</h2>
    
    <div class="grid grid-cols-1 gap-4">
        <!-- Nombre -->
        <div>
            <label for="nombre" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Nombre</label>
            <input wire:model="nombre" type="text" id="nombre" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 dark:bg-gray-700 dark:border-gray-600 dark:text-white">
            @error('nombre') <span class="text-red-500 text-xs">{{ $message }}</span> @enderror
        </div>

        <!-- Descripción -->
        <div>
            <label for="descripcion" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Descripción</label>
            <textarea wire:model="descripcion" id="descripcion" rows="4" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 dark:bg-gray-700 dark:border-gray-600 dark:text-white"></textarea>
            @error('descripcion') <span class="text-red-500 text-xs">{{ $message }}</span> @enderror
        </div>

        <!-- Estado -->
        <div>
            <label for="estado" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Estado</label>
            <select wire:model="estado" id="estado" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 dark:bg-gray-700 dark:border-gray-600 dark:text-white">
                <option value="activo">Activo</option>
                <option value="inactivo">Inactivo</option>
            </select>
            @error('estado') <span class="text-red-500 text-xs">{{ $message }}</span> @enderror
        </div>
    </div>

    <div class="mt-6 flex justify-end space-x-4">
        <button type="button" wire:click="$dispatch('servicio-saved')" class="btn btn-secondary">
            Cancelar
        </button>
        <button type="submit" class="btn btn-primary">
            Guardar
        </button>
    </div>
</form>