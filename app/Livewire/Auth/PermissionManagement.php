<?php

namespace App\Livewire\Auth;

use Livewire\Attributes\Layout;
use Livewire\Component;
use Livewire\WithPagination;
use Spatie\Permission\Models\Permission;

#[Layout('components.layout.admin')]
class PermissionManagement extends Component
{
    use WithPagination;

    public $name = '';
    public $permissionId = null;
    public $isOpen = false;
    public $search = '';
    public $isLoading = false;

    protected $rules = [
        'name' => 'required|min:3|unique:permissions,name',
    ];

    public function create()
    {
        $this->resetForm();
        $this->isOpen = true;
    }

    public function edit($id)
    {
        $this->isLoading = true;

        $permission = Permission::findOrFail($id);

        $this->permissionId = $permission->id;
        $this->name = $permission->name;
        $this->isOpen = true;

        $this->isLoading = false;
    }

    public function save()
    {
        $this->isLoading = true;

        if ($this->permissionId) {
            $this->validate(['name' => 'required|min:3|unique:permissions,name,' . $this->permissionId]);
            $permission = Permission::findOrFail($this->permissionId);
            $permission->update(['name' => $this->name]);
            session()->flash('message', 'Permission berhasil diupdate.');
        } else {
            $this->validate();
            Permission::create(['name' => $this->name]);
            session()->flash('message', 'Permission berhasil dibuat.');
        }

        $this->closeModal();
        $this->isLoading = false;
    }

    public function delete($id)
    {
        $permission = Permission::findOrFail($id);

        if ($permission->roles()->count() > 0) {
            session()->flash('error', 'Permission sedang digunakan oleh role.');
            return;
        }

        $permission->delete();
        session()->flash('message', 'Permission berhasil dihapus.');
    }

    public function closeModal()
    {
        $this->isOpen = false;
        $this->resetForm();
    }

    private function resetForm()
    {
        $this->name = '';
        $this->permissionId = null;
    }

    public function render()
    {
        $permissions = Permission::query()
            ->when($this->search, fn($q) => $q->where('name', 'like', '%' . $this->search . '%'))
            ->withCount('roles')
            ->paginate(10);

        return view('livewire.auth.permission-management', [
            'permissions' => $permissions,
        ]);
    }
}
