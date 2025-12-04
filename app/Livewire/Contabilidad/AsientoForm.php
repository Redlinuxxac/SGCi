<?php

namespace App\Livewire\Contabilidad;

use App\Models\AsientoContable;
use App\Models\CuentaContable;
use App\Models\Movimiento;
use Illuminate\Support\Facades\DB;
use Livewire\Component;

class AsientoForm extends Component
{
    public ?AsientoContable $asiento = null;
    public bool $isReadOnly = false;

    // Asiento fields
    public $fecha = '';
    public $descripcion = '';
    public $estado = 'borrador';

    // Movimientos
    public $movimientos = [];
    public $cuentas = [];

    public function mount(?int $asientoId = null): void
    {
        $this->cuentas = CuentaContable::where('permite_transacciones', true)->orderBy('codigo')->get();
        $this->fecha = today()->format('Y-m-d');

        if ($asientoId) {
            $this->asiento = AsientoContable::with('movimientos.cuenta')->find($asientoId);
            $this->fecha = $this->asiento->fecha;
            $this->descripcion = $this->asiento->descripcion;
            $this->estado = $this->asiento->estado;
            
            foreach ($this->asiento->movimientos as $mov) {
                $this->movimientos[] = [
                    'cuenta_contable_id' => $mov->cuenta_contable_id,
                    'debe' => $mov->debe,
                    'haber' => $mov->haber,
                    'descripcion' => $mov->descripcion,
                ];
            }
            $this->isReadOnly = true;
        } else {
            // Start with two empty rows
            $this->movimientos = [
                ['cuenta_contable_id' => '', 'debe' => '', 'haber' => '', 'descripcion' => ''],
                ['cuenta_contable_id' => '', 'debe' => '', 'haber' => '', 'descripcion' => ''],
            ];
        }
    }

    public function addMovimiento(): void
    {
        $this->movimientos[] = ['cuenta_contable_id' => '', 'debe' => '', 'haber' => '', 'descripcion' => ''];
    }

    public function removeMovimiento(int $index): void
    {
        unset($this->movimientos[$index]);
        $this->movimientos = array_values($this->movimientos); // re-index
    }

    public function save(): void
    {
        if ($this->isReadOnly) return;

        $validatedData = $this->validate([
            'fecha' => 'required|date',
            'descripcion' => 'required|string|max:255',
            'movimientos' => 'required|array|min:2',
            'movimientos.*.cuenta_contable_id' => 'required|exists:cuenta_contables,id',
            'movimientos.*.debe' => 'nullable|numeric|min:0',
            'movimientos.*.haber' => 'nullable|numeric|min:0',
            'movimientos.*.descripcion' => 'nullable|string',
        ]);
        
        $totalDebe = collect($this->movimientos)->sum('debe');
        $totalHaber = collect($this->movimientos)->sum('haber');

        if (number_format($totalDebe, 2) !== number_format($totalHaber, 2)) {
            $this->addError('balance', 'El total de Débitos debe ser igual al total de Créditos.');
            return;
        }

        if ($totalDebe == 0) {
            $this->addError('balance', 'El asiento no puede tener un valor de cero.');
            return;
        }

        DB::transaction(function () use ($validatedData) {
            $asiento = AsientoContable::create([
                'fecha' => $validatedData['fecha'],
                'descripcion' => $validatedData['descripcion'],
                'estado' => 'confirmado', // Or 'borrador' and add a confirm step
            ]);

            foreach ($this->movimientos as $mov) {
                $asiento->movimientos()->create([
                    'cuenta_contable_id' => $mov['cuenta_contable_id'],
                    'debe' => $mov['debe'] ?: null,
                    'haber' => $mov['haber'] ?: null,
                    'descripcion' => $mov['descripcion'],
                ]);
            }
        });

        $this->dispatch('asiento-saved');
    }

    public function render()
    {
        return view('livewire.contabilidad.asiento-form');
    }
}