<x-layouts.app :title="__('Gestión de Socios')">
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Gestión de Socios') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">

                <!-- Actions and Stats Column -->
                <div class="lg:col-span-1 space-y-6">
                    <!-- Actions Card -->
                    <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                        <div class="p-6 text-gray-900">
                            <h3 class="font-semibold text-lg mb-4">Acciones</h3>
                            <x-button wire:click="openModal()" class="w-full justify-center">
                                Crear Socio
                            </x-button>
                        </div>
                    </div>

                    <!-- Stats Card Placeholder -->
                    <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                        <div class="p-6 text-gray-900">
                            <h3 class="font-semibold text-lg mb-4">Estadísticas</h3>
                            <p class="text-sm text-gray-600">Total de socios: {{ $socios->total() }}</p>
                        </div>
                    </div>
                </div>

                <!-- Main Table Column -->
                <div class="lg:col-span-2">
                    <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                        <div class="p-6 text-gray-900">
                            <h3 class="font-semibold text-lg mb-4">Lista de Socios</h3>
                            <div class="relative overflow-x-auto">
                                <table class="w-full text-sm text-left text-gray-500">
                                    <thead class="text-xs text-gray-700 uppercase bg-gray-50">
                                        <tr>
                                            <th scope="col" class="px-6 py-3">Nombre</th>
                                            <th scope="col" class="px-6 py-3">Cédula</th>
                                            <th scope="col" class="px-6 py-3">Estado</th>
                                            <th scope="col" class="px-6 py-3">Acciones</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @forelse ($socios as $socio)
                                            <tr class="bg-white border-b">
                                                <th scope="row" class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap">
                                                    {{ $socio->nombres }} {{ $socio->apellidos }}
                                                </th>
                                                <td class="px-6 py-4">{{ $socio->cedula }}</td>
                                                <td class="px-6 py-4">{{ $socio->estado }}</td>
                                                <td class="px-6 py-4 space-x-2">
                                                    <x-button wire:click="openModal({{ $socio->id }})">Editar</x-button>
                                                    <x-danger-button wire:click="confirmSocioDeletion({{ $socio->id }})">Eliminar</x-danger-button>
                                                </td>
                                            </tr>
                                        @empty
                                            <tr class="bg-white border-b">
                                                <td colspan="4" class="px-6 py-4 text-center">
                                                    No hay socios registrados.
                                                </td>
                                            </tr>
                                        @endforelse
                                    </tbody>
                                </table>
                            </div>

                            <div class="mt-4">
                                {{ $socios->links() }}
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    {{-- Create or Edit Socio Modal --}}
    <x-dialog-modal wire:model="isModalOpen">
        <x-slot name="title">
            {{ $socioId ? 'Editar Socio' : 'Crear Nuevo Socio' }}
        </x-slot>

        <x-slot name="content">
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <!-- Nombres -->
                <div>
                    <x-label for="nombres" value="Nombres" />
                    <x-input id="nombres" type="text" class="mt-1 block w-full" wire:model.defer="nombres" />
                    <x-input-error for="nombres" class="mt-2" />
                </div>
                <!-- Apellidos -->
                <div>
                    <x-label for="apellidos" value="Apellidos" />
                    <x-input id="apellidos" type="text" class="mt-1 block w-full" wire:model.defer="apellidos" />
                    <x-input-error for="apellidos" class="mt-2" />
                </div>
                <!-- Cédula -->
                <div>
                    <x-label for="cedula" value="Cédula" />
                    <x-input id="cedula" type="text" class="mt-1 block w-full" wire:model.defer="cedula" />
                    <x-input-error for="cedula" class="mt-2" />
                </div>
                <!-- Fecha de Ingreso -->
                <div>
                    <x-label for="fecha_ingreso" value="Fecha de Ingreso" />
                    <x-input id="fecha_ingreso" type="date" class="mt-1 block w-full" wire:model.defer="fecha_ingreso" />
                    <x-input-error for="fecha_ingreso" class="mt-2" />
                </div>
                <!-- Teléfono -->
                <div>
                    <x-label for="telefono" value="Teléfono" />
                    <x-input id="telefono" type="text" class="mt-1 block w-full" wire:model.defer="telefono" />
                    <x-input-error for="telefono" class="mt-2" />
                </div>
                <!-- Dirección -->
                <div>
                    <x-label for="direccion" value="Dirección" />
                    <x-input id="direccion" type="text" class="mt-1 block w-full" wire:model.defer="direccion" />
                    <x-input-error for="direccion" class="mt-2" />
                </div>
            </div>
        </x-slot>

        <x-slot name="footer">
            <x-secondary-button wire:click="closeModal" wire:loading.attr="disabled">
                Cancelar
            </x-secondary-button>
            <x-button class="ml-3" wire:click="saveSocio" wire:loading.attr="disabled">
                Guardar
            </x-button>
        </x-slot>
    </x-dialog-modal>

    {{-- Delete Socio Confirmation Modal --}}
    <x-dialog-modal wire:model="isConfirmingSocioDeletion">
        <x-slot name="title">
            ¿Eliminar Socio?
        </x-slot>
        <x-slot name="content">
            ¿Está seguro de que desea eliminar este socio? Esta acción no se puede deshacer.
        </x-slot>
        <x-slot name="footer">
            <x-secondary-button wire:click="closeDeleteConfirmationModal" wire:loading.attr="disabled">
                Cancelar
            </x-secondary-button>
            <x-danger-button class="ml-3" wire:click="deleteSocio" wire:loading.attr="disabled">
                Eliminar Socio
            </x-danger-button>
        </x-slot>
    </x-dialog-modal>
</x-layouts.app>
