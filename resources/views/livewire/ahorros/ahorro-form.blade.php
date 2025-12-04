<form wire:submit.prevent="save">
    <h2 class="text-xl font-semibold mb-4">{{ $ahorro ? __('ahorros.edit_title') : __('ahorros.create_new_title') }}</h2>
    
    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
        <!-- Socio -->
        <div>
            <label for="socio_id" class="block text-sm font-medium text-gray-700 dark:text-gray-300">{{ __('ahorros.select_member') }}</label>
            <select wire:model="socio_id" id="socio_id" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 dark:bg-gray-700 dark:border-gray-600 dark:text-white">
                <option value="">{{ __('ahorros.select_member') }}</option>
                @foreach($socios as $socio)
                    <option value="{{ $socio->id }}">{{ $socio->nombres }} {{ $socio->apellidos }}</option>
                @endforeach
            </select>
            @error('socio_id') <span class="text-red-500 text-xs">{{ $message }}</span> @enderror
        </div>

        <!-- Tipo de Cuenta -->
        <div>
            <label for="tipo_cuenta" class="block text-sm font-medium text-gray-700 dark:text-gray-300">{{ __('ahorros.table_header_account_type') }}</label>
            <select wire:model="tipo_cuenta" id="tipo_cuenta" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 dark:bg-gray-700 dark:border-gray-600 dark:text-white">
                <option value="vista">{{ __('ahorros.sight_account') }}</option>
                <option value="plazo_fijo">{{ __('ahorros.fixed_term') }}</option>
                <option value="especial">{{ __('ahorros.special') }}</option>
            </select>
            @error('tipo_cuenta') <span class="text-red-500 text-xs">{{ $message }}</span> @enderror
        </div>

        <!-- Saldo -->
        <div>
            <label for="saldo" class="block text-sm font-medium text-gray-700 dark:text-gray-300">{{ __('ahorros.initial_balance') }}</label>
            <input wire:model="saldo" type="number" step="0.01" id="saldo" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 dark:bg-gray-700 dark:border-gray-600 dark:text-white">
            @error('saldo') <span class="text-red-500 text-xs">{{ $message }}</span> @enderror
        </div>

        <!-- Tasa de Interés -->
        <div>
            <label for="tasa_interes" class="block text-sm font-medium text-gray-700 dark:text-gray-300">{{ __('prestamos.interest_rate_percentage') }}</label>
            <input wire:model="tasa_interes" type="number" step="0.01" id="tasa_interes" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 dark:bg-gray-700 dark:border-gray-600 dark:text-white">
            @error('tasa_interes') <span class="text-red-500 text-xs">{{ $message }}</span> @enderror
        </div>
        
        <!-- Fecha de Apertura -->
        <div>
            <label for="fecha_apertura" class="block text-sm font-medium text-gray-700 dark:text-gray-300">{{ __('ahorros.opening_date') }}</label>
            <input wire:model="fecha_apertura" type="date" id="fecha_apertura" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 dark:bg-gray-700 dark:border-gray-600 dark:text-white">
            @error('fecha_apertura') <span class="text-red-500 text-xs">{{ $message }}</span> @enderror
        </div>

        <!-- Estado -->
        <div>
            <label for="estado" class="block text-sm font-medium text-gray-700 dark:text-gray-300">{{ __('app.Estado') }}</label>
            <select wire:model="estado" id="estado" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 dark:bg-gray-700 dark:border-gray-600 dark:text-white">
                <option value="activa">{{ __('app.activa') }}</option>
                <option value="inactiva">{{ __('app.inactiva') }}</option>
                <option value="cerrada">{{ __('app.cerrada') }}</option>
            </select>
            @error('estado') <span class="text-red-500 text-xs">{{ $message }}</span> @enderror
        </div>
    </div>

    <div class="mt-6 flex justify-end space-x-4">
        <button type="button" wire:click="$dispatch('ahorro-saved')" class="btn btn-secondary">
            {{ __('app.Cancelar') }}
        </button>
        <button type="submit" class="btn btn-primary">
            {{ __('app.Guardar') }}
        </button>
    </div>
</form>