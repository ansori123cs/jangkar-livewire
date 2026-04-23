<?php

namespace Tests\Feature\Livewire\Navigations;

use App\Livewire\Navigations\NavbarAdmin;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Livewire\Livewire;
use Tests\TestCase;

class NavbarAdminTest extends TestCase
{
    /** @test */
    public function renders_successfully()
    {
        Livewire::test(NavbarAdmin::class)
            ->assertStatus(200);
    }
}
