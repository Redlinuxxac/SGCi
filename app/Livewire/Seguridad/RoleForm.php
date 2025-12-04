<?php

namespace App\Livewire\Seguridad;

use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use Livewire\Component;
use Illuminate\Support\Arr;

class RoleForm extends Component
{
    public ?Role $role = null;

    public $name = '';
    public $selectedPermissions = [];
    public $allPermissions = [];

    public function mount(?int $roleId = null): void
    {
        $this->allPermissions = Permission::all();

        if ($roleId) {
            $this->role = Role::with('permissions')->find($roleId);
            $this->name = $this->role->name;
            $this->selectedPermissions = $this->role->permissions->pluck('id')->toArray();
        }
    }

    public function save(): void
    {
        $validatedData = $this->validate([
            'name' => 'required|string|unique:roles,name,' . ($this->role ? $this->role->id : 'NULL'),
            'selectedPermissions' => 'nullable|array',
            'selectedPermissions.*' => 'exists:permissions,id',
        ]);
        
        $permissions = Arr::get($validatedData, 'selectedPermissions', []);
        
        if ($this->role) {
            $this->role->update(['name' => $validatedData['name']]);
            $this->role->syncPermissions($permissions);
        } else {
            $role = Role::create(['name' => $validatedData['name']]);
            $role->syncPermissions($permissions);
        }

        $this->dispatch('role-saved');
    }

    public function render()
    {
        return view('livewire.seguridad.role-form');
    }
}