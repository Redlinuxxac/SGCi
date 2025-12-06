<?php

namespace App\Livewire\Socio;

use App\Models\Socio;
use App\Models\Prestamo;
use Livewire\Component;
use Livewire\WithPagination;
use Illuminate\Support\Facades\Auth;
use Livewire\Attributes\Flash;

class MyLoans extends Component
{
    use WithPagination;

    public $socio;
    public $showPayLoanModal = false;
    public $selectedLoanId;

    #[Flash]
    public $message;

    public function mount()
    {
        $user = Auth::user();
        $this->socio = Socio::where('user_id', $user->id)->firstOrFail();
        $this->showPayLoanModal = false;
        $this->selectedLoanId = null;
    }

    public function showPayLoanModal($loanId)
    {
        $this->selectedLoanId = $loanId;
        $this->showPayLoanModal = true;
    }

    public function payLoan()
    {
        $loan = Prestamo::find($this->selectedLoanId);

        if (!$loan) {
            $this->message = 'Préstamo no encontrado.';
            $this->showPayLoanModal = false;
            return;
        }

        $loan->cuotas()->where('estado', 'pendiente')->update(['estado' => 'pagada']);
        $loan->estado = 'pagado';
        $loan->save();

        $this->showPayLoanModal = false;
        $this->message = 'Préstamo pagado exitosamente.';
    }

    public function render()
    {
        $loans = $this->socio->prestamos()->paginate(10);

        return view('livewire.socio.my-loans', [
            'loans' => $loans,
        ])->layout('layouts.socio-layout');
    }
}