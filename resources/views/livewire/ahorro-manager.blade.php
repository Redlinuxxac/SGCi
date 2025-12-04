<x-layouts.app :title="__('Gestión de Cuentas de Ahorro')">
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Gestión de Cuentas de Ahorro') }}
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
                                Crear Cuenta de Ahorro
                            </x-button>
                        </div>
                    </div>
                    <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                        <div class="p-6 text-gray-900">
                            <h3 class="font-semibold text-lg mb-4">Estadísticas</h3>
                            <p class="text-sm text-gray-600">Total de cuentas: {{ $ahorros->total() }}</p>
                        </div>
                    </div>
                </div>

                <!-- Main Table Column -->
                <div class="lg:col-span-2">
                    <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                        <div class="p-6 text-gray-900">
                            <h3 class="font-semibold text-lg mb-4">Lista de Cuentas</h3>
                            <div class="relative overflow-x-auto">
                                <table class="w-full text-sm text-left text-gray-500">
                                    <thead class="text-xs text-gray-700 uppercase bg-gray-50">
                                        <tr>
                                            <th scope="col" class="px-6 py-3">Socio</th>
                                            <th scope="col" class="px-6 py-3">Tipo</th>
                                            <th scope="col" class="px-6 py-3">Saldo</th>
                                            <th scope="col" class="px-6 py-3">Estado</th>
                                            <th scope="col" class="px-6 py-3">Acciones</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @forelse ($ahorros as $ahorro)
                                            <tr class="bg-white border-b">
                                                <th scope="row" class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap">
                                                    {{ $ahorro->socio->nombres }} {{ $ahorro->socio->apellidos }}
                                                </th>
                                                <td class="px-6 py-4">{{ $ahorro->tipo_cuenta }}</td>
                                                <td class="px-6 py-4">{{ number_format($ahorro->saldo, 2) }}</td>
                                                <td class="px-6 py-4">{{ $ahorro->estado }}</td>
                                                <td class="px-6 py-4 space-x-2">
                                                    <x-button wire:click="openModal({{ $ahorro->id }})">Editar</x-button>
                                                    <x-danger-button wire:click="confirmAhorroDeletion({{ $ahorro->id }})">Eliminar</x-danger-button>
                                                </td>
                                            </tr>
                                        @empty
                                            <tr class="bg-white border-b">
                                                <td colspan="5" class="px-6 py-4 text-center">
                                                    No hay cuentas de ahorro registradas.
                                                </td>
                                            </tr>
                                        @endforelse
                                    </tbody>
                                </table>
                            </div>
                            <div class="mt-4">
                                {{ $ahorros->links() }}
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    {{-- Create or Edit Savings Account Modal --}}
    <x-dialog-modal wire:model="isModalOpen">
        <x-slot name="title">
            {{ $ahorroId ? 'Editar Cuenta de Ahorro' : 'Crear Nueva Cuenta de Ahorro' }}
        </x-slot>

        <x-slot name="content">
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <!-- Socio -->
                <div>
                    <x-label for="socio_id" value="Socio" />
                    <select id="socio_id" class="border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm mt-1 block w-full" wire:model.defer="socio_id">
                        <option value="">Seleccione un socio</option>
                        @foreach ($sociosList as $socio)
                            <option value="{{ $socio->id }}">{{ $socio->nombres }} {{ $socio->apellidos }}</option>
                        @endforeach
                    </select>
                    <x-input-error for="socio_id" class="mt-2" />
                </div>
                <!-- Tipo de Cuenta -->
                <div>
                    <x-label for="tipo_cuenta" value="Tipo de Cuenta" />
                    <select id="tipo_cuenta" class="border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm mt-1 block w-full" wire:model.defer="tipo_cuenta">
                        <option value="vista">Ahorro a la Vista</option>
                        <option value="plazo_fijo">Depósito a Plazo Fijo</option>
                        <option value="especial">Cuenta Especial</option>
                    </select>
                    <x-input-error for="tipo_cuenta" class="mt-2" />
                </div>
                <!-- Saldo -->
                <div>
                    <x-label for="saldo" value="Saldo Inicial" />
                    <x-input id="saldo" type="number" step="0.01" class="mt-1 block w-full" wire:model.defer="saldo" />
                    <x-input-error for="saldo" class="mt-2" />
                </div>
                <!-- Tasa de Interés -->
                <div>
                    <x-label for="tasa_interes" value="Tasa de Interés (%)" />
                    <x-input id="tasa_interes" type="number" step="0.01" class="mt-1 block w-full" wire:model.defer="tasa_interes" />
                    <x-input-error for="tasa_interes" class="mt-2" />
                </div>
                <!-- Fecha Apertura -->
                <div>
                    <x-label for="fecha_apertura" value="Fecha de Apertura" />
                    <x-input id="fecha_apertura" type="date" class="mt-1 block w-full" wire:model.defer="fecha_apertura" />
                    <x-input-error for="fecha_apertura" class="mt-2" />
                </div>
                <!-- Estado -->
                <div>
                    <x-label for="estado" value="Estado" />
                    <select id="estado" class="border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm mt-1 block w-full" wire:model.defer="estado">
                        <option value="activa">Activa</option>
                        <option value="inactiva">Inactiva</option>
                        <option value="cerrada">Cerrada</option>
                    </select>
                    <x-input-error for="estado" class="mt-2" />
                </div>
            </div>
        </x-slot>

        <x-slot name="footer">
            <x-secondary-button wire:click="closeModal" wire:loading.attr="disabled">
                Cancelar
            </x-secondary-button>
            <x-button class="ml-3" wire:click="saveAhorro" wire:loading.attr="disabled">
                Guardar
            </x-button>
        </x-slot>
    </x-dialog-modal>

    {{-- Delete Savings Account Confirmation Modal --}}
    <x-dialog-modal wire:model="isConfirmingAhorroDeletion">
        <x-slot name="title">
            ¿Eliminar Cuenta de Ahorro?
        </x-slot>
        <x-slot name="content">
            ¿Está seguro de que desea eliminar esta cuenta de ahorro? Esta acción no se puede deshacer.
        </x-slot>
        <x-slot name="footer">
            <x-secondary-button wire:click="closeDeleteConfirmationModal" wire:loading.attr="disabled">
                Cancelar
            </x-secondary-button>
            <x-danger-button class="ml-3" wire:click="deleteAhorro" wire:loading.attr="disabled">
                Eliminar Cuenta
            </x-danger-button>
        </x-slot>
    </x-dialog-modal>
</x-layouts.app>