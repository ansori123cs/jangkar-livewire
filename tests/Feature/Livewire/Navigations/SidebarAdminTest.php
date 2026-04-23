<?php

namespace Tests\Feature\Livewire\Navigations;

use App\Livewire\Navigations\SidebarAdmin;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Livewire\Livewire;
use Tests\TestCase;

class SidebarAdminTest extends TestCase
{
    /** @test */
    public function renders_successfully()
    {
        Livewire::test(SidebarAdmin::class)
            ->assertStatus(200);
    }
}
