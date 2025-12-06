<div>
    <h1 class="text-2xl font-semibold text-gray-900 dark:text-white">{{ __('app.Pagar Préstamo') }} #{{ $loan->id }}</h1>

    <div class="mt-4 p-4 bg-blue-100 dark:bg-blue-900/50 rounded-lg shadow-md">
        <p class="text-blue-700 dark:text-blue-300">
            {{ __('app.¿Estás seguro de que quieres pagar este préstamo? Se marcarán todas las cuotas pendientes como pagadas.') }}
        </p>
    </div>

    <div class="mt-6">
        <button wire:click="payLoan" class="w-full inline-flex justify-center rounded-md border border-transparent shadow-sm px-4 py-2 bg-green-600 text-base font-medium text-white hover:bg-green-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-green-500 sm:w-auto sm:text-sm">
            {{ __('app.Confirmar Pago') }}
        </button>
        <a href="{{ route('socio.my-loans') }}" class="ml-4 text-gray-700 dark:text-gray-300">{{ __('app.Cancelar') }}</a>
    </div>
</div>
