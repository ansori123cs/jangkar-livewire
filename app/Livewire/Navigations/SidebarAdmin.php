<?php

namespace App\Livewire\Navigations;

use Livewire\Component;

class SidebarAdmin extends Component
{
    public $menus = [
        ['name' => 'Dashboard', 'route' => '#'],
        ['name' => 'Users', 'route' => '#'],
        ['name' => 'Settings', 'route' => '#'],
    ];
    public function render()
    {
        return view('livewire.navigations.sidebar-admin', [
            'menus' => $this->menus
        ]);
    }
}
