<?php

namespace Tests\Feature\Livewire\Master;

use App\Livewire\Master\Colors;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Livewire\Livewire;
use Tests\TestCase;

class ColorsTest extends TestCase
{
    /** @test */
    public function renders_successfully()
    {
        Livewire::test(Colors::class)
            ->assertStatus(200);
    }
}
