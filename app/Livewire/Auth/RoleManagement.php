<?php

namespace App\Livewire\Auth;

use Livewire\Attributes\Layout;
use Livewire\Component;
use Livewire\WithPagination;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

#[Layout('components.layout.admin')]
class RoleManagement extends Component
{
    use WithPagination;

    public $name = '';
    public $selectedPermissions = [];
    public $roleId = null;
    public $isOpen = false;           // ← Ganti dari isEdit
    public $search = '';
    public $isLoading = false;

    protected $rules = [
        'name' => 'required|min:3|unique:roles,name',
    ];

    // Reset form
    public function create()
    {
        $this->resetForm();
        $this->isOpen = true;
    }

    public function edit($id)
    {
        $this->isLoading = true;

        $role = Role::with('permissions')->findOrFail($id);

        $this->roleId = $role->id;
        $this->name = $role->name;
        $this->selectedPermissions = $role->permissions->pluck('id')->toArray();
        $this->isOpen = true;

        $this->isLoading = false;
    }

    public function save()
    {
        $this->isLoading = true;

        if ($this->roleId) {
            $this->validate(['name' => 'required|min:3|unique:roles,name,' . $this->roleId]);
            $role = Role::findOrFail($this->roleId);
            $role->update(['name' => $this->name]);
        } else {
            $this->validate();
            $role = Role::create(['name' => $this->name]);
        }

        $role->syncPermissions($this->selectedPermissions);

        $this->resetForm();
        $this->isOpen = false;

        session()->flash('message', $this->roleId ? 'Role berhasil diupdate.' : 'Role berhasil dibuat.');
        $this->isLoading = false;
    }

    public function delete($id)
    {
        $role = Role::findOrFail($id);

        if (in_array($role->name, ['super-admin', 'admin'])) {
            session()->flash('error', 'Role protected tidak dapat dihapus.');
            return;
        }

        if ($role->users()->count() > 0) {
            session()->flash('error', 'Role masih digunakan oleh user.');
            return;
        }

        $role->delete();
        session()->flash('message', 'Role berhasil dihapus.');
    }

    private function resetForm()
    {
        $this->name = '';
        $this->selectedPermissions = [];
        $this->roleId = null;
    }

    public function closeModal()
    {
        $this->isOpen = false;
        $this->resetForm();
    }

    public function render()
    {
        $roles = Role::with('permissions')
            ->when($this->search, function ($q) {
                $q->where('name', 'like', '%' . $this->search . '%');
            })
            ->paginate(10);

        $allPermissions = Permission::orderBy('name')->get();

        return view('livewire.auth.role-management', [
            'roles' => $roles,
            'allPermissions' => $allPermissions,
        ]);
    }
}
