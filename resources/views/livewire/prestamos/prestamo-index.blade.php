<div>
    <h1 class="text-2xl font-semibold text-gray-900 dark:text-white">{{ __('prestamos.management_title') }}</h1>

    <div class="py-4">
        @can('prestamos.create')
        <div class="flex justify-end">
            <button wire:click="create" class="btn btn-primary">
                <x-flux::icon name="plus" class="h-5 w-5" />
                <span>{{ __('prestamos.create_button') }}</span>
            </button>
        </div>
        @endcan
    </div>

    <div class="overflow-x-auto">
        <table class="min-w-full divide-y divide-gray-200 dark:divide-gray-700">
            <thead class="bg-gray-50 dark:bg-gray-800">
                <tr>
                    <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider dark:text-gray-300">
                        {{ __('prestamos.table_header_member') }}
                    </th>
                    <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider dark:text-gray-300">
                        {{ __('prestamos.table_header_amount') }}
                    </th>
                    <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider dark:text-gray-300">
                        {{ __('prestamos.table_header_rate') }}
                    </th>
                    <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider dark:text-gray-300">
                        {{ __('prestamos.table_header_term') }}
                    </th>
                    <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider dark:text-gray-300">
                        {{ __('app.Estado') }}
                    </th>
                    <th scope="col" class="relative px-6 py-3">
                        <span class="sr-only">{{ __('app.Acciones') }}</span>
                    </th>
                </tr>
            </thead>
            <tbody class="bg-white divide-y divide-gray-200 dark:bg-gray-900 dark:divide-gray-700">
                @forelse ($prestamos as $prestamo)
                    <tr wire:key="{{ $prestamo->id }}">
                        <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900 dark:text-white">
                            {{ $prestamo->socio->nombres ?? 'N/A' }} {{ $prestamo->socio->apellidos ?? '' }}
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500 dark:text-gray-300">
                            {{ number_format($prestamo->monto, 2) }}
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500 dark:text-gray-300">
                            {{ $prestamo->tasa_interes }}%
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500 dark:text-gray-300">
                            {{ $prestamo->plazo_meses }} {{ __('app.meses') }}
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500 dark:text-gray-300">
                            <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full 
                                @switch($prestamo->estado)
                                    @case('aprobado') bg-blue-100 text-blue-800 @break
                                    @case('desembolsado') bg-green-100 text-green-800 @break
                                    @case('pagado') bg-gray-100 text-gray-800 @break
                                    @case('cancelado') bg-red-100 text-red-800 @break
                                    @default bg-yellow-100 text-yellow-800
                                @endswitch
                            ">
                                {{ __('app.' . $prestamo->estado) }}
                            </span>
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap text-right text-sm font-medium">
                            @can('prestamos.edit')
                            <button wire:click="edit({{ $prestamo->id }})" class="btn btn-secondary">{{ __('app.Editar') }}</button>
                            @endcan
                            @can('prestamos.delete')
                            <button wire:click="delete({{ $prestamo->id }})" wire:confirm="{{ __('prestamos.confirm_delete') }}" class="btn btn-danger ml-2">{{ __('app.Eliminar') }}</button>
                            @endcan
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="6" class="px-6 py-4 whitespace-nowrap text-sm text-gray-500 text-center">
                            {{ __('prestamos.no_records') }}
                        </td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    <div class="mt-4">
        {{ $prestamos->links() }}
    </div>

    @if($showModal)
        <div class="fixed inset-0 bg-gray-900 bg-opacity-50 flex items-center justify-center">
            <div class="bg-white dark:bg-gray-800 p-8 rounded-lg shadow-lg w-full max-w-2xl">
                <livewire:prestamos.prestamo-form :prestamoId="$currentPrestamoId" />
            </div>
        </div>
    @endif
</div>