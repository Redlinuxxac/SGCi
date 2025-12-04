<?php

namespace App\Listeners;

use App\Events\PrestamoDesembolsado;
use App\Models\AsientoContable;
use App\Models\CuentaContable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class RegistrarAsientoContablePorDesembolso
{
    /**
     * Create the event listener.
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     */
    public function handle(PrestamoDesembolsado $event): void
    {
        $prestamo = $event->prestamo;

        DB::transaction(function () use ($prestamo) {
            $cuentaPrestamosPorCobrar = CuentaContable::where('codigo', '1.1.02')->first();
            $cuentaBanco = CuentaContable::where('codigo', '1.1.01')->first();

            if (!$cuentaPrestamosPorCobrar || !$cuentaBanco) {
                Log::error('Cuentas contables para desembolso de préstamo no encontradas.');
                // Optionally, throw an exception to fail the job if this listener is queued
                return;
            }

            // 1. Create the Journal Entry Header
            $asiento = AsientoContable::create([
                'fecha' => $prestamo->fecha_desembolso,
                'descripcion' => "Desembolso de préstamo #{$prestamo->id} al socio {$prestamo->socio->nombres} {$prestamo->socio->apellidos}",
                'referencia_id' => $prestamo->id,
                'referencia_type' => get_class($prestamo),
                'estado' => 'confirmado',
            ]);

            // 2. Create the Debit Movement
            $asiento->movimientos()->create([
                'cuenta_contable_id' => $cuentaPrestamosPorCobrar->id,
                'debe' => $prestamo->monto,
                'haber' => null,
            ]);

            // 3. Create the Credit Movement
            $asiento->movimientos()->create([
                'cuenta_contable_id' => $cuentaBanco->id,
                'debe' => null,
                'haber' => $prestamo->monto,
            ]);
        });
    }
}
