<?php

namespace App\Livewire\Ahorros;

use App\Models\Ahorro;
use App\Models\Socio;
use Livewire\Component;

class AhorroForm extends Component
{
    public ?Ahorro $ahorro = null;

    public $socio_id = '';
    public $tipo_cuenta = 'vista';
    public $saldo = '';
    public $tasa_interes = '';
    public $fecha_apertura = '';
    public $estado = 'activa';

    public $socios = [];

    public function mount(?int $ahorroId = null): void
    {
        $this->socios = Socio::where('estado', 'activo')->get(['id', 'nombres', 'apellidos']);

        if ($ahorroId) {
            $this->ahorro = Ahorro::find($ahorroId);
            $this->socio_id = $this->ahorro->socio_id;
            $this->tipo_cuenta = $this->ahorro->tipo_cuenta;
            $this->saldo = $this->ahorro->saldo;
            $this->tasa_interes = $this->ahorro->tasa_interes;
            $this->fecha_apertura = $this->ahorro->fecha_apertura;
            $this->estado = $this->ahorro->estado;
        } else {
            $this->fecha_apertura = today()->format('Y-m-d');
        }
    }

    public function save(): void
    {
        $validatedData = $this->validate([
            'socio_id' => 'required|exists:socios,id',
            'tipo_cuenta' => 'required|in:vista,plazo_fijo,especial',
            'saldo' => 'required|numeric|min:0',
            'tasa_interes' => 'required|numeric|min:0',
            'fecha_apertura' => 'required|date',
            'estado' => 'required|in:activa,inactiva,cerrada',
        ]);

        if ($this->ahorro) {
            $this->ahorro->update($validatedData);
        } else {
            Ahorro::create($validatedData);
        }

        $this->dispatch('ahorro-saved');
    }

    public function render()
    {
        return view('livewire.ahorros.ahorro-form');
    }
}