<div>
    <h2 class="text-xl font-semibold mb-4">{{ $asiento ? 'Ver Asiento Contable' : 'Crear Nuevo Asiento Contable' }}</h2>

    <form wire:submit.prevent="save">
        <div class="grid grid-cols-1 md:grid-cols-3 gap-4 mb-4">
            <div>
                <label for="fecha" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Fecha</label>
                <input wire:model="fecha" type="date" id="fecha" @if($isReadOnly) readonly @endif class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 dark:bg-gray-700 dark:border-gray-600 dark:text-white">
                @error('fecha') <span class="text-red-500 text-xs">{{ $message }}</span> @enderror
            </div>
            <div class="md:col-span-2">
                <label for="descripcion" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Descripción</label>
                <input wire:model="descripcion" type="text" id="descripcion" @if($isReadOnly) readonly @endif class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 dark:bg-gray-700 dark:border-gray-600 dark:text-white">
                @error('descripcion') <span class="text-red-500 text-xs">{{ $message }}</span> @enderror
            </div>
        </div>

        <div class="overflow-x-auto">
            <table class="min-w-full divide-y divide-gray-200 dark:divide-gray-700">
                <thead class="bg-gray-50 dark:bg-gray-800">
                    <tr>
                        <th class="px-4 py-2 text-left">Cuenta</th>
                        <th class="px-4 py-2 text-left">Debe</th>
                        <th class="px-4 py-2 text-left">Haber</th>
                        <th class="px-4 py-2 text-left">Descripción</th>
                        @if(!$isReadOnly)
                        <th></th>
                        @endif
                    </tr>
                </thead>
                <tbody class="bg-white divide-y divide-gray-200 dark:bg-gray-900">
                    @foreach($movimientos as $index => $movimiento)
                        <tr wire:key="movimiento-{{ $index }}">
                            <td>
                                <select wire:model="movimientos.{{ $index }}.cuenta_contable_id" @if($isReadOnly) disabled @endif class="w-full rounded-md border-gray-300 shadow-sm dark:bg-gray-700 dark:border-gray-600">
                                    <option value="">Seleccionar...</option>
                                    @foreach($cuentas as $cuenta)
                                        <option value="{{ $cuenta->id }}">{{ $cuenta->codigo }} - {{ $cuenta->nombre }}</option>
                                    @endforeach
                                </select>
                            </td>
                            <td><input wire:model="movimientos.{{ $index }}.debe" type="number" step="0.01" class="w-full rounded-md dark:bg-gray-700" @if($isReadOnly) readonly @endif></td>
                            <td><input wire:model="movimientos.{{ $index }}.haber" type="number" step="0.01" class="w-full rounded-md dark:bg-gray-700" @if($isReadOnly) readonly @endif></td>
                            <td><input wire:model="movimientos.{{ $index }}.descripcion" type="text" class="w-full rounded-md dark:bg-gray-700" @if($isReadOnly) readonly @endif></td>
                            @if(!$isReadOnly)
                            <td><button type="button" wire:click="removeMovimiento({{ $index }})" class="text-red-500">X</button></td>
                            @endif
                        </tr>
                    @endforeach
                </tbody>
                @if(!$isReadOnly)
                <tfoot>
                    <tr>
                        <td colspan="5" class="text-right pt-2">
                            <button type="button" wire:click="addMovimiento" class="btn btn-secondary">Añadir Fila</button>
                        </td>
                    </tr>
                </tfoot>
                @endif
            </table>
        </div>
        @error('balance') <div class="mt-2 text-red-500 text-sm">{{ $message }}</div> @enderror

        <div class="mt-6 flex justify-end space-x-4">
            <button type="button" wire:click="$dispatch('asiento-saved')" class="btn btn-secondary">
                Cerrar
            </button>
            @if(!$isReadOnly)
            <button type="submit" class="btn btn-primary">
                Guardar Asiento
            </button>
            @endif
        </div>
    </form>
</div>