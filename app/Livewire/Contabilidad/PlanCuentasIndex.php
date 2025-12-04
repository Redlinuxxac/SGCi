<?php

namespace App\Livewire\Contabilidad;

use App\Models\CuentaContable;
use Livewire\Component;
use Livewire\Attributes\On;

class PlanCuentasIndex extends Component
{
    public bool $showModal = false;
    public ?int $currentCuentaId = null;

    #[On('cuenta-saved')]
    public function closeModal(): void
    {
        $this->showModal = false;
        $this->currentCuentaId = null;
    }

    public function create(): void
    {
        $this->currentCuentaId = null;
        $this->showModal = true;
    }

    public function edit(int $cuentaId): void
    {
        $this->currentCuentaId = $cuentaId;
        $this->showModal = true;
    }

    public function render()
    {
        $cuentas = CuentaContable::orderBy('codigo')->get();
        return view('livewire.contabilidad.plan-cuentas-index', [
            'cuentas' => $cuentas,
        ]);
    }
}
