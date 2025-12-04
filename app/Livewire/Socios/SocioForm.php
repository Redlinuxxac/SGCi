<?php

namespace App\Livewire\Socios;

use App\Models\Socio;
use Livewire\Component;

class SocioForm extends Component
{
    public ?Socio $socio = null;

    public $nombres = '';
    public $apellidos = '';
    public $cedula = '';
    public $fecha_ingreso = '';
    public $estado = 'pendiente';
    public $direccion = '';
    public $telefono = '';

    public function mount(?int $socioId = null): void
    {
        if ($socioId) {
            $this->socio = Socio::find($socioId);
            $this->nombres = $this->socio->nombres;
            $this->apellidos = $this->socio->apellidos;
            $this->cedula = $this->socio->cedula;
            $this->fecha_ingreso = $this->socio->fecha_ingreso;
            $this->estado = $this->socio->estado;
            $this->direccion = $this->socio->direccion;
            $this->telefono = $this->socio->telefono;
        } else {
             $this->fecha_ingreso = today()->format('Y-m-d');
        }
    }

    public function save(): void
    {
        $validatedData = $this->validate([
            'nombres' => 'required|string|max:255',
            'apellidos' => 'required|string|max:255',
            'cedula' => 'required|string|unique:socios,cedula,' . ($this->socio ? $this->socio->id : 'NULL'),
            'fecha_ingreso' => 'required|date',
            'estado' => 'required|in:activo,inactivo,pendiente',
            'direccion' => 'nullable|string|max:255',
            'telefono' => 'nullable|string|max:255',
        ]);

        if ($this->socio) {
            $this->socio->update($validatedData);
        } else {
            Socio::create($validatedData);
        }

        $this->dispatch('socio-saved');
    }

    public function render()
    {
        return view('livewire.socios.socio-form');
    }
}