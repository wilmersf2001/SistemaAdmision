<?php

namespace App\Http\Livewire\Admision\User;

use Livewire\Component;
use App\Models\User;

class Users extends Component
{
    public $listeners = ['closeModal'];
    public $showModal = false;
    public $action = 0;
    public $modalSelectedUser = 0;

    public function render()
    {
        $users = User::paginate(10);
        return view('livewire.admision.user.users', compact('users'));
    }

    public function openModal($selectedAction, User $user = null)
    {
        if ($selectedAction >= 1 && $selectedAction <= 4) {
            $this->action = $selectedAction;
            if ($selectedAction != 1) {
                $this->modalSelectedUser = $user;
            }
            $this->showModal = !$this->showModal;
        }
    }

    public function closeModal()
    {
        $this->showModal = !$this->showModal;
    }
}
