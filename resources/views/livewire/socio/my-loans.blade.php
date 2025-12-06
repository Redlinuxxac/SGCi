<div>
    <h1 class="text-2xl font-semibold text-gray-900 dark:text-white">{{ __('app.Mis Préstamos') }}</h1>

    @if (session()->has('message'))
        <div class="mt-4 p-4 bg-green-100 dark:bg-green-900/50 rounded-lg shadow-md text-green-800 dark:text-green-200">
            {{ session('message') }}
        </div>
    @endif

    <div class="mt-4 p-4 bg-blue-100 dark:bg-gray-700 rounded-lg shadow-md">
        <p class="text-blue-700 dark:text-blue-300">{{ __('app.Listado de todos tus préstamos actuales e históricos.') }}</p>
    </div>

    @if(!$socio)
        <div class="mt-4 p-4 bg-red-100 dark:bg-red-900/50 rounded-lg shadow-md text-red-800 dark:text-red-200">
            {{ __('app.Tu cuenta de usuario no está asociada a ningún socio. Por favor, contacta con la administración.') }}
        </div>
    @elseif($socio->prestamos->isEmpty())
        <div class="mt-4 p-4 bg-yellow-100 dark:bg-gray-800 rounded-lg shadow-md text-yellow-800 dark:text-yellow-200">
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
                                    <a href="{{ route('socio.my-loans.pay', ['loan' => $loan->id]) }}" class="ml-4 text-green-600 hover:text-green-900 dark:text-green-400 dark:hover:text-green-200">{{ __('app.Pagar Préstamo') }}</a>
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
</div>