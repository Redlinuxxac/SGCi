<?php

namespace App\Livewire\Dashboard;

use App\Models\Socio;
use Livewire\Component;

class SociosCountWidget extends Component
{
    public $sociosCount;

    public function mount()
    {
        $this->sociosCount = Socio::count();
    }

    public function render()
    {
        return view('livewire.dashboard.socios-count-widget');
    }
}