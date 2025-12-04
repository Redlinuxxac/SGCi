<form wire:submit.prevent="save">
    <h2 class="text-xl font-semibold mb-4">{{ $cuenta ? 'Editar Cuenta Contable' : 'Crear Nueva Cuenta Contable' }}</h2>
    
    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
        <!-- Código -->
        <div>
            <label for="codigo" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Código</label>
            <input wire:model="codigo" type="text" id="codigo" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 dark:bg-gray-700 dark:border-gray-600 dark:text-white">
            @error('codigo') <span class="text-red-500 text-xs">{{ $message }}</span> @enderror
        </div>

        <!-- Nombre -->
        <div>
            <label for="nombre" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Nombre</label>
            <input wire:model="nombre" type="text" id="nombre" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 dark:bg-gray-700 dark:border-gray-600 dark:text-white">
            @error('nombre') <span class="text-red-500 text-xs">{{ $message }}</span> @enderror
        </div>

        <!-- Tipo -->
        <div>
            <label for="tipo" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Tipo</label>
            <select wire:model="tipo" id="tipo" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 dark:bg-gray-700 dark:border-gray-600 dark:text-white">
                <option value="activo">Activo</option>
                <option value="pasivo">Pasivo</option>
                <option value="patrimonio">Patrimonio</option>
                <option value="ingresos">Ingresos</option>
                <option value="costos">Costos</option>
                <option value="gastos">Gastos</option>
            </select>
            @error('tipo') <span class="text-red-500 text-xs">{{ $message }}</span> @enderror
        </div>

        <!-- Cuenta Padre -->
        <div>
            <label for="padre_id" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Cuenta Padre</label>
            <select wire:model="padre_id" id="padre_id" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 dark:bg-gray-700 dark:border-gray-600 dark:text-white">
                <option value="">Ninguna</option>
                @foreach($cuentasPadre as $cuentaPadre)
                    <option value="{{ $cuentaPadre->id }}">{{ $cuentaPadre->codigo }} - {{ $cuentaPadre->nombre }}</option>
                @endforeach
            </select>
            @error('padre_id') <span class="text-red-500 text-xs">{{ $message }}</span> @enderror
        </div>
        
        <!-- Permite Transacciones -->
        <div class="md:col-span-2">
            <div class="flex items-center">
                <input wire:model="permite_transacciones" id="permite_transacciones" type="checkbox" class="h-4 w-4 text-indigo-600 border-gray-300 rounded focus:ring-indigo-500">
                <label for="permite_transacciones" class="ml-2 block text-sm text-gray-900 dark:text-gray-300">
                    Permite Transacciones
                </label>
            </div>
            @error('permite_transacciones') <span class="text-red-500 text-xs">{{ $message }}</span> @enderror
        </div>
    </div>

    <div class="mt-6 flex justify-end space-x-4">
        <button type="button" wire:click="$dispatch('cuenta-saved')" class="btn btn-secondary">
            Cancelar
        </button>
        <button type="submit" class="btn btn-primary">
            Guardar
        </button>
    </div>
</form>