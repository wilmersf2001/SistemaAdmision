<?php

namespace App\Http\Livewire\Admision\UserReniec;

use Livewire\Component;
use App\Models\Setting;

class Users extends Component
{
    public $listeners = ['closeModal'];
    public $showModal = false;
    public $action = 0;
    public $modalSelectedUser = 0;

    public function render()
    {
        $users = Setting::paginate(10);
        return view('livewire.admision.user-reniec.users', compact('users'));
    }

    public function openModal($selectedAction, Setting $user = null)
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
