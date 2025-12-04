<div>
    <h1 class="text-2xl font-semibold text-gray-900 dark:text-white">Gestión de Servicios Varios</h1>

    <div class="py-4">
        @can('servicios.create')
        <div class="flex justify-end">
            <button wire:click="create" class="btn btn-primary">
                <x-flux::icon name="plus" class="h-5 w-5" />
                <span>Crear Servicio</span>
            </button>
        </div>
        @endcan
    </div>

    <div class="overflow-x-auto">
        <table class="min-w-full divide-y divide-gray-200 dark:divide-gray-700">
            <thead class="bg-gray-50 dark:bg-gray-800">
                <tr>
                    <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider dark:text-gray-300">
                        Nombre
                    </th>
                    <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider dark:text-gray-300">
                        Descripción
                    </th>
                    <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider dark:text-gray-300">
                        Estado
                    </th>
                    <th scope="col" class="relative px-6 py-3">
                        <span class="sr-only">Acciones</span>
                    </th>
                </tr>
            </thead>
            <tbody class="bg-white divide-y divide-gray-200 dark:bg-gray-900 dark:divide-gray-700">
                @forelse ($servicios as $servicio)
                    <tr wire:key="{{ $servicio->id }}">
                        <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900 dark:text-white">
                            {{ $servicio->nombre }}
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500 dark:text-gray-300">
                            {{ Str::limit($servicio->descripcion, 50) }}
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500 dark:text-gray-300">
                            <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full 
                                @if ($servicio->estado == 'activo')
                                    bg-green-100 text-green-800
                                @else
                                    bg-yellow-100 text-yellow-800
                                @endif
                            ">
                                {{ $servicio->estado }}
                            </span>
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap text-right text-sm font-medium">
                            @can('servicios.edit')
                            <button wire:click="edit({{ $servicio->id }})" class="btn btn-secondary">Editar</button>
                            @endcan
                            @can('servicios.delete')
                            <button wire:click="delete({{ $servicio->id }})" wire:confirm="¿Está seguro de que desea eliminar este servicio?" class="btn btn-danger ml-2">Eliminar</button>
                            @endcan
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="4" class="px-6 py-4 whitespace-nowrap text-sm text-gray-500 text-center">
                            No hay servicios registrados.
                        </td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    <div class="mt-4">
        {{ $servicios->links() }}
    </div>

    @if($showModal)
        <div class="fixed inset-0 bg-gray-900 bg-opacity-50 flex items-center justify-center">
            <div class="bg-white dark:bg-gray-800 p-8 rounded-lg shadow-lg w-full max-w-2xl">
                <livewire:servicios.servicio-form :servicioId="$currentServicioId" />
            </div>
        </div>
    @endif
</div>