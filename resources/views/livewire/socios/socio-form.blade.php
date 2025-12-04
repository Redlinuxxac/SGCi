<div class="overflow-x-auto">
<form wire:submit.prevent="save">
    <h2 class="text-xl font-semibold mb-4">{{ $socio ? 'Editar Socio' : 'Crear Nuevo Socio' }}</h2>
    
    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
        <!-- Nombres -->
        <div>
            <label for="nombres" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Nombres</label>
            <input wire:model="nombres" type="text" id="nombres" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 dark:bg-gray-700 dark:border-gray-600 dark:text-white">
            @error('nombres') <span class="text-red-500 text-xs">{{ $message }}</span> @enderror
        </div>

        <!-- Apellidos -->
        <div>
            <label for="apellidos" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Apellidos</label>
            <input wire:model="apellidos" type="text" id="apellidos" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 dark:bg-gray-700 dark:border-gray-600 dark:text-white">
            @error('apellidos') <span class="text-red-500 text-xs">{{ $message }}</span> @enderror
        </div>

        <!-- Cédula -->
        <div>
            <label for="cedula" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Cédula</label>
            <input wire:model="cedula" type="text" id="cedula" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 dark:bg-gray-700 dark:border-gray-600 dark:text-white">
            @error('cedula') <span class="text-red-500 text-xs">{{ $message }}</span> @enderror
        </div>

        <!-- Fecha de Ingreso -->
        <div>
            <label for="fecha_ingreso" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Fecha de Ingreso</label>
            <input wire:model="fecha_ingreso" type="date" id="fecha_ingreso" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 dark:bg-gray-700 dark:border-gray-600 dark:text-white">
            @error('fecha_ingreso') <span class="text-red-500 text-xs">{{ $message }}</span> @enderror
        </div>

        <!-- Dirección -->
        <div class="md:col-span-2">
            <label for="direccion" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Dirección</label>
            <input wire:model="direccion" type="text" id="direccion" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 dark:bg-gray-700 dark:border-gray-600 dark:text-white">
            @error('direccion') <span class="text-red-500 text-xs">{{ $message }}</span> @enderror
        </div>

        <!-- Teléfono -->
        <div>
            <label for="telefono" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Teléfono</label>
            <input wire:model="telefono" type="text" id="telefono" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 dark:bg-gray-700 dark:border-gray-600 dark:text-white">
            @error('telefono') <span class="text-red-500 text-xs">{{ $message }}</span> @enderror
        </div>
        
        <!-- Estado -->
        <div>
            <label for="estado" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Estado</label>
            <select wire:model="estado" id="estado" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 dark:bg-gray-700 dark:border-gray-600 dark:text-white">
                <option value="pendiente">Pendiente</option>
                <option value="activo">Activo</option>
                <option value="inactivo">Inactivo</option>
            </select>
            @error('estado') <span class="text-red-500 text-xs">{{ $message }}</span> @enderror
        </div>
    </div>

    <div class="mt-6 flex justify-end space-x-4">
        <button type="button" wire:click="$dispatch('socio-saved')" class="btn btn-secondary">
            Cancelar
        </button>
        <button type="submit" class="btn btn-primary">
            Guardar
        </button>
    </div>
</form>
</div>