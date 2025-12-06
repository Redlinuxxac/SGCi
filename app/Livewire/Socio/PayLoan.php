<?php

namespace App\Livewire\Socio;

use App\Models\Prestamo;
use Livewire\Component;
use Livewire\Attributes\Flash;

class PayLoan extends Component
{
    public Prestamo $loan;

    #[Flash]
    public $message;

    public function mount(Prestamo $loan)
    {
        $this->loan = $loan;
    }

    public function payLoan()
    {
        if ($this->loan->estado === 'pagado') {
            $this->message = 'Este préstamo ya ha sido pagado.';
            return;
        }

        $this->loan->cuotas()->where('estado', 'pendiente')->update(['estado' => 'pagada']);
        $this->loan->estado = 'pagado';
        $this->loan->save();

        session()->flash('message', 'Préstamo pagado exitosamente.');

        return redirect()->route('socio.my-loans');
    }

    public function render()
    {
        return view('livewire.socio.pay-loan')->layout('layouts.socio-layout');
    }
}
