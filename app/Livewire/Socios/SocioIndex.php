<?php

namespace App\Livewire\Socios;

use App\Models\Socio;
use Livewire\Component;
use Livewire\WithPagination;
use Livewire\Attributes\On;

class SocioIndex extends Component
{
    use WithPagination;

    public bool $showModal = false;
    public ?int $currentSocioId = null;

    #[On('socio-saved')]
    public function closeModal(): void
    {
        $this->showModal = false;
        $this->currentSocioId = null;
    }

    public function create(): void
    {
        $this->currentSocioId = null;
        $this->showModal = true;
    }

    public function edit(int $socioId): void
    {
        $this->currentSocioId = $socioId;
        $this->showModal = true;
    }

    public function delete(int $socioId): void
    {
        Socio::find($socioId)->delete();
        // Could add a confirmation event here
    }

    public function render()
    {
        $socios = Socio::paginate(10);
        return view('livewire.socios.socio-index', [
            'socios' => $socios,
        ]);
    }
}
