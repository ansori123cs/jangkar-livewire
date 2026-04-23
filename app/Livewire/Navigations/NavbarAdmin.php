<?php

namespace App\Livewire\Navigations;

use Livewire\Component;

class NavbarAdmin extends Component
{
    public $user = [
        'name' => 'Admin User',
        'role' => 'Admin Data',
        'email' => 'admin_data@email.com'
    ];


    public function render()
    {
        $user = $this->user;
        return view('livewire.navigations.navbar-admin', [
            'user' => $user,
        ]);
    }
}
