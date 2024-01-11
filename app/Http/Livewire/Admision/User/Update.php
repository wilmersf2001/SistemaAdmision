<?php

namespace App\Http\Livewire\Admision\User;

use Livewire\Component;
use App\Http\Requests\View\Message\UpdateUser;
use App\Http\Requests\View\UpdateUserRequest;

class Update extends Component
{
    public $user;
    public $newPassword;
    protected $messages = UpdateUser::MESSAGES_ERROR;

    protected function rules()
    {
        $request = new UpdateUserRequest();
        return $request->rules();
    }

    public function updated($propertyName)
    {
        $this->validateOnly($propertyName);
    }

    public function render()
    {
        return view('livewire.admision.user.update');
    }
}
