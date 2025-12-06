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

    // Cast selectedPermissions to array for consistency
    protected $casts = [
        'selectedPermissions' => 'array',
    ];

    public function mount(?int $roleId = null): void
    {
        $this->allPermissions = Permission::all(); // Now a collection of Permission objects

        if ($roleId) {
            $this->role = Role::with('permissions')->findOrFail($roleId);
            $this->name = $this->role->name;
            // Ensure selectedPermissions are integers
            $this->selectedPermissions = $this->role->permissions->pluck('id')->map(fn($id) => (int) $id)->toArray();
        }
    }

    public function save(): void
    {
        $validatedData = $this->validate([
            'name' => 'required|string|unique:roles,name,' . ($this->role ? $this->role->id : 'NULL'),
            'selectedPermissions' => 'nullable', // No need for array and exists rules on selectedPermissions here, as syncPermissions handles validation implicitly
            // 'selectedPermissions.*' => 'exists:permissions,id', // Removed as syncPermissions handles this
        ]);
        
        // Ensure selectedPermissions are an array of integers if they came as a collection or mixed types
        $permissionsToAssign = collect($this->selectedPermissions ?? [])->map(fn($id) => (int)$id)->toArray();
        
        if ($this->role) {
            $this->role->update(['name' => $validatedData['name']]);
            // Remove existing permissions
            $this->role->permissions()->detach();
            // Assign new permissions
            foreach ($permissionsToAssign as $permissionId) {
                $this->role->givePermissionTo($permissionId);
            }
        } else {
            $role = Role::create(['name' => $validatedData['name']]);
            foreach ($permissionsToAssign as $permissionId) {
                $role->givePermissionTo($permissionId);
            }
        }

        $this->dispatch('role-saved');
    }

    public function render()
    {
        return view('livewire.seguridad.role-form');
    }
}