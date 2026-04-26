<div class="p-6 lg:p-10 bg-[#FAFBFC] min-h-screen">

    <!-- HEADER -->
    <div class="flex justify-between items-center mb-8">
        <div>
            <h2 class="text-3xl font-bold text-slate-800">Manajemen Guru</h2>
            <p class="text-sm text-gray-500">Kelola data guru & wali kelas</p>
        </div>

        <button wire:click="$toggle('showForm')"
            class="bg-emerald-500 text-white px-5 py-2 rounded-full text-sm font-semibold">
            {{ $showForm ? 'Tutup' : 'Tambah Guru' }}
        </button>
    </div>

    <!-- NOTIF -->
    @if(session()->has('message'))
        <div class="mb-4 bg-emerald-100 text-emerald-700 px-4 py-2 rounded-lg">
            {{ session('message') }}
        </div>
    @endif

    <div class="grid lg:grid-cols-12 gap-6">

        <!-- FORM -->
        @if($showForm)
        <div class="lg:col-span-4">
            <div class="bg-white p-6 rounded-2xl shadow-sm">
                <h3 class="font-bold mb-4">
                    {{ $isEdit ? 'Edit Guru' : 'Tambah Guru' }}
                </h3>

                <form wire:submit.prevent="save" class="space-y-4">
                    <input wire:model="name" type="text" placeholder="Nama Guru"
                        class="w-full p-3 rounded-xl bg-gray-50">

                    <input wire:model="nip" type="text" placeholder="NIP"
                        class="w-full p-3 rounded-xl bg-gray-50">

                    <button class="w-full bg-emerald-500 text-white py-3 rounded-xl">
                        Simpan
                    </button>
                </form>
            </div>
        </div>
        @endif

        <!-- TABLE -->
        <div class="{{ $showForm ? 'lg:col-span-8' : 'lg:col-span-12' }}">
            <div class="bg-white rounded-2xl shadow-sm overflow-hidden">

                <!-- SEARCH -->
                <div class="p-4">
                    <input wire:model.live="search" type="text"
                        placeholder="Cari guru..."
                        class="w-full p-2 rounded-full bg-gray-50">
                </div>

                <table class="w-full">
                    <thead class="bg-gray-50 text-xs text-gray-400 uppercase">
                        <tr>
                            <th class="p-4 text-left">Nama</th>
                            <th class="p-4 text-left">NIP</th>
                            <th class="p-4 text-center">Aksi</th>
                        </tr>
                    </thead>

                    <tbody>
                        @forelse($teachers as $t)
                        <tr class="border-t">
                            <td class="p-4 font-semibold">{{ $t->name }}</td>
                            <td class="p-4 text-gray-500">{{ $t->nip }}</td>

                            <td class="p-4 text-center space-x-2">
                                <button wire:click="edit({{ $t->id }})"
                                    class="text-blue-500">Edit</button>

                                <button wire:click="delete({{ $t->id }})"
                                    class="text-red-500">Hapus</button>
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="3" class="p-6 text-center text-gray-400">
                                Belum ada data guru
                            </td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>

            </div>
        </div>

    </div>
</div>