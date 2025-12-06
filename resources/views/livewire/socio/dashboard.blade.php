<div>
    <h1 class="text-2xl font-semibold text-gray-900 dark:text-white">{{ __('app.Portal del Socio') }}</h1>

    <div class="mt-4 p-4 bg-blue-100 dark:bg-blue-900/50 rounded-lg shadow-md">
        <h2 class="text-xl font-semibold text-blue-800 dark:text-blue-200">{{ __('app.Bienvenido a tu Portal Personal') }}</h2>
        <p class="text-blue-700 dark:text-blue-300">{{ __('app.Aquí puedes gestionar tus datos, préstamos y ahorros.') }}</p>
    </div>

    @if(!$socio)
        <div class="mt-4 p-4 bg-red-100 dark:bg-red-900/50 rounded-lg shadow-md text-red-800 dark:text-red-200">
            {{ __('app.Tu cuenta de usuario no está asociada a ningún socio. Por favor, contacta con la administración.') }}
        </div>
    @else
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-4 mt-6">
            <!-- Card: Total de Préstamos -->
            <div class="bg-white dark:bg-gray-800/50 rounded-lg shadow-md p-4">
                <h3 class="text-lg font-semibold text-gray-800 dark:text-white">{{ __('app.Total de Préstamos') }}</h3>
                <p class="text-3xl font-bold text-indigo-600 dark:text-indigo-400 mt-2">{{ $totalLoans }}</p>
                <a href="{{ route('socio.my-loans') }}" class="text-sm text-blue-500 hover:underline mt-2 inline-block">{{ __('app.Ver Detalles') }}</a>
            </div>

            <!-- Card: Monto Pendiente de Préstamos -->
            <div class="bg-white dark:bg-gray-800/50 rounded-lg shadow-md p-4">
                <h3 class="text-lg font-semibold text-gray-800 dark:text-white">{{ __('app.Monto Pendiente de Préstamos') }}</h3>
                <p class="text-3xl font-bold text-red-600 dark:text-red-400 mt-2">RD${{ number_format($pendingLoansAmount, 2) }}</p>
                <a href="{{ route('socio.my-loans') }}" class="text-sm text-blue-500 hover:underline mt-2 inline-block">{{ __('app.Ver Detalles') }}</a>
            </div>

            <!-- Card: Total Cuentas de Ahorro -->
            <div class="bg-white dark:bg-gray-800/50 rounded-lg shadow-md p-4">
                <h3 class="text-lg font-semibold text-gray-800 dark:text-white">{{ __('app.Total de Cuentas de Ahorro') }}</h3>
                <p class="text-3xl font-bold text-green-600 dark:text-green-400 mt-2">{{ $totalSavings }}</p>
                <a href="{{ route('socio.my-savings') }}" class="text-sm text-blue-500 hover:underline mt-2 inline-block">{{ __('app.Ver Detalles') }}</a>
            </div>

            <!-- Card: Saldo Total de Ahorros Activos -->
            <div class="bg-white dark:bg-gray-800/50 rounded-lg shadow-md p-4">
                <h3 class="text-lg font-semibold text-gray-800 dark:text-white">{{ __('app.Saldo Total de Ahorros Activos') }}</h3>
                <p class="text-3xl font-bold text-teal-600 dark:text-teal-400 mt-2">RD${{ number_format($activeSavingsBalance, 2) }}</p>
                <a href="{{ route('socio.my-savings') }}" class="text-sm text-blue-500 hover:underline mt-2 inline-block">{{ __('app.Ver Detalles') }}</a>
            </div>

            <!-- Card: Mi Perfil -->
            <div class="bg-white dark:bg-gray-800/50 rounded-lg shadow-md p-4 flex flex-col justify-between">
                <div>
                    <h3 class="text-lg font-semibold text-gray-800 dark:text-white">{{ __('app.Tu Perfil') }}</h3>
                    <p class="text-sm text-gray-500 dark:text-gray-400 mt-2">Gestiona tu información personal.</p>
                </div>
                <a href="{{ route('socio.profile') }}" class="text-sm text-blue-500 hover:underline mt-4 inline-block">{{ __('app.Ver Detalles') }}</a>
            </div>
        </div>
    @endif
</div>