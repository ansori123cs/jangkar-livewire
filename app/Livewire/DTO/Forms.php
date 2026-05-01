<?php

namespace App\Livewire\DTO;

use Livewire\Attributes\Validate;
use Livewire\Form;

class LoginFormDto extends Form
{

    #[Validate('required')]
    public $username = '';

    #[Validate('required')]
    public $password = '';
}
