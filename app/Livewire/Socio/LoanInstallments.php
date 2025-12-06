<?php

namespace App\Livewire\Socio;

use App\Models\Prestamo;
use App\Models\Cuota; // Added
use Livewire\Component;
use Livewire\WithPagination;
use Livewire\Attributes\Flash; // Added

class LoanInstallments extends Component
{
    use WithPagination;

    public Prestamo $loan;

    #[Flash]
    public $message;

    public function mount(Prestamo $loan)
    {
        $this->loan = $loan;
    }

    public function payInstallment(int $installmentId)
    {
        $installment = $this->loan->cuotas()->find($installmentId);

        if (!$installment) {
            $this->message = 'Cuota no encontrada.';
            return;
        }

        if ($installment->estado === 'pagada') {
            $this->message = 'Esta cuota ya ha sido pagada.';
            return;
        }

        $installment->estado = 'pagada';
        $installment->save();

        $this->message = 'Cuota pagada exitosamente.';
    }

    public function render()
    {
        $installments = $this->loan->cuotas()->paginate(12);

        return view('livewire.socio.loan-installments', [
            'installments' => $installments,
        ])->layout('layouts.socio-layout');
    }
}
