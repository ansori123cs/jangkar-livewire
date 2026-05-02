<?php

namespace App\Livewire\Auth;

use Livewire\Attributes\Layout;
use Livewire\Attributes\Validate;
use Livewire\Component;

#[Layout('components.layout.public')]
class Signin extends Component
{
    #[Validate('required')]
    public $username = '';

    #[Validate('required')]
    public $password = '';

    public function login()
    {
        $this->validate();
        // Logika autentikasi (contoh sederhana)
        if ($this->username === 'admin' && $this->password === 'password') {
            session()->flash('success', 'Login berhasil!');
            // Redirect ke dashboard atau halaman lain setelah login sukses
            return redirect()->route('home');
        } else {
            session()->flash('error', 'Login gagal! Periksa username dan password Anda.');
        }
    }

    public function register() {}



    public function render()
    {
        return view('livewire.auth.login');
    }
}
