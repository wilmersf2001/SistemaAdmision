<?php

namespace App\Http\Livewire\Admision\User;

use Livewire\Component;
use App\Http\Requests\View\Message\CreateUser;
use App\Http\Requests\View\StoreUserRequest;

class Create extends Component
{
    public $name;
    public $lastname;
    public $user;
    public $password;
    protected $messages = CreateUser::MESSAGES_ERROR;

    protected function rules()
    {
        $request = new StoreUserRequest();
        return $request->rules();
    }
    public function updated($propertyName)
    {
        $this->validateOnly($propertyName);
    }

    public function render()
    {
        return view('livewire.admision.user.create');
    }
}
