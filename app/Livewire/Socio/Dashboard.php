<?php

namespace App\Livewire\Socio;

use App\Models\Socio;
use Livewire\Component;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log; // Add this

class Dashboard extends Component
{
    public $socio;
    public $totalLoans = 0;
    public $totalSavings = 0;
    public $pendingLoansAmount = 0;
    public $activeSavingsBalance = 0;

    public function mount()
    {
        $user = Auth::user();
        Log::info('SocioDashboard: User ID - ' . $user->id . ' logged in.');

        $this->socio = Socio::where('user_id', $user->id)->first();

        if (!$this->socio) {
            Log::warning('SocioDashboard: No Socio record found for user ID - ' . $user->id);
            // Optionally, redirect or show an error message in the view
            return; 
        }

        Log::info('SocioDashboard: Socio ID - ' . $this->socio->id . ' found.');

        // Ensure relationships are loaded or handle potential nulls if they were not hasMany
        // For hasMany, accessing ->relation should return a collection (empty if none), not null.
        $this->totalLoans = $this->socio->prestamos()->count(); // Use relationship method for count
        $this->pendingLoansAmount = $this->socio->prestamos()->whereIn('estado', ['pendiente', 'aprobado', 'desembolsado'])->sum('monto');
        $this->totalSavings = $this->socio->ahorros()->count(); // Use relationship method for count
        $this->activeSavingsBalance = $this->socio->ahorros()->where('estado', 'activa')->sum('saldo');

        Log::info('SocioDashboard: Loans Count - ' . $this->totalLoans);
        Log::info('SocioDashboard: Pending Loans Amount - ' . $this->pendingLoansAmount);
        Log::info('SocioDashboard: Savings Count - ' . $this->totalSavings);
        Log::info('SocioDashboard: Active Savings Balance - ' . $this->activeSavingsBalance);
    }

    public function render()
    {
        return view('livewire.socio.dashboard');
    }
}
