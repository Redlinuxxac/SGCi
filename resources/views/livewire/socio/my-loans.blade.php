<div>
    <h1 class="text-2xl font-semibold text-gray-900 dark:text-white">{{ __('app.Mis Préstamos') }}</h1>

    @if (session()->has('message'))
        <div class="mt-4 p-4 bg-green-100 dark:bg-green-900/50 rounded-lg shadow-md text-green-800 dark:text-green-200">
            {{ session('message') }}
        </div>
    @endif

    <div class="mt-4 p-4 bg-blue-100 dark:bg-blue-900/50 rounded-lg shadow-md">
        <p class="text-blue-700 dark:text-blue-300">{{ __('app.Listado de todos tus préstamos actuales e históricos.') }}</p>
    </div>

    @if(!$socio)
        <div class="mt-4 p-4 bg-red-100 dark:bg-red-900/50 rounded-lg shadow-md text-red-800 dark:text-red-200">
            {{ __('app.Tu cuenta de usuario no está asociada a ningún socio. Por favor, contacta con la administración.') }}
        </div>
    @elseif($socio->prestamos->isEmpty())
        <div class="mt-4 p-4 bg-yellow-100 dark:bg-yellow-900/50 rounded-lg shadow-md text-yellow-800 dark:text-yellow-200">
            {{ __('app.No tienes préstamos registrados.') }}
        </div>
    @else
        <div class="overflow-x-auto mt-6">
            <table class="min-w-full divide-y divide-gray-200 dark:divide-gray-700">
                <thead class="bg-gray-50 dark:bg-gray-800">
                    <tr>
                        <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider dark:text-gray-300">
                            {{ __('app.ID de Préstamo') }}
                        </th>
                        <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider dark:text-gray-300">
                            {{ __('app.Monto Solicitado') }}
                        </th>
                        <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider dark:text-gray-300">
                            {{ __('app.Tasa de Interés') }}
                        </th>
                        <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider dark:text-gray-300">
                            {{ __('app.Plazo (Meses)') }}
                        </th>
                        <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider dark:text-gray-300">
                            {{ __('app.Fecha de Desembolso') }}
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
                    @foreach ($loans as $loan)
                        <tr>
                            <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900 dark:text-white">
                                {{ $loan->id }}
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500 dark:text-gray-300">
                                RD${{ number_format($loan->monto, 2) }}
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500 dark:text-gray-300">
                                {{ $loan->tasa_interes }}%
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500 dark:text-gray-300">
                                {{ $loan->plazo_meses }} {{ __('app.meses') }}
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500 dark:text-gray-300">
                                {{ $loan->fecha_desembolso }}
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500 dark:text-gray-300">
                                <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full 
                                    @switch($loan->estado)
                                        @case('aprobado') bg-blue-100 text-blue-800 @break
                                        @case('desembolsado') bg-green-100 text-green-800 @break
                                        @case('pagado') bg-gray-100 text-gray-800 @break
                                        @case('cancelado') bg-red-100 text-red-800 @break
                                        @default bg-yellow-100 text-yellow-800
                                    @endswitch
                                ">
                                    {{ __('app.' . $loan->estado) }}
                                </span>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-right text-sm font-medium">
                                <a href="{{ route('socio.my-loans.installments', ['loan' => $loan->id]) }}" class="text-indigo-600 hover:text-indigo-900 dark:text-indigo-400 dark:hover:text-indigo-200">{{ __('app.Ver Cuotas') }}</a>
                                @if ($loan->estado != 'pagado')
                                    <button wire:click="showPayLoanModal({{ $loan->id }})" wire:loading.attr="disabled" class="ml-4 text-green-600 hover:text-green-900 dark:text-green-400 dark:hover:text-green-200">
                                        <span wire:loading.remove wire:target="showPayLoanModal({{ $loan->id }})">{{ __('app.Pagar Préstamo') }}</span>
                                        <span wire:loading wire:target="showPayLoanModal({{ $loan->id }})">{{ __('app.Cargando...') }}</span>
                                    </button>
                                @endif
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>

        <div class="mt-4">
            {{ $loans->links() }}
        </div>
    @endif

    <!-- Pay Loan Modal -->
    @if ($showPayLoanModal)
        <div class="fixed z-10 inset-0 overflow-y-auto" aria-labelledby="modal-title" role="dialog" aria-modal="true">
            <div class="flex items-end justify-center min-h-screen pt-4 px-4 pb-20 text-center sm:block sm:p-0">
                <div class="fixed inset-0 bg-gray-500 bg-opacity-75 transition-opacity" aria-hidden="true"></div>

                <span class="hidden sm:inline-block sm:align-middle sm:h-screen" aria-hidden="true">&#8203;</span>

                <div class="inline-block align-bottom bg-white dark:bg-gray-800 rounded-lg text-left overflow-hidden shadow-xl transform transition-all sm:my-8 sm:align-middle sm:max-w-lg sm:w-full">
                    <div class="bg-white dark:bg-gray-800 px-4 pt-5 pb-4 sm:p-6 sm:pb-4">
                        <div class="sm:flex sm:items-start">
                            <div class="mx-auto flex-shrink-0 flex items-center justify-center h-12 w-12 rounded-full bg-green-100 sm:mx-0 sm:h-10 sm:w-10">
                                <svg class="h-6 w-6 text-green-600" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor" aria-hidden="true">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z" />
                                </svg>
                            </div>
                            <div class="mt-3 text-center sm:mt-0 sm:ml-4 sm:text-left">
                                <h3 class="text-lg leading-6 font-medium text-gray-900 dark:text-white" id="modal-title">
                                    {{ __('app.Pagar Préstamo') }}
                                </h3>
                                <div class="mt-2">
                                    <p class="text-sm text-gray-500 dark:text-gray-300">
                                        {{ __('app.¿Estás seguro de que quieres pagar este préstamo? Se marcarán todas las cuotas pendientes como pagadas.') }}
                                    </p>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="bg-gray-50 dark:bg-gray-700 px-4 py-3 sm:px-6 sm:flex sm:flex-row-reverse">
                        <button wire:click="payLoan" wire:loading.attr="disabled" type="button" class="w-full inline-flex justify-center rounded-md border border-transparent shadow-sm px-4 py-2 bg-green-600 text-base font-medium text-white hover:bg-green-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-green-500 sm:ml-3 sm:w-auto sm:text-sm">
                            <span wire:loading.remove wire:target="payLoan">{{ __('app.Confirmar Pago') }}</span>
                            <span wire:loading wire:target="payLoan">{{ __('app.Procesando...') }}</span>
                        </button>
                        <button wire:click="$set('showPayLoanModal', false)" type="button" class="mt-3 w-full inline-flex justify-center rounded-md border border-gray-300 dark:border-gray-600 shadow-sm px-4 py-2 bg-white dark:bg-gray-800 text-base font-medium text-gray-700 dark:text-gray-200 hover:bg-gray-50 dark:hover:bg-gray-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 sm:mt-0 sm:ml-3 sm:w-auto sm:text-sm">
                            {{ __('app.Cancelar') }}
                        </button>
                    </div>
                </div>
            </div>
        </div>
    @endif
</div>