<div>
    <h1 class="text-2xl font-semibold text-gray-900 dark:text-white">{{ __('contabilidad.chart_of_accounts_title') }}</h1>

    <div class="py-4">
        @can('cuentas_contables.create')
        <div class="flex justify-end">
            <button wire:click="create" class="btn btn-primary">
                <x-flux::icon name="plus" class="h-5 w-5" />
                <span>{{ __('contabilidad.create_account_button') }}</span>
            </button>
        </div>
        @endcan
    </div>

    <div class="overflow-x-auto">
        <table class="min-w-full divide-y divide-gray-200 dark:divide-gray-700">
            <thead class="bg-gray-50 dark:bg-gray-800">
                <tr>
                    <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider dark:text-gray-300">
                        {{ __('contabilidad.table_header_code') }}
                    </th>
                    <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider dark:text-gray-300">
                        {{ __('app.Nombre') }}
                    </th>
                    <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider dark:text-gray-300">
                        {{ __('contabilidad.table_header_type') }}
                    </th>
                    <th scope="col" class="relative px-6 py-3">
                        <span class="sr-only">{{ __('app.Acciones') }}</span>
                    </th>
                </tr>
            </thead>
            <tbody class="bg-white divide-y divide-gray-200 dark:bg-gray-900 dark:divide-gray-700">
                @forelse ($cuentas as $cuenta)
                    <tr wire:key="{{ $cuenta->id }}">
                        <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900 dark:text-white">
                            {{ $cuenta->codigo }}
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500 dark:text-gray-300">
                            {{ $cuenta->nombre }}
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500 dark:text-gray-300">
                            {{ __('contabilidad.' . $cuenta->tipo) }}
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap text-right text-sm font-medium">
                            @can('cuentas_contables.edit')
                            <button wire:click="edit({{ $cuenta->id }})" class="btn btn-secondary">{{ __('app.Editar') }}</button>
                            @endcan
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="4" class="px-6 py-4 whitespace-nowrap text-sm text-gray-500 text-center">
                            {{ __('contabilidad.no_accounting_accounts') }}
                        </td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    @if($showModal)
        <div class="fixed inset-0 bg-gray-900 bg-opacity-50 flex items-center justify-center">
            <div class="bg-white dark:bg-gray-800 p-8 rounded-lg shadow-lg w-full max-w-2xl">
                <livewire:contabilidad.plan-cuentas-form :cuentaId="$currentCuentaId" />
            </div>
        </div>
    @endif
</div>