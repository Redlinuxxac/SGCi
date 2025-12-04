<x-layouts.app :title="__('Diario Contable')">
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Diario Contable') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <h3 class="font-semibold text-lg mb-4">Asientos Registrados</h3>
                    
                    <div class="space-y-6">
                        @forelse ($asientos as $asiento)
                            <div class="border border-gray-200 rounded-lg p-4">
                                <div class="flex justify-between items-center mb-2">
                                    <div class="font-bold text-lg">{{ $asiento->descripcion }}</div>
                                    <div class="text-sm text-gray-600">{{ \Carbon\Carbon::parse($asiento->fecha)->format('d/m/Y') }}</div>
                                </div>
                                <div class="relative overflow-x-auto">
                                    <table class="w-full text-sm text-left text-gray-500">
                                        <thead class="text-xs text-gray-700 uppercase bg-gray-50">
                                            <tr>
                                                <th scope="col" class="px-6 py-2">Cuenta Contable</th>
                                                <th scope="col" class="px-6 py-2 text-right">Debe</th>
                                                <th scope="col" class="px-6 py-2 text-right">Haber</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ($asiento->movimientos as $movimiento)
                                                <tr class="bg-white border-b">
                                                    <td class="px-6 py-3">
                                                        {{ $movimiento->cuentaContable->codigo }} - {{ $movimiento->cuentaContable->nombre }}
                                                    </td>
                                                    <td class="px-6 py-3 text-right">
                                                        {{ $movimiento->debe ? number_format($movimiento->debe, 2) : '' }}
                                                    </td>
                                                    <td class="px-6 py-3 text-right">
                                                        {{ $movimiento->haber ? number_format($movimiento->haber, 2) : '' }}
                                                    </td>
                                                </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        @empty
                            <div class="text-center py-8">
                                <p>No hay asientos contables registrados.</p>
                            </div>
                        @endforelse
                    </div>

                    <div class="mt-4">
                        {{ $asientos->links() }}
                    </div>

                </div>
            </div>
        </div>
    </div>

</x-layouts.app>