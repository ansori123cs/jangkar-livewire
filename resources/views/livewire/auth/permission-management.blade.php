<div>
    {{-- Loading Overlay --}}
    <div wire:loading.flex class="fixed inset-0 z-50 items-center justify-center bg-black/30 backdrop-blur-sm">
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
            placeholder="Cari permission..."
            class="px-3 py-2.5 text-sm text-slate-900 rounded-md bg-white w-full outline-1 -outline-offset-1 outline-slate-300 focus:outline-2 focus:-outline-offset-2 focus:outline-blue-600 dark:text-slate-50 dark:bg-neutral-800 dark:outline-neutral-700" />

        <button wire:click="create"
            class="w-full py-2 px-3.5 text-sm rounded-md font-semibold cursor-pointer text-white border border-blue-600 bg-blue-600 hover:bg-blue-700 transition-all"
            wire:loading.attr="disabled">
            + Tambah Permission
        </button>
    </div>

    @if (session()->has('message'))
        <div class="alert alert-success mb-4">{{ session('message') }}</div>
    @endif
    @if (session()->has('error'))
        <div class="alert alert-error mb-4">{{ session('error') }}</div>
    @endif

    {{-- Modal Form --}}
    @if ($isOpen)
        <div class="fixed inset-0 bg-black/50 flex items-center justify-center z-50">
            <div class="bg-base-100 rounded-xl shadow-2xl w-full max-w-md mx-4">
                <div class="p-6">
                    <h2 class="text-2xl font-bold mb-6">
                        {{ $permissionId ? 'Edit Permission' : 'Tambah Permission Baru' }}
                    </h2>

                    <form wire:submit="save">
                        <div class="form-control mb-6">
                            <label class="label">Nama Permission</label>
                            <input type="text" wire:model="name" class="input input-bordered w-full"
                                placeholder="contoh: user.create">
                            @error('name')
                                <span class="text-red-500 text-sm">{{ $message }}</span>
                            @enderror
                        </div>

                        <div class="flex gap-3 justify-end">
                            <button type="button" wire:click="closeModal"
                                class="w-full py-2 px-3.5 text-sm rounded-md font-semibold cursor-pointer text-slate-700 border border-slate-300 hover:bg-slate-100">
                                Batal
                            </button>

                            <button type="submit"
                                class="w-full py-2 px-3.5 text-sm rounded-md font-semibold cursor-pointer text-white bg-blue-600 hover:bg-blue-700"
                                wire:loading.attr="disabled">
                                {{ $permissionId ? 'Update' : 'Simpan' }}
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    @endif

    <!-- Table -->
    <div class="overflow-x-auto px-4 md:px-8 mt-6">
        <table class="w-full max-w-7xl mx-auto">
            <thead
                class="text-slate-900 dark:text-slate-50 text-left text-sm font-semibold border-b border-slate-300 dark:border-neutral-600">
                <tr>
                    <th class="pl-0 px-3 py-3.5">Nama Permission</th>
                    <th class="pl-0 px-3 py-3.5">Digunakan di Role</th>
                    <th class="pl-0 px-3 py-3.5 text-right">Aksi</th>
                </tr>
            </thead>
            <tbody class="text-sm divide-y divide-slate-200 dark:divide-neutral-700">
                @foreach ($permissions as $permission)
                    <tr>
                        <td class="pl-0 px-3 py-4 font-medium font-mono">{{ $permission->name }}</td>
                        <td class="px-3 py-4">
                            <span class="badge badge-info">{{ $permission->roles_count }}</span>
                        </td>
                        <td class="px-3 py-4 text-right">
                            <button wire:click="edit({{ $permission->id }})"
                                class="btn btn-sm btn-warning">Edit</button>
                            <button wire:click="delete({{ $permission->id }})"
                                onclick="return confirm('Yakin ingin menghapus?')"
                                class="btn btn-sm btn-error">Hapus</button>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>

    {{ $permissions->links() }}
</div>
