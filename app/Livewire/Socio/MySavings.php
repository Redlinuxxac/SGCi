<?php

namespace App\Livewire\Socio;

use App\Models\Socio;
use Livewire\Component;
use Livewire\WithPagination;
use Illuminate\Support\Facades\Auth;

class MySavings extends Component
{
    use WithPagination;

    public $socio;

    public function mount()
    {
        $user = Auth::user();
        $this->socio = Socio::where('user_id', $user->id)->firstOrFail();
    }

    public function render()
    {
        $savings = $this->socio->ahorros()->paginate(10);
        return view('livewire.socio.my-savings', [
            'savings' => $savings,
        ])->layout('layouts.socio-layout');
    }
}