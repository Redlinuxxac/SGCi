<div>
    <h1 class="text-2xl font-semibold text-gray-900 dark:text-white">{{ __('app.Cuotas del Préstamo') }} #{{ $loan->id }}</h1>

    @if (session()->has('message'))
        <div class="mt-4 p-4 bg-green-100 dark:bg-green-900/50 rounded-lg shadow-md text-green-800 dark:text-green-200">
            {{ session('message') }}
        </div>
    @endif

    <div class="mt-4 p-4 bg-blue-100 dark:bg-blue-900/50 rounded-lg shadow-md">
        <p class="text-blue-700 dark:text-blue-300">{{ __('app.Listado de todas las cuotas de tu préstamo.') }}</p>
    </div>

    <div class="overflow-x-auto mt-6">
        <table class="min-w-full divide-y divide-gray-200 dark:divide-gray-700">
            <thead class="bg-gray-50 dark:bg-gray-800">
                <tr>
                    <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider dark:text-gray-300">
                        {{ __('app.Número de Cuota') }}
                    </th>
                    <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider dark:text-gray-300">
                        {{ __('app.Monto de la Cuota') }}
                    </th>
                    <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider dark:text-gray-300">
                        {{ __('app.Fecha de Vencimiento') }}
                    </th>
                    <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider dark:text-gray-300">
                        {{ __('app.Estado') }}
                    </th>
                    <th scope="col" class="relative px-6 py-3">
                        <span class="sr-only">{{ __('app.Acciones') }}</span>
                    </th>
                </tr>
            </thead>
            <tbody class="bg-white dark:bg-gray-900 divide-y divide-gray-200 dark:divide-gray-700">
                @foreach ($installments as $installment)
                    <tr>
                        <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900 dark:text-white">
                            {{ $installment->numero_cuota }}
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500 dark:text-gray-300">
                            RD${{ number_format($installment->monto, 2) }}
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500 dark:text-gray-300">
                            {{ $installment->fecha_vencimiento }}
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500 dark:text-gray-300">
                            <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full 
                                @if ($installment->estado == 'pagada')
                                    bg-green-100 text-green-800
                                @else
                                    bg-yellow-100 text-yellow-800
                                @endif
                            ">
                                {{ __('app.' . $installment->estado) }}
                            </span>
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap text-right text-sm font-medium">
                            @if ($installment->estado != 'pagada')
                                <button wire:click="payInstallment({{ $installment->id }})" class="text-indigo-600 hover:text-indigo-900 dark:text-indigo-400 dark:hover:text-indigo-200">{{ __('app.Pagar') }}</button>
                            @endif
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>

    <div class="mt-4">
        {{ $installments->links() }}
    </div>

    <div class="mt-6">
        <a href="{{ route('socio.my-loans') }}" class="text-indigo-600 hover:text-indigo-900 dark:text-indigo-400 dark:hover:text-indigo-200">
            &larr; {{ __('app.Volver a Mis Préstamos') }}
        </a>
    </div>
</div>
