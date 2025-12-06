<?php

namespace App\Livewire\Users;

use App\Models\User;
use Livewire\Component;
use Illuminate\Validation\Rule;
use Spatie\Permission\Models\Role;
use Illuminate\Support\Facades\Hash;
use Illuminate\Auth\Events\Registered;

class UserForm extends Component
{
    public ?User $user = null;

    public $name = '';
    public $email = '';
    public $password = '';
    public $password_confirmation = '';
    public $selectedRoles = [];

    // Cast selectedRoles to array for consistency
    protected $casts = [
        'selectedRoles' => 'array',
    ];

    public $allRoles = [];

    protected function rules()
    {
        $rules = [
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', Rule::unique('users')->ignore($this->user)],
            'selectedRoles' => ['nullable', 'array'],
            'selectedRoles.*' => ['exists:roles,id'],
        ];

        if (!$this->user) { // If creating a new user
            $rules['password'] = ['required', 'string', 'min:8', 'confirmed'];
        } else { // If updating an existing user
            // Password is optional for updates, but if provided, must meet rules
            if ($this->password) {
                $rules['password'] = ['required', 'string', 'min:8', 'confirmed'];
            }
        }
        return $rules;
    }

    public function mount(?int $userId = null): void
    {
        // Pluck IDs as integers directly for consistency with $selectedRoles
        $this->allRoles = Role::all()->mapWithKeys(fn($role) => [$role->id => $role->name])->toArray();

        if ($userId) {
            $this->user = User::with('roles')->findOrFail($userId);
            $this->name = $this->user->name;
            $this->email = $this->user->email;
            // Ensure selectedRoles are integers
            $this->selectedRoles = $this->user->roles->pluck('id')->map(fn($id) => (int) $id)->toArray();
        }
    }

    public function save(): void
    {
        $validatedData = $this->validate($this->rules()); // Use $this->rules() for dynamic rules

        if ($this->user) {
            $this->user->update([
                'name' => $validatedData['name'],
                'email' => $validatedData['email'],
                'password' => $this->password ? Hash::make($this->password) : $this->user->password,
            ]);
        } else {
            $this->user = User::create([
                'name' => $validatedData['name'],
                'email' => $validatedData['email'],
                'password' => Hash::make($validatedData['password']),
            ]);

            event(new Registered($this->user));
        }

        // Map to integers just in case they are strings
        $rolesToAssign = collect($validatedData['selectedRoles'] ?? [])->map(fn($id) => (int)$id)->toArray();
        
        // Remove existing roles before assigning new ones
        $this->user->roles()->detach();

        // Assign new roles one by one
        foreach ($rolesToAssign as $roleId) {
            $this->user->assignRole($roleId);
        }

        $this->dispatch('user-saved');
    }

    public function render()
    {
        return view('livewire.users.user-form');
    }
}
