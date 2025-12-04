<?php

namespace App\Livewire\Dashboard;

use App\Models\Prestamo; // Using Prestamo for a simplified calculation
use Livewire\Component;

class ExcedentesTotalWidget extends Component
{
    public $excedentesTotal;

    public function mount()
    {
        // Placeholder for actual surplus calculation.
        // In a real accounting system, this would involve detailed income and expense accounts.
        // For demonstration, we'll sum up some revenue-like figures.
        // For now, let's use the sum of all disbursed loan amounts as a very simplified "income stream".
        $this->excedentesTotal = Prestamo::where('estado', 'desembolsado')->sum('monto');
    }

    public function render()
    {
        return view('livewire.dashboard.excedentes-total-widget');
    }
}