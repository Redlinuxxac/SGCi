<?php

namespace App\Livewire\Servicios;

use App\Models\Servicio;
use Livewire\Component;
use Livewire\WithPagination;
use Livewire\Attributes\On;

class ServicioIndex extends Component
{
    use WithPagination;

    public bool $showModal = false;
    public ?int $currentServicioId = null;

    #[On('servicio-saved')]
    public function closeModal(): void
    {
        $this->showModal = false;
        $this->currentServicioId = null;
    }

    public function create(): void
    {
        $this->currentServicioId = null;
        $this->showModal = true;
    }

    public function edit(int $servicioId): void
    {
        $this->currentServicioId = $servicioId;
        $this->showModal = true;
    }

    public function delete(int $servicioId): void
    {
        Servicio::find($servicioId)->delete();
    }

    public function render()
    {
        $servicios = Servicio::paginate(10);
        return view('livewire.servicios.servicio-index', [
            'servicios' => $servicios,
        ]);
    }
}
