<?php

namespace App\Livewire\Auth;

use Livewire\Attributes\Layout;
use Livewire\Component;
use Livewire\WithPagination;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Spatie\Permission\Models\Role;

#[Layout('components.layout.admin')]
class UserManagement extends Component
{
    use WithPagination;

    public $name = '';
    public $email = '';
    public $password = '';
    public $roleIds = [];
    public $userId = null;
    public $isOpen = false;
    public $search = '';
    public $isLoading = false;

    protected $rules = [
        'name' => 'required|min:3',
        'email' => 'required|email|unique:users,email',
        'password' => 'required|min:8',
        'roleIds' => 'array',
    ];

    public function create()
    {
        $this->resetForm();
        $this->isOpen = true;
    }

    public function edit($id)
    {
        $this->isLoading = true;

        $user = User::with('roles')->findOrFail($id);

        $this->userId = $user->id;
        $this->name = $user->name;
        $this->email = $user->email;
        $this->roleIds = $user->roles->pluck('id')->toArray();
        $this->password = ''; // Kosongkan password saat edit
        $this->isOpen = true;

        $this->isLoading = false;
    }

    public function save()
    {
        $this->isLoading = true;

        if ($this->userId) {
            $this->validate([
                'name' => 'required|min:3',
                'email' => 'required|email|unique:users,email,' . $this->userId,
                'password' => 'nullable|min:8',
            ]);

            $user = User::findOrFail($this->userId);
            $user->update([
                'name' => $this->name,
                'email' => $this->email,
            ]);

            if ($this->password) {
                $user->update(['password' => bcrypt($this->password)]);
            }
        } else {
            $this->validate();
            $user = User::create([
                'name' => $this->name,
                'email' => $this->email,
                'password' => bcrypt($this->password),
            ]);
        }

        $user->syncRoles($this->roleIds);

        $this->closeModal();
        session()->flash('message', $this->userId ? 'User berhasil diupdate.' : 'User berhasil dibuat.');
        $this->isLoading = false;
    }

    public function delete($id)
    {
        $user = User::findOrFail($id);

        if ($user->id === Auth::id()) {
            session()->flash('error', 'Anda tidak dapat menghapus akun sendiri.');
            return;
        }

        if ($user->hasRole('super-admin')) {
            session()->flash('error', 'Super Admin tidak dapat dihapus.');
            return;
        }

        $user->delete();
        session()->flash('message', 'User berhasil dihapus.');
    }

    public function closeModal()
    {
        $this->isOpen = false;
        $this->resetForm();
    }

    private function resetForm()
    {
        $this->name = '';
        $this->email = '';
        $this->password = '';
        $this->roleIds = [];
        $this->userId = null;
    }

    public function render()
    {
        $users = User::query()
            ->with('roles')
            ->when($this->search, function ($q) {
                $q->where('name', 'like', '%' . $this->search . '%')
                    ->orWhere('email', 'like', '%' . $this->search . '%');
            })
            ->paginate(10);

        $roles = Role::all();

        return view('livewire.auth.user-management', [
            'users' => $users,
            'roles' => $roles,
        ]);
    }
}
