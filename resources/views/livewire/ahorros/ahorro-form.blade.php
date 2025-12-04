<form wire:submit.prevent="save">
    <h2 class="text-xl font-semibold mb-4">{{ $ahorro ? 'Editar Cuenta de Ahorro' : 'Crear Nueva Cuenta de Ahorro' }}</h2>
    
    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
        <!-- Socio -->
        <div>
            <label for="socio_id" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Socio</label>
            <select wire:model="socio_id" id="socio_id" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 dark:bg-gray-700 dark:border-gray-600 dark:text-white">
                <option value="">Seleccione un socio</option>
                @foreach($socios as $socio)
                    <option value="{{ $socio->id }}">{{ $socio->nombres }} {{ $socio->apellidos }}</option>
                @endforeach
            </select>
            @error('socio_id') <span class="text-red-500 text-xs">{{ $message }}</span> @enderror
        </div>

        <!-- Tipo de Cuenta -->
        <div>
            <label for="tipo_cuenta" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Tipo de Cuenta</label>
            <select wire:model="tipo_cuenta" id="tipo_cuenta" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 dark:bg-gray-700 dark:border-gray-600 dark:text-white">
                <option value="vista">Ahorro a la Vista</option>
                <option value="plazo_fijo">Plazo Fijo</option>
                <option value="especial">Especial</option>
            </select>
            @error('tipo_cuenta') <span class="text-red-500 text-xs">{{ $message }}</span> @enderror
        </div>

        <!-- Saldo -->
        <div>
            <label for="saldo" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Saldo Inicial</label>
            <input wire:model="saldo" type="number" step="0.01" id="saldo" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 dark:bg-gray-700 dark:border-gray-600 dark:text-white">
            @error('saldo') <span class="text-red-500 text-xs">{{ $message }}</span> @enderror
        </div>

        <!-- Tasa de Interés -->
        <div>
            <label for="tasa_interes" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Tasa de Interés (%)</label>
            <input wire:model="tasa_interes" type="number" step="0.01" id="tasa_interes" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 dark:bg-gray-700 dark:border-gray-600 dark:text-white">
            @error('tasa_interes') <span class="text-red-500 text-xs">{{ $message }}</span> @enderror
        </div>
        
        <!-- Fecha de Apertura -->
        <div>
            <label for="fecha_apertura" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Fecha de Apertura</label>
            <input wire:model="fecha_apertura" type="date" id="fecha_apertura" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 dark:bg-gray-700 dark:border-gray-600 dark:text-white">
            @error('fecha_apertura') <span class="text-red-500 text-xs">{{ $message }}</span> @enderror
        </div>

        <!-- Estado -->
        <div>
            <label for="estado" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Estado</label>
            <select wire:model="estado" id="estado" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 dark:bg-gray-700 dark:border-gray-600 dark:text-white">
                <option value="activa">Activa</option>
                <option value="inactiva">Inactiva</option>
                <option value="cerrada">Cerrada</option>
            </select>
            @error('estado') <span class="text-red-500 text-xs">{{ $message }}</span> @enderror
        </div>
    </div>

    <div class="mt-6 flex justify-end space-x-4">
        <button type="button" wire:click="$dispatch('ahorro-saved')" class="btn btn-secondary">
            Cancelar
        </button>
        <button type="submit" class="btn btn-primary">
            Guardar
        </button>
    </div>
</form>