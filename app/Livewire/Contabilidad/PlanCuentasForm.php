<?php

namespace App\Livewire\Contabilidad;

use App\Models\CuentaContable;
use Livewire\Component;

class PlanCuentasForm extends Component
{
    public ?CuentaContable $cuenta = null;

    public $codigo = '';
    public $nombre = '';
    public $tipo = 'activo';
    public $padre_id = null;
    public $permite_transacciones = false;

    public $cuentasPadre = [];

    public function mount(?int $cuentaId = null): void
    {
        $this->cuentasPadre = CuentaContable::where('permite_transacciones', false)->orderBy('codigo')->get();

        if ($cuentaId) {
            $this->cuenta = CuentaContable::find($cuentaId);
            $this->codigo = $this->cuenta->codigo;
            $this->nombre = $this->cuenta->nombre;
            $this->tipo = $this->cuenta->tipo;
            $this->padre_id = $this->cuenta->padre_id;
            $this->permite_transacciones = $this->cuenta->permite_transacciones;
        }
    }

    public function save(): void
    {
        $validatedData = $this->validate([
            'codigo' => 'required|string|unique:cuenta_contables,codigo,' . ($this->cuenta ? $this->cuenta->id : 'NULL'),
            'nombre' => 'required|string|max:255',
            'tipo' => 'required|in:activo,pasivo,patrimonio,ingresos,costos,gastos',
            'padre_id' => 'nullable|exists:cuenta_contables,id',
            'permite_transacciones' => 'required|boolean',
        ]);
        
        if ($this->cuenta) {
            $this->cuenta->update($validatedData);
        } else {
            CuentaContable::create($validatedData);
        }

        $this->dispatch('cuenta-saved');
    }

    public function render()
    {
        return view('livewire.contabilidad.plan-cuentas-form');
    }
}