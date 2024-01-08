<?php

namespace App\Http\Livewire\Admision\User;

use Livewire\Component;
use App\Models\User;
use Spatie\Permission\Models\Role;

class Permission extends Component
{
    public $user;
    public $selectedRol = 0;

    public function mount(User $user)
    {
        $this->user = $user;
    }
    public function render()
    {
        $roles = Role::all();
        return view('livewire.admision.user.permission', compact('roles'));
    }
}
