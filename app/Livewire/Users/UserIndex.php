<?php

namespace App\Livewire\Users;

use App\Models\User;
use Livewire\Component;
use Livewire\WithPagination;
use Livewire\Attributes\On;

class UserIndex extends Component
{
    use WithPagination;

    public bool $showModal = false;
    public ?int $currentUserId = null;

    #[On('user-saved')]
    public function closeModal(): void
    {
        $this->showModal = false;
        $this->currentUserId = null;
    }

    public function create(): void
    {
        $this->currentUserId = null;
        $this->showModal = true;
    }

    public function edit(int $userId): void
    {
        $this->currentUserId = $userId;
        $this->showModal = true;
    }

    public function delete(int $userId): void
    {
        User::find($userId)->delete();
        // Maybe add a confirmation event here
    }

    public function render()
    {
        $users = User::with('roles')->paginate(10);
        return view('livewire.users.user-index', [
            'users' => $users,
        ]);
    }
}