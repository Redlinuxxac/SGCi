<?php

namespace App\Livewire\Contabilidad;

use App\Models\AsientoContable;
use Livewire\Component;
use Livewire\WithPagination;
use Livewire\Attributes\On;

class AsientoIndex extends Component
{
    use WithPagination;

    public bool $showModal = false;
    public ?int $currentAsientoId = null;

    #[On('asiento-saved')]
    public function closeModal(): void
    {
        $this->showModal = false;
        $this->currentAsientoId = null;
    }

    public function create(): void
    {
        $this->currentAsientoId = null;
        $this->showModal = true;
    }

    public function view(int $asientoId): void
    {
        $this->currentAsientoId = $asientoId;
        $this->showModal = true;
    }

    public function render()
    {
        $asientos = AsientoContable::latest()->paginate(10);
        return view('livewire.contabilidad.asiento-index', [
            'asientos' => $asientos,
        ]);
    }
}
