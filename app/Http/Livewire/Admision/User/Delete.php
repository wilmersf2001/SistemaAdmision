<?php

namespace App\Http\Livewire\Admision\User;

use Livewire\Component;
use App\Models\User;

class Delete extends Component
{
    public $user;
    function mount(User $user)
    {
        $this->user = $user;
    }

    public function render()
    {
        return view('livewire.admision.user.delete');
    }
}
