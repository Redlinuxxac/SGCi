<?php

namespace App\Livewire\Auditoria;

use App\Models\Auditoria;
use Livewire\Component;
use Livewire\WithPagination;

class AuditoriaIndex extends Component
{
    use WithPagination;

    public function render()
    {
        $registros = Auditoria::with('user')->latest()->paginate(15);
        return view('livewire.auditoria.auditoria-index', [
            'registros' => $registros,
        ]);
    }
}