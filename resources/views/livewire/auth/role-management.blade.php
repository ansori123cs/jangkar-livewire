<div>
    <div wire:loading.flex
        class="fixed inset-0 z-50 items-center justify-center bg-black/30 backdrop-blur-sm transition-opacity duration-300">

        <div class="flex-col gap-4 w-full flex items-center justify-center">
            <div
                class="w-20 h-20 border-4 border-transparent text-blue-400 text-4xl animate-spin flex items-center justify-center border-t-blue-400 rounded-full">
                <div
                    class="w-16 h-16 border-4 border-transparent text-red-400 text-2xl animate-spin flex items-center justify-center border-t-red-400 rounded-full">
                </div>
            </div>
        </div>
    </div>

    <div class="grid grid-cols-1 md:grid-cols-2 gap-4 justify-between items-center mb-6">
        <input type="text" wire:model.live.debounce.300ms="search" wire:loading.attr="disabled"
            placeholder="Cari role..."
            class="px-3 py-2.5 text-sm text-slate-900 rounded-md bg-white w-full outline-1 -outline-offset-1 outline-slate-300 focus:outline-2 focus:-outline-offset-2 focus:outline-blue-600 dark:text-slate-50 dark:bg-neutral-800 dark:outline-neutral-700" />

        <button wire:click="create"
            class="w-full py-2 px-3.5 text-sm rounded-md font-semibold cursor-pointer text-white border border-blue-600 bg-blue-600 hover:bg-blue-700 transition-all focus:outline-none focus-visible:ring-2 focus-visible:ring-blue-500"
            wire:loading.attr="disabled">
            + Tambah Role Baru
        </button>
    </div>

    @if (session()->has('message'))
        <div class="alert alert-success">{{ session('message') }}</div>
    @endif
    @if (session()->has('error'))
        <div class="alert alert-error">{{ session('error') }}</div>
    @endif

    {{-- Modal Form --}}
    @if ($isOpen)
        <div class="fixed inset-0 bg-black/50 flex items-center justify-center z-50">
            <div class="bg-base-100 rounded-xl shadow-2xl w-full max-w-2xl mx-4">
                <div class="p-6">
                    <h2 class="text-2xl font-bold mb-6">
                        {{ $roleId ? 'Edit Role' : 'Tambah Role Baru' }}
                    </h2>

                    <form wire:submit="save">

                        <div class="form-control mb-4">
                            <label for="role"
                                class="mb-2 text-slate-900 font-medium text-sm inline-block dark:text-slate-50">Role</label>
                            <input id="role" name="role" placeholder="Admin ....." type="text"
                                wire:model="name"
                                class="px-3 py-2.5 text-sm text-slate-900 rounded-md bg-white w-full outline-1 -outline-offset-1 outline-slate-300 focus:outline-2 focus:-outline-offset-2 focus:outline-blue-600 dark:text-slate-50 dark:bg-neutral-800 dark:outline-neutral-700" />
                            @error('name')
                                <span class="text-red-500 text-sm">{{ $message }}</span>
                            @enderror
                        </div>

                        <div class="form-control mb-6">
                            <label class="label">Pilih Permissions</label>
                            <div
                                class="grid grid-cols-2 md:grid-cols-3 gap-3 max-h-72 overflow-y-auto rounded-lg p-4 bg-base-200">
                                @foreach ($allPermissions as $permission)
                                    <label class="cursor-pointer flex items-center gap-2">
                                        <input type="checkbox" value="{{ $permission->id }}"
                                            wire:model="selectedPermissions">
                                        <span class="text-sm">{{ $permission->name }}</span>
                                    </label>
                                @endforeach
                            </div>
                        </div>

                        <div class="flex gap-3 justify-end">
                            <button type="button" wire:click="closeModal"
                                class="w-full py-2 px-3.5 text-sm rounded-md font-semibold cursor-pointer text-white border border-red-600 bg-red-500 hover:bg-red-700 transition-all focus:outline-none focus-visible:ring-2 focus-visible:ring-red-500"
                                wire:loading.attr="disabled">Batal</button>

                            <button type="submit"
                                class="w-full py-2 px-3.5 text-sm rounded-md font-semibold cursor-pointer text-white border border-blue-600 bg-blue-500 hover:bg-blue-700 transition-all focus:outline-none focus-visible:ring-2 focus-visible:ring-blue-500"
                                wire:loading.attr="disabled">
                                <span wire:loading.remove>{{ $roleId ? 'Update' : 'Simpan' }}</span>
                                <span wire:loading class="loading loading-spinner"></span>
                                {{ $roleId ? 'Update' : 'Simpan' }}
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    @endif

    <div class="overflow-x-auto px-4 md:px-8 mt-6">
        <table class="w-full max-w-7xl mx-auto">
            <thead
                class="text-slate-900 dark:text-slate-50 text-left text-sm font-semibold border-b border-slate-300 dark:border-neutral-600 whitespace-nowrap">
                <tr>
                    <th scope="col" class="pl-0 px-3 py-3.5">Nama Role</th>
                    <th scope="col" class="pl-0 px-3 py-3.5">Permissions</th>
                    <th scope="col" class="pl-0 px-3 py-3.5">Users</th>
                    <th scope="col" class="pl-0 px-3 py-3.5">Aksi</th>
                </tr>
            </thead>
            <tbody class="text-sm divide-y divide-slate-200 dark:divide-neutral-700">
                @foreach ($roles as $role)
                    <tr>
                        <td class="pl-0 px-3 py-4 font-medium text-slate-900 dark:text-slate-50 whitespace-nowrap">
                            {{ $role->name }}</td>
                        <td
                            class="px-3 py-4 text-slate-500 dark:text-slate-400 space-1 grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-1">
                            @foreach ($role->permissions as $perm)
                                <span class="badge badge-sm badge-info m-1">{{ $perm->name }}</span>
                            @endforeach
                        </td>
                        <td class="px-3 py-4 text-slate-500 dark:text-slate-400">{{ $role->users()->count() }}</td>
                        <td class="px-3 py-4 text-slate-500 dark:text-slate-400 grid grid-cols-1 md:grid-cols-2 gap-2">
                            <button wire:click="edit({{ $role->id }})" class="btn btn-sm btn-warning"
                                wire:loading.attr="disabled">
                                Edit
                            </button>
                            <button wire:click="delete({{ $role->id }})" class="btn btn-sm btn-error"
                                onclick="return confirm('Yakin ingin menghapus role ini?')">
                                Hapus
                            </button>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
    {{ $roles->links() }}
</div>
