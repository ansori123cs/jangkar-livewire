<?php

namespace App\Livewire\Auth;

use App\Livewire\DTO\LoginFormDto;
use Livewire\Attributes\Layout;
use Livewire\Component;

#[Layout('components.layout.public')]
class Login extends Component
{
    public LoginFormDto $form;

    public function login()
    {
        $this->form->validate();
    }



    public function render()
    {
        return view('livewire.auth.login');
    }
}
