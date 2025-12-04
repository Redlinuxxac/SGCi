<form wire:submit.prevent="save">
    <h2 class="text-xl font-semibold mb-4">{{ $prestamo ? 'Editar Préstamo' : 'Crear Nuevo Préstamo' }}</h2>
    
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

        <!-- Monto -->
        <div>
            <label for="monto" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Monto</label>
            <input wire:model="monto" type="number" step="0.01" id="monto" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 dark:bg-gray-700 dark:border-gray-600 dark:text-white">
            @error('monto') <span class="text-red-500 text-xs">{{ $message }}</span> @enderror
        </div>

        <!-- Tasa de Interés -->
        <div>
            <label for="tasa_interes" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Tasa de Interés (%)</label>
            <input wire:model="tasa_interes" type="number" step="0.01" id="tasa_interes" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 dark:bg-gray-700 dark:border-gray-600 dark:text-white">
            @error('tasa_interes') <span class="text-red-500 text-xs">{{ $message }}</span> @enderror
        </div>

        <!-- Plazo en Meses -->
        <div>
            <label for="plazo_meses" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Plazo (Meses)</label>
            <input wire:model="plazo_meses" type="number" id="plazo_meses" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 dark:bg-gray-700 dark:border-gray-600 dark:text-white">
            @error('plazo_meses') <span class="text-red-500 text-xs">{{ $message }}</span> @enderror
        </div>

        <!-- Fecha de Desembolso -->
        <div>
            <label for="fecha_desembolso" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Fecha de Desembolso</label>
            <input wire:model="fecha_desembolso" type="date" id="fecha_desembolso" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 dark:bg-gray-700 dark:border-gray-600 dark:text-white">
            @error('fecha_desembolso') <span class="text-red-500 text-xs">{{ $message }}</span> @enderror
        </div>

        <!-- Estado -->
        <div>
            <label for="estado" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Estado</label>
            <select wire:model="estado" id="estado" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 dark:bg-gray-700 dark:border-gray-600 dark:text-white">
                <option value="pendiente">Pendiente</option>
                <option value="aprobado">Aprobado</option>
                <option value="desembolsado">Desembolsado</option>
                <option value="cancelado">Cancelado</option>
                <option value="pagado">Pagado</option>
            </select>
            @error('estado') <span class="text-red-500 text-xs">{{ $message }}</span> @enderror
        </div>

        <!-- Observaciones -->
        <div class="md:col-span-2">
            <label for="observaciones" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Observaciones</label>
            <textarea wire:model="observaciones" id="observaciones" rows="3" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 dark:bg-gray-700 dark:border-gray-600 dark:text-white"></textarea>
            @error('observaciones') <span class="text-red-500 text-xs">{{ $message }}</span> @enderror
        </div>
    </div>

    <div class="mt-6 flex justify-end space-x-4">
        <button type="button" wire:click="$dispatch('prestamo-saved')" class="btn btn-secondary">
            Cancelar
        </button>
        <button type="submit" class="btn btn-primary">
            Guardar
        </button>
    </div>
</form>