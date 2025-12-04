<?php

namespace App\Livewire\Dashboard;

use App\Models\Prestamo;
use Livewire\Component;

class PrestamosCountWidget extends Component
{
    public $prestamosCount;

    public function mount()
    {
        // Count active or non-paid loans
        $this->prestamosCount = Prestamo::where('estado', '!=', 'pagado')->count();
    }

    public function render()
    {
        return view('livewire.dashboard.prestamos-count-widget');
    }
}