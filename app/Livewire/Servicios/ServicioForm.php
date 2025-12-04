<?php

namespace App\Livewire\Servicios;

use App\Models\Servicio;
use Livewire\Component;

class ServicioForm extends Component
{
    public ?Servicio $servicio = null;

    public $nombre = '';
    public $descripcion = '';
    public $estado = 'activo';

    public function mount(?int $servicioId = null): void
    {
        if ($servicioId) {
            $this->servicio = Servicio::find($servicioId);
            $this->nombre = $this->servicio->nombre;
            $this->descripcion = $this->servicio->descripcion;
            $this->estado = $this->servicio->estado;
        }
    }

    public function save(): void
    {
        $validatedData = $this->validate([
            'nombre' => 'required|string|max:255',
            'descripcion' => 'nullable|string',
            'estado' => 'required|in:activo,inactivo',
        ]);

        if ($this->servicio) {
            $this->servicio->update($validatedData);
        } else {
            Servicio::create($validatedData);
        }

        $this->dispatch('servicio-saved');
    }

    public function render()
    {
        return view('livewire.servicios.servicio-form');
    }
}