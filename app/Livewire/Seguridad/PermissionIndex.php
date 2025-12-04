<?php

namespace App\Livewire\Seguridad;

use Spatie\Permission\Models\Permission;
use Livewire\Component;
use Livewire\WithPagination;

class PermissionIndex extends Component
{
    use WithPagination;
    
    public function render()
    {
        $permissions = Permission::paginate(20);
        return view('livewire.seguridad.permission-index', [
            'permissions' => $permissions,
        ]);
    }
}