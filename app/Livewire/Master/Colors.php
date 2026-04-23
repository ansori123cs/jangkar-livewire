<?php

namespace App\Livewire\Master;

use Livewire\Attributes\Layout;
use Livewire\Component;

#[Layout('components.layout.admin')]
class Colors extends Component
{
    public function render()
    {
        return view('livewire.master.colors');
    }
}
