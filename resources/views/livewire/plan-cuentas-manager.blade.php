<x-layouts.app :title="__('Plan de Cuentas')">
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Plan de Cuentas') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">

                <!-- Actions and Stats Column -->
                <div class="lg:col-span-1 space-y-6">
                    <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                        <div class="p-6 text-gray-900">
                            <h3 class="font-semibold text-lg mb-4">Acciones</h3>
                            <x-button wire:click="openModal()" class="w-full justify-center">
                                Crear Cuenta Contable
                            </x-button>
                        </div>
                    </div>
                    <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                        <div class="p-6 text-gray-900">
                            <h3 class="font-semibold text-lg mb-4">Estadísticas</h3>
                            <p class="text-sm text-gray-600">Total de cuentas: {{ $cuentas->total() }}</p>
                        </div>
                    </div>
                </div>

                <!-- Main Table Column -->
                <div class="lg:col-span-2">
                    <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                        <div class="p-6 text-gray-900">
                            <h3 class="font-semibold text-lg mb-4">Plan de Cuentas</h3>
                            <div class="relative overflow-x-auto">
                                <table class="w-full text-sm text-left text-gray-500">
                                    <thead class="text-xs text-gray-700 uppercase bg-gray-50">
                                        <tr>
                                            <th scope="col" class="px-6 py-3">Código</th>
                                            <th scope="col" class="px-6 py-3">Nombre</th>
                                            <th scope="col" class="px-6 py-3">Tipo</th>
                                            <th scope="col" class="px-6 py-3">Acciones</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @forelse ($cuentas as $cuenta)
                                            <tr class="bg-white border-b">
                                                <th scope="row" class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap">{{ $cuenta->codigo }}</th>
                                                <td class="px-6 py-4">{{ $cuenta->nombre }}</td>
                                                <td class="px-6 py-4">{{ $cuenta->tipo }}</td>
                                                <td class="px-6 py-4 space-x-2">
                                                    <x-button wire:click="openModal({{ $cuenta->id }})">Editar</x-button>
                                                    <x-danger-button wire:click="confirmCuentaDeletion({{ $cuenta->id }})">Eliminar</x-danger-button>
                                                </td>
                                            </tr>
                                        @empty
                                            <tr class="bg-white border-b">
                                                <td colspan="4" class="px-6 py-4 text-center">
                                                    No hay cuentas contables registradas.
                                                </td>
                                            </tr>
                                        @endforelse
                                    </tbody>
                                </table>
                            </div>
                            <div class="mt-4">
                                {{ $cuentas->links() }}
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    {{-- Create or Edit Account Modal --}}
    <x-dialog-modal wire:model="isModalOpen">
        <x-slot name="title">
            {{ $cuentaId ? 'Editar Cuenta Contable' : 'Crear Nueva Cuenta Contable' }}
        </x-slot>

        <x-slot name="content">
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <!-- Código -->
                <div>
                    <x-label for="codigo" value="Código" />
                    <x-input id="codigo" type="text" class="mt-1 block w-full" wire:model.defer="codigo" />
                    <x-input-error for="codigo" class="mt-2" />
                </div>
                <!-- Nombre -->
                <div>
                    <x-label for="nombre" value="Nombre" />
                    <x-input id="nombre" type="text" class="mt-1 block w-full" wire:model.defer="nombre" />
                    <x-input-error for="nombre" class="mt-2" />
                </div>
                <!-- Tipo -->
                <div>
                    <x-label for="tipo" value="Tipo de Cuenta" />
                    <select id="tipo" class="border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm mt-1 block w-full" wire:model.defer="tipo">
                        <option value="activo">Activo</option>
                        <option value="pasivo">Pasivo</option>
                        <option value="patrimonio">Patrimonio</option>
                        <option value="ingresos">Ingresos</option>
                        <option value="costos">Costos</option>
                        <option value="gastos">Gastos</option>
                    </select>
                    <x-input-error for="tipo" class="mt-2" />
                </div>
                <!-- Cuenta Padre -->
                <div>
                    <x-label for="padre_id" value="Cuenta Padre" />
                    <select id="padre_id" class="border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm mt-1 block w-full" wire:model.defer="padre_id">
                        <option value="">Ninguna</option>
                        @foreach ($cuentasList as $cuenta)
                            <option value="{{ $cuenta->id }}">{{ $cuenta->codigo }} - {{ $cuenta->nombre }}</option>
                        @endforeach
                    </select>
                    <x-input-error for="padre_id" class="mt-2" />
                </div>
                <!-- Permite Transacciones -->
                <div class="md:col-span-2">
                    <x-label for="permite_transacciones" value="Permite Transacciones" />
                    <label class="flex items-center">
                        <input id="permite_transacciones" type="checkbox" class="rounded border-gray-300 text-indigo-600 shadow-sm focus:ring-indigo-500" wire:model.defer="permite_transacciones">
                        <span class="ml-2 text-sm text-gray-600">Marcar si esta cuenta recibirá asientos contables directos.</span>
                    </label>
                    <x-input-error for="permite_transacciones" class="mt-2" />
                </div>
            </div>
        </x-slot>

        <x-slot name="footer">
            <x-secondary-button wire:click="closeModal" wire:loading.attr="disabled">
                Cancelar
            </x-secondary-button>
            <x-button class="ml-3" wire:click="saveCuenta" wire:loading.attr="disabled">
                Guardar
            </x-button>
        </x-slot>
    </x-dialog-modal>

    {{-- Delete Account Confirmation Modal --}}
    <x-dialog-modal wire:model="isConfirmingCuentaDeletion">
        <x-slot name="title">
            ¿Eliminar Cuenta Contable?
        </x-slot>
        <x-slot name="content">
            ¿Está seguro de que desea eliminar esta cuenta? Si tiene cuentas hijas, también podrían ser afectadas. Esta acción no se puede deshacer.
        </x-slot>
        <x-slot name="footer">
            <x-secondary-button wire:click="closeDeleteConfirmationModal" wire:loading.attr="disabled">
                Cancelar
            </x-secondary-button>
            <x-danger-button class="ml-3" wire:click="deleteCuenta" wire:loading.attr="disabled">
                Eliminar Cuenta
            </x-danger-button>
        </x-slot>
    </x-dialog-modal>
</x-layouts.app>