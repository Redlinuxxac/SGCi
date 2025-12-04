<?php

namespace App\Livewire\Seguridad;

use Spatie\Permission\Models\Role;
use Livewire\Component;
use Livewire\WithPagination;
use Livewire\Attributes\On;

class RoleIndex extends Component
{
    use WithPagination;

    public bool $showModal = false;
    public ?int $currentRoleId = null;

    #[On('role-saved')]
    public function closeModal(): void
    {
        $this->showModal = false;
        $this->currentRoleId = null;
    }

    public function create(): void
    {
        $this->currentRoleId = null;
        $this->showModal = true;
    }

    public function edit(int $roleId): void
    {
        $this->currentRoleId = $roleId;
        $this->showModal = true;
    }

    public function delete(int $roleId): void
    {
        // Add protection for admin role if needed
        Role::find($roleId)->delete();
    }

    public function render()
    {
        $roles = Role::withCount('permissions')->paginate(10);
        return view('livewire.seguridad.role-index', [
            'roles' => $roles,
        ]);
    }
}