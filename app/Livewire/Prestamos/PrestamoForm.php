<?php

namespace App\Livewire\Prestamos;

use App\Models\Prestamo;
use App\Models\Socio;
use Livewire\Component;

class PrestamoForm extends Component
{
    public ?Prestamo $prestamo = null;

    public $socio_id = '';
    public $monto = '';
    public $tasa_interes = '';
    public $plazo_meses = '';
    public $fecha_desembolso = '';
    public $estado = 'pendiente';
    public $observaciones = '';

    public $socios = [];

    public function mount(?int $prestamoId = null): void
    {
        $this->socios = Socio::where('estado', 'activo')->get(['id', 'nombres', 'apellidos']);
        
        if ($prestamoId) {
            $this->prestamo = Prestamo::find($prestamoId);
            $this->socio_id = $this->prestamo->socio_id;
            $this->monto = $this->prestamo->monto;
            $this->tasa_interes = $this->prestamo->tasa_interes;
            $this->plazo_meses = $this->prestamo->plazo_meses;
            $this->fecha_desembolso = $this->prestamo->fecha_desembolso;
            $this->estado = $this->prestamo->estado;
            $this->observaciones = $this->prestamo->observaciones;
        } else {
            $this->fecha_desembolso = today()->format('Y-m-d');
        }
    }

    public function save(): void
    {
        $validatedData = $this->validate([
            'socio_id' => 'required|exists:socios,id',
            'monto' => 'required|numeric|min:0',
            'tasa_interes' => 'required|numeric|min:0',
            'plazo_meses' => 'required|integer|min:1',
            'fecha_desembolso' => 'required|date',
            'estado' => 'required|in:pendiente,aprobado,desembolsado,cancelado,pagado',
            'observaciones' => 'nullable|string',
        ]);

        if ($this->prestamo) {
            $this->prestamo->update($validatedData);
        } else {
            Prestamo::create($validatedData);
        }

        $this->dispatch('prestamo-saved');
    }

    public function render()
    {
        return view('livewire.prestamos.prestamo-form');
    }
}