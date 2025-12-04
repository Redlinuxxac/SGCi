<x-layouts.app :title="__('Gestión de Préstamos')">
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Gestión de Préstamos') }}
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
                                Crear Préstamo
                            </x-button>
                        </div>
                    </div>
                    <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                        <div class="p-6 text-gray-900">
                            <h3 class="font-semibold text-lg mb-4">Estadísticas</h3>
                            <p class="text-sm text-gray-600">Total de préstamos: {{ $prestamos->total() }}</p>
                        </div>
                    </div>
                </div>

                <!-- Main Table Column -->
                <div class="lg:col-span-2">
                    <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                        <div class="p-6 text-gray-900">
                            <h3 class="font-semibold text-lg mb-4">Lista de Préstamos</h3>
                            <div class="relative overflow-x-auto">
                                <table class="w-full text-sm text-left text-gray-500">
                                    <thead class="text-xs text-gray-700 uppercase bg-gray-50">
                                        <tr>
                                            <th scope="col" class="px-6 py-3">Socio</th>
                                            <th scope="col" class="px-6 py-3">Monto</th>
                                            <th scope="col" class="px-6 py-3">Estado</th>
                                            <th scope="col" class="px-6 py-3">Acciones</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @forelse ($prestamos as $prestamo)
                                            <tr class="bg-white border-b">
                                                <th scope="row" class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap">
                                                    {{ $prestamo->socio->nombres }} {{ $prestamo->socio->apellidos }}
                                                </th>
                                                <td class="px-6 py-4">{{ number_format($prestamo->monto, 2) }}</td>
                                                <td class="px-6 py-4">{{ $prestamo->estado }}</td>
                                                <td class="px-6 py-4 space-x-2">
                                                    <x-button wire:click="openModal({{ $prestamo->id }})">Editar</x-button>
                                                    <x-danger-button wire:click="confirmPrestamoDeletion({{ $prestamo->id }})">Eliminar</x-danger-button>
                                                </td>
                                            </tr>
                                        @empty
                                            <tr class="bg-white border-b">
                                                <td colspan="4" class="px-6 py-4 text-center">
                                                    No hay préstamos registrados.
                                                </td>
                                            </tr>
                                        @endforelse
                                    </tbody>
                                </table>
                            </div>
                            <div class="mt-4">
                                {{ $prestamos->links() }}
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    {{-- Create or Edit Loan Modal --}}
    <x-dialog-modal wire:model="isModalOpen">
        <x-slot name="title">
            {{ $prestamoId ? 'Editar Préstamo' : 'Crear Nuevo Préstamo' }}
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
                <!-- Monto -->
                <div>
                    <x-label for="monto" value="Monto" />
                    <x-input id="monto" type="number" step="0.01" class="mt-1 block w-full" wire:model.defer="monto" />
                    <x-input-error for="monto" class="mt-2" />
                </div>
                <!-- Tasa de Interés -->
                <div>
                    <x-label for="tasa_interes" value="Tasa de Interés (%)" />
                    <x-input id="tasa_interes" type="number" step="0.01" class="mt-1 block w-full" wire:model.defer="tasa_interes" />
                    <x-input-error for="tasa_interes" class="mt-2" />
                </div>
                <!-- Plazo Meses -->
                <div>
                    <x-label for="plazo_meses" value="Plazo (meses)" />
                    <x-input id="plazo_meses" type="number" class="mt-1 block w-full" wire:model.defer="plazo_meses" />
                    <x-input-error for="plazo_meses" class="mt-2" />
                </div>
                <!-- Fecha Desembolso -->
                <div>
                    <x-label for="fecha_desembolso" value="Fecha de Desembolso" />
                    <x-input id="fecha_desembolso" type="date" class="mt-1 block w-full" wire:model.defer="fecha_desembolso" />
                    <x-input-error for="fecha_desembolso" class="mt-2" />
                </div>
                <!-- Estado -->
                <div>
                    <x-label for="estado" value="Estado" />
                    <select id="estado" class="border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm mt-1 block w-full" wire:model.defer="estado">
                        <option value="pendiente">Pendiente</option>
                        <option value="aprobado">Aprobado</option>
                        <option value="desembolsado">Desembolsado</option>
                        <option value="cancelado">Cancelado</option>
                        <option value="pagado">Pagado</option>
                    </select>
                    <x-input-error for="estado" class="mt-2" />
                </div>
                <!-- Observaciones -->
                <div class="md:col-span-2">
                    <x-label for="observaciones" value="Observaciones" />
                    <textarea id="observaciones" class="border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm mt-1 block w-full" wire:model.defer="observaciones"></textarea>
                    <x-input-error for="observaciones" class="mt-2" />
                </div>
            </div>
        </x-slot>

        <x-slot name="footer">
            <x-secondary-button wire:click="closeModal" wire:loading.attr="disabled">
                Cancelar
            </x-secondary-button>
            <x-button class="ml-3" wire:click="savePrestamo" wire:loading.attr="disabled">
                Guardar
            </x-button>
        </x-slot>
    </x-dialog-modal>

    {{-- Delete Loan Confirmation Modal --}}
    <x-dialog-modal wire:model="isConfirmingPrestamoDeletion">
        <x-slot name="title">
            ¿Eliminar Préstamo?
        </x-slot>
        <x-slot name="content">
            ¿Está seguro de que desea eliminar este préstamo? Esta acción no se puede deshacer.
        </x-slot>
        <x-slot name="footer">
            <x-secondary-button wire:click="closeDeleteConfirmationModal" wire:loading.attr="disabled">
                Cancelar
            </x-secondary-button>
            <x-danger-button class="ml-3" wire:click="deletePrestamo" wire:loading.attr="disabled">
                Eliminar Préstamo
            </x-danger-button>
        </x-slot>
    </x-dialog-modal>
</x-layouts.app>