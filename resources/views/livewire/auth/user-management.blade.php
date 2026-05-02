<div>
    {{-- Loading Overlay sama seperti di atas --}}
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
            placeholder="Cari User..."
            class="px-3 py-2.5 text-sm text-slate-900 rounded-md bg-white w-full outline-1 -outline-offset-1 outline-slate-300 focus:outline-2 focus:-outline-offset-2 focus:outline-blue-600 dark:text-slate-50 dark:bg-neutral-800 dark:outline-neutral-700" />

        <button wire:click="create"
            class="w-full py-2 px-3.5 text-sm rounded-md font-semibold cursor-pointer text-white border border-blue-600 bg-blue-600 hover:bg-blue-700 transition-all focus:outline-none focus-visible:ring-2 focus-visible:ring-blue-500"
            wire:loading.attr="disabled">
            + Tambah User Baru
        </button>
    </div>


    @if (session()->has('message'))
        <div class="alert alert-success">{{ session('message') }}</div>
    @endif
    @if (session()->has('error'))
        <div class="alert alert-error">{{ session('error') }}</div>
    @endif

    {{-- Modal User (Lebih Lebar) --}}
    @if ($isOpen)
        <div class="fixed inset-0 bg-black/50 flex items-center justify-center z-50">
            <div class="bg-base-100 rounded-xl shadow-2xl w-full max-w-lg mx-4">
                <div class="p-6">
                    <h2 class="text-2xl font-bold mb-6">{{ $userId ? 'Edit User' : 'Tambah User Baru' }}</h2>

                    <form wire:submit="save">
                        <div class="grid grid-cols-1 gap-2">


                            <div class="form-control mb-4">
                                <label for="name"
                                    class="mb-2 text-slate-900 font-medium text-sm inline-block dark:text-slate-50">Nama
                                    Lengkap</label>
                                <input id="name" name="name" placeholder="Admin ....." type="text"
                                    wire:model="name"
                                    class="px-3 py-2.5 text-sm text-slate-900 rounded-md bg-white w-full outline-1 -outline-offset-1 outline-slate-300 focus:outline-2 focus:-outline-offset-2 focus:outline-blue-600 dark:text-slate-50 dark:bg-neutral-800 dark:outline-neutral-700" />
                                @error('name')
                                    <span class="text-red-500 text-sm">{{ $message }}</span>
                                @enderror
                            </div>

                            <div class="form-control mb-4">
                                <label for="email"
                                    class="mb-2 text-slate-900 font-medium text-sm inline-block dark:text-slate-50">email</label>
                                <input id="email" name="email" placeholder="admin@mail.com" type="email"
                                    wire:model="email"
                                    class="px-3 py-2.5 text-sm text-slate-900 rounded-md bg-white w-full outline-1 -outline-offset-1 outline-slate-300 focus:outline-2 focus:-outline-offset-2 focus:outline-blue-600 dark:text-slate-50 dark:bg-neutral-800 dark:outline-neutral-700" />
                                @error('email')
                                    <span class="text-red-500 text-sm">{{ $message }}</span>
                                @enderror
                            </div>


                            <div class="form-control mb-4">
                                <label for="password"
                                    class="mb-2 text-slate-900 font-medium text-sm inline-block dark:text-slate-50">Password
                                    {{ $userId ? '(kosongkan jika tidak diubah)' : '' }}</label>
                                <input id="password" name="password" placeholder="********" type="password"
                                    wire:model="password"
                                    class="px-3 py-2.5 text-sm text-slate-900 rounded-md bg-white w-full outline-1 -outline-offset-1 outline-slate-300 focus:outline-2 focus:-outline-offset-2 focus:outline-blue-600 dark:text-slate-50 dark:bg-neutral-800 dark:outline-neutral-700" />
                                @error('password')
                                    <span class="text-red-500 text-sm">{{ $message }}</span>
                                @enderror
                            </div>


                            <div class="form-control mb-4">
                                <label class="label">Assign Role</label>
                                <select multiple wire:model="roleIds"
                                    class="select w-full h-auto outline-1 -outline-offset-1 outline-slate-300 focus:outline-2 focus:-outline-offset-2 focus:outline-blue-600 dark:text-slate-50 dark:bg-neutral-800 dark:outline-neutral-700">
                                    @foreach ($roles as $role)
                                        <option value="{{ $role->id }}" class="w-full  rounded-md px-2 py-1 m-1">
                                            {{ $role->name }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                        </div>

                        <div class="flex gap-3 justify-end mt-8">

                            <button type="button" wire:click="closeModal"
                                class="w-full py-2 px-3.5 text-sm rounded-md font-semibold cursor-pointer text-white border border-red-600 bg-red-500 hover:bg-red-700 transition-all focus:outline-none focus-visible:ring-2 focus-visible:ring-red-500"
                                wire:loading.attr="disabled">Batal</button>

                            <button type="submit"
                                class="w-full py-2 px-3.5 text-sm rounded-md font-semibold cursor-pointer text-white border border-blue-600 bg-blue-500 hover:bg-blue-700 transition-all focus:outline-none focus-visible:ring-2 focus-visible:ring-blue-500"
                                wire:loading.attr="disabled">
                                <span wire:loading class="loading loading-spinner"></span>
                                Simpan
                            </button>

                        </div>
                    </form>
                </div>
            </div>
        </div>
    @endif

    <!-- Table User (style sama) -->
    <div class="overflow-x-auto px-4 md:px-8">
        <table class="w-full max-w-7xl mx-auto">
            <thead
                class="text-slate-900 dark:text-slate-50 text-left text-sm font-semibold border-b border-slate-300 dark:border-neutral-600 whitespace-nowrap">
                <tr>
                    <th scope="col" class="pl-0 px-3 py-3.5">Nama</th>
                    <th scope="col" class="pl-0 px-3 py-3.5">Email</th>
                    <th scope="col" class="pl-0 px-3 py-3.5">Roles</th>
                    <th scope="col" class="pl-0 px-3 py-3.5">Aksi</th>
                </tr>
            </thead>
            <tbody class="text-sm divide-y divide-slate-200 dark:divide-neutral-700">
                @foreach ($users as $user)
                    <tr>
                        <td class="pl-0 px-3 py-4 font-medium text-slate-900 dark:text-slate-50 whitespace-nowrap">
                            {{ $user->name }}</td>
                        <td class="pl-0 px-3 py-4 font-medium text-slate-900 dark:text-slate-50 whitespace-nowrap">
                            {{ $user->email }}</td>
                        <td
                            class="px-3 py-4 text-slate-500 dark:text-slate-400 space-1 grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-1">
                            @foreach ($user->roles as $role)
                                <span class="badge badge-sm badge-info m-1">{{ $role->name }}</span>
                            @endforeach
                        </td>
                        <td class="px-3 py-4 text-slate-500 dark:text-slate-400 grid grid-cols-1 md:grid-cols-2 gap-2">
                            <button wire:click="edit({{ $user->id }})" class="btn btn-sm btn-warning">Edit</button>
                            <button wire:click="delete({{ $user->id }})" onclick="return confirm('Yakin?')"
                                class="btn btn-sm btn-error">Hapus</button>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>

    {{ $users->links() }}
</div>
