<div>
    <h1 class="text-2xl font-semibold text-gray-900 dark:text-white">{{ __('app.Mis Ahorros') }}</h1>

    <div class="mt-4 p-4 bg-blue-100 dark:bg-blue-900/50 rounded-lg shadow-md">
        <p class="text-blue-700 dark:text-blue-300">{{ __('app.Listado de todas tus cuentas de ahorro.') }}</p>
    </div>

    @if(!$socio)
        <div class="mt-4 p-4 bg-red-100 dark:bg-red-900/50 rounded-lg shadow-md text-red-800 dark:text-red-200">
            {{ __('app.Tu cuenta de usuario no está asociada a ningún socio. Por favor, contacta con la administración.') }}
        </div>
    @elseif($savings->isEmpty())
        <div class="mt-4 p-4 bg-yellow-100 dark:bg-yellow-900/50 rounded-lg shadow-md text-yellow-800 dark:text-yellow-200">
            {{ __('app.No tienes cuentas de ahorro registradas.') }}
        </div>
    @else
        <div class="overflow-x-auto mt-6">
            <table class="min-w-full divide-y divide-gray-200 dark:divide-gray-700">
                <thead class="bg-gray-50 dark:bg-gray-800">
                    <tr>
                        <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider dark:text-gray-300">
                            {{ __('app.ID de Cuenta') }}
                        </th>
                        <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider dark:text-gray-300">
                            {{ __('app.Tipo de Cuenta') }}
                        </th>
                        <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider dark:text-gray-300">
                            {{ __('app.Saldo Actual') }}
                        </th>
                        <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider dark:text-gray-300">
                            {{ __('app.Fecha de Apertura') }}
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
                    @foreach ($savings as $saving)
                        <tr>
                            <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900 dark:text-white">
                                {{ $saving->id }}
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500 dark:text-gray-300">
                                {{ __('ahorros.' . $saving->tipo_cuenta) }}
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500 dark:text-gray-300">
                                RD${{ number_format($saving->saldo, 2) }}
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500 dark:text-gray-300">
                                {{ $saving->fecha_apertura }}
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500 dark:text-gray-300">
                                <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full 
                                    @if ($saving->estado == 'activa')
                                        bg-green-100 text-green-800
                                    @elseif ($saving->estado == 'inactiva')
                                        bg-yellow-100 text-yellow-800
                                    @else
                                        bg-red-100 text-red-800
                                    @endif
                                ">
                                    {{ __('app.' . $saving->estado) }}
                                </span>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-right text-sm font-medium">
                                <button class="text-indigo-600 hover:text-indigo-900 dark:text-indigo-400 dark:hover:text-indigo-200">{{ __('app.Ver Detalles') }}</button>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>

        <div class="mt-4">
            {{ $savings->links() }}
        </div>
    @endif
</div>