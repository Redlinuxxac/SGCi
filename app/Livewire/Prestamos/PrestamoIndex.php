<?php

namespace App\Livewire\Prestamos;

use App\Models\Prestamo;
use Livewire\Component;
use Livewire\WithPagination;
use Livewire\Attributes\On;

class PrestamoIndex extends Component
{
    use WithPagination;

    public bool $showModal = false;
    public ?int $currentPrestamoId = null;

    #[On('prestamo-saved')]
    public function closeModal(): void
    {
        $this->showModal = false;
        $this->currentPrestamoId = null;
    }

    public function create(): void
    {
        $this->currentPrestamoId = null;
        $this->showModal = true;
    }

    public function edit(int $prestamoId): void
    {
        $this->currentPrestamoId = $prestamoId;
        $this->showModal = true;
    }

    public function delete(int $prestamoId): void
    {
        Prestamo::find($prestamoId)->delete();
    }

    public function render()
    {
        $prestamos = Prestamo::with('socio')->paginate(10);
        return view('livewire.prestamos.prestamo-index', [
            'prestamos' => $prestamos,
        ]);
    }
}
