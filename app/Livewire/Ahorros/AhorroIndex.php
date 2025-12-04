<?php

namespace App\Livewire\Ahorros;

use App\Models\Ahorro;
use Livewire\Component;
use Livewire\WithPagination;
use Livewire\Attributes\On;

class AhorroIndex extends Component
{
    use WithPagination;

    public bool $showModal = false;
    public ?int $currentAhorroId = null;

    #[On('ahorro-saved')]
    public function closeModal(): void
    {
        $this->showModal = false;
        $this->currentAhorroId = null;
    }

    public function create(): void
    {
        $this->currentAhorroId = null;
        $this->showModal = true;
    }

    public function edit(int $ahorroId): void
    {
        $this->currentAhorroId = $ahorroId;
        $this->showModal = true;
    }

    public function delete(int $ahorroId): void
    {
        Ahorro::find($ahorroId)->delete();
    }

    public function render()
    {
        $ahorros = Ahorro::with('socio')->paginate(10);
        return view('livewire.ahorros.ahorro-index', [
            'ahorros' => $ahorros,
        ]);
    }
}
