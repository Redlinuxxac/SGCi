<?php

namespace App\Livewire\Socio;

use App\Models\Socio;
use Livewire\Component;
use Illuminate\Support\Facades\Auth;

class Profile extends Component
{
    public $socio;
    public $nombres = '';
    public $apellidos = '';
    public $cedula = ''; // Readonly
    public $direccion = '';
    public $telefono = '';
    public $email = ''; // Readonly (from User model)

    public function mount()
    {
        $user = Auth::user();
        $this->socio = Socio::where('user_id', $user->id)->firstOrFail(); // Must have an associated socio

        $this->nombres = $this->socio->nombres;
        $this->apellidos = $this->socio->apellidos;
        $this->cedula = $this->socio->cedula;
        $this->direccion = $this->socio->direccion;
        $this->telefono = $this->socio->telefono;
        $this->email = $user->email; // Get email from User model
    }

    public function save()
    {
        $validatedData = $this->validate([
            'direccion' => 'required|string|max:255',
            'telefono' => 'required|string|max:255',
        ]);

        $this->socio->update($validatedData);

        session()->flash('message', 'Perfil actualizado exitosamente.');
    }

    public function render()
    {
        return view('livewire.socio.profile')->layout('layouts.socio-layout');
    }
}